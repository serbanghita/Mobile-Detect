<?php

namespace DetectionTests;

use Detection\Cache\CacheException;
use Detection\Exception\MobileDetectException;
use Detection\Exception\MobileDetectExceptionCode;
use Detection\MobileDetect;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;

/**
 * Tests for MobileDetectExceptionCode and exception chaining.
 *
 * These tests verify that exceptions thrown by MobileDetect include:
 * 1. Proper exception codes for categorization
 * 2. Previous exception chaining for debugging root causes
 */
final class MobileDetectExceptionTest extends TestCase
{
    /**
     * Test that isMobile() throws exception with INVALID_USER_AGENT_ERR code when no user-agent is set.
     */
    public function testIsMobileThrowsExceptionWithCodeWhenNoUserAgent(): void
    {
        // Disable auto-init to prevent auto-detection from $_SERVER
        $detect = new MobileDetect(null, ['autoInitOfHttpHeaders' => false]);

        try {
            $detect->isMobile();
            $this->fail('Expected MobileDetectException was not thrown');
        } catch (MobileDetectException $e) {
            $this->assertEquals(
                MobileDetectExceptionCode::INVALID_USER_AGENT_ERR,
                $e->getCode(),
                'Exception should have INVALID_USER_AGENT_ERR code'
            );
            $this->assertStringContainsString('user-agent', strtolower($e->getMessage()));
            $this->assertNull($e->getPrevious(), 'User-agent validation errors should not have a previous exception');
        }
    }

    /**
     * Test that isTablet() throws exception with INVALID_USER_AGENT_ERR code when no user-agent is set.
     */
    public function testIsTabletThrowsExceptionWithCodeWhenNoUserAgent(): void
    {
        $detect = new MobileDetect(null, ['autoInitOfHttpHeaders' => false]);

        try {
            $detect->isTablet();
            $this->fail('Expected MobileDetectException was not thrown');
        } catch (MobileDetectException $e) {
            $this->assertEquals(
                MobileDetectExceptionCode::INVALID_USER_AGENT_ERR,
                $e->getCode(),
                'Exception should have INVALID_USER_AGENT_ERR code'
            );
            $this->assertStringContainsString('user-agent', strtolower($e->getMessage()));
        }
    }

    /**
     * Test that is() throws exception with INVALID_USER_AGENT_ERR code when no user-agent is set.
     */
    public function testIsThrowsExceptionWithCodeWhenNoUserAgent(): void
    {
        $detect = new MobileDetect(null, ['autoInitOfHttpHeaders' => false]);

        try {
            $detect->is('iPhone');
            $this->fail('Expected MobileDetectException was not thrown');
        } catch (MobileDetectException $e) {
            $this->assertEquals(
                MobileDetectExceptionCode::INVALID_USER_AGENT_ERR,
                $e->getCode(),
                'Exception should have INVALID_USER_AGENT_ERR code'
            );
        }
    }

    /**
     * Test that isMobile() cache exception includes IS_MOBILE_ERR code and chains the original exception.
     */
    public function testIsMobileCacheExceptionHasProperCodeAndChain(): void
    {
        $originalException = new CacheException('Simulated cache failure in get()');
        $failingCache = $this->createFailingCache($originalException);

        $detect = new MobileDetect($failingCache);
        $detect->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X)');

        try {
            $detect->isMobile();
            $this->fail('Expected MobileDetectException was not thrown');
        } catch (MobileDetectException $e) {
            // Verify exception code
            $this->assertEquals(
                MobileDetectExceptionCode::IS_MOBILE_ERR,
                $e->getCode(),
                'Cache exception in isMobile() should have IS_MOBILE_ERR code'
            );

            // Verify message contains context
            $this->assertStringContainsString('isMobile()', $e->getMessage());
            $this->assertStringContainsString('Cache problem', $e->getMessage());

            // Verify exception chain
            $previousException = $e->getPrevious();
            $this->assertNotNull($previousException, 'Cache exception should chain the original exception');
            $this->assertInstanceOf(CacheException::class, $previousException);
            $this->assertEquals('Simulated cache failure in get()', $previousException->getMessage());

            // Verify we can trace back to root cause
            $this->assertSame($originalException, $previousException);
        }
    }

    /**
     * Test that isTablet() cache exception includes IS_TABLET_ERR code and chains the original exception.
     */
    public function testIsTabletCacheExceptionHasProperCodeAndChain(): void
    {
        $originalException = new CacheException('Redis connection timeout');
        $failingCache = $this->createFailingCache($originalException);

        $detect = new MobileDetect($failingCache);
        $detect->setUserAgent('Mozilla/5.0 (iPad; CPU OS 15_0 like Mac OS X)');

        try {
            $detect->isTablet();
            $this->fail('Expected MobileDetectException was not thrown');
        } catch (MobileDetectException $e) {
            $this->assertEquals(
                MobileDetectExceptionCode::IS_TABLET_ERR,
                $e->getCode(),
                'Cache exception in isTablet() should have IS_TABLET_ERR code'
            );

            $this->assertStringContainsString('isTablet()', $e->getMessage());

            $previousException = $e->getPrevious();
            $this->assertNotNull($previousException);
            $this->assertEquals('Redis connection timeout', $previousException->getMessage());
        }
    }

    /**
     * Test that is() cache exception includes IS_MAGIC_ERR code and chains the original exception.
     */
    public function testIsMagicCacheExceptionHasProperCodeAndChain(): void
    {
        $originalException = new CacheException('Memcached server unavailable');
        $failingCache = $this->createFailingCache($originalException);

        $detect = new MobileDetect($failingCache);
        $detect->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X)');

        try {
            $detect->is('iPhone');
            $this->fail('Expected MobileDetectException was not thrown');
        } catch (MobileDetectException $e) {
            $this->assertEquals(
                MobileDetectExceptionCode::IS_MAGIC_ERR,
                $e->getCode(),
                'Cache exception in is() should have IS_MAGIC_ERR code'
            );

            $this->assertStringContainsString('is()', $e->getMessage());

            $previousException = $e->getPrevious();
            $this->assertNotNull($previousException);
            $this->assertEquals('Memcached server unavailable', $previousException->getMessage());
        }
    }

    /**
     * Test full exception chain tracing for debugging purposes.
     *
     * This test demonstrates how to trace the complete exception chain
     * from MobileDetectException back to the root cause.
     */
    public function testFullExceptionChainForDebugging(): void
    {
        // Simulate a multi-level exception chain (e.g., network -> cache -> MobileDetect)
        $rootCause = new \RuntimeException('Connection refused to 127.0.0.1:6379');
        $cacheException = new CacheException('Failed to connect to Redis', 0, $rootCause);
        $failingCache = $this->createFailingCache($cacheException);

        $detect = new MobileDetect($failingCache);
        $detect->setUserAgent('Mozilla/5.0 (Linux; Android 11; Pixel 5)');

        try {
            $detect->isMobile();
            $this->fail('Expected MobileDetectException was not thrown');
        } catch (MobileDetectException $e) {
            // Build the full exception chain for debugging
            $chain = $this->buildExceptionChain($e);

            // Verify chain length (MobileDetectException -> CacheException -> RuntimeException)
            $this->assertCount(3, $chain, 'Exception chain should have 3 levels');

            // Verify chain types
            $this->assertInstanceOf(MobileDetectException::class, $chain[0]);
            $this->assertInstanceOf(CacheException::class, $chain[1]);
            $this->assertInstanceOf(\RuntimeException::class, $chain[2]);

            // Verify we can identify the root cause
            $rootCauseFromChain = end($chain);
            $this->assertEquals('Connection refused to 127.0.0.1:6379', $rootCauseFromChain->getMessage());

            // Verify exception codes are preserved in the chain
            $this->assertEquals(MobileDetectExceptionCode::IS_MOBILE_ERR, $chain[0]->getCode());
        }
    }

    /**
     * Test that exception codes are unique and can be used for categorization.
     */
    public function testExceptionCodesAreUniqueForCategorization(): void
    {
        $codes = [
            'INVALID_USER_AGENT_ERR' => MobileDetectExceptionCode::INVALID_USER_AGENT_ERR,
            'IS_MOBILE_ERR' => MobileDetectExceptionCode::IS_MOBILE_ERR,
            'IS_TABLET_ERR' => MobileDetectExceptionCode::IS_TABLET_ERR,
            'IS_MAGIC_ERR' => MobileDetectExceptionCode::IS_MAGIC_ERR,
        ];

        // Verify all codes are unique
        $this->assertCount(
            count($codes),
            array_unique($codes),
            'All exception codes should be unique'
        );

        // Verify codes are non-zero (0 is the default exception code)
        foreach ($codes as $name => $code) {
            $this->assertNotEquals(0, $code, "$name should not be 0");
        }
    }

    /**
     * Test exception handling pattern for applications.
     *
     * This demonstrates the recommended way to handle MobileDetect exceptions
     * and extract debugging information from the chain.
     */
    public function testRecommendedExceptionHandlingPattern(): void
    {
        $originalException = new CacheException('Cache backend failure');
        $failingCache = $this->createFailingCache($originalException);

        $detect = new MobileDetect($failingCache);
        $detect->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X)');

        $errorInfo = null;

        try {
            $detect->isMobile();
        } catch (MobileDetectException $e) {
            // Recommended pattern: extract structured error information
            $errorInfo = [
                'error_code' => $e->getCode(),
                'error_type' => $this->getErrorTypeFromCode($e->getCode()),
                'message' => $e->getMessage(),
                'root_cause' => $this->getRootCause($e)->getMessage(),
                'chain_depth' => count($this->buildExceptionChain($e)),
            ];
        }

        $this->assertNotNull($errorInfo);
        $this->assertEquals(MobileDetectExceptionCode::IS_MOBILE_ERR, $errorInfo['error_code']);
        $this->assertEquals('cache_error_mobile', $errorInfo['error_type']);
        $this->assertEquals('Cache backend failure', $errorInfo['root_cause']);
        $this->assertEquals(2, $errorInfo['chain_depth']);
    }

    /**
     * Create a mock cache that throws the given exception on get() calls.
     */
    private function createFailingCache(\Throwable $exceptionToThrow): CacheInterface
    {
        $cache = $this->createMock(CacheInterface::class);
        $cache->method('get')->willThrowException($exceptionToThrow);
        $cache->method('set')->willThrowException($exceptionToThrow);
        $cache->method('has')->willThrowException($exceptionToThrow);

        return $cache;
    }

    /**
     * Build an array representing the full exception chain.
     *
     * @return \Throwable[]
     */
    private function buildExceptionChain(\Throwable $exception): array
    {
        $chain = [];
        $current = $exception;

        while ($current !== null) {
            $chain[] = $current;
            $current = $current->getPrevious();
        }

        return $chain;
    }

    /**
     * Get the root cause (deepest exception) from an exception chain.
     */
    private function getRootCause(\Throwable $exception): \Throwable
    {
        $chain = $this->buildExceptionChain($exception);
        return end($chain);
    }

    /**
     * Map exception code to a human-readable error type.
     */
    private function getErrorTypeFromCode(int $code): string
    {
        return match ($code) {
            MobileDetectExceptionCode::INVALID_USER_AGENT_ERR => 'invalid_user_agent',
            MobileDetectExceptionCode::IS_MOBILE_ERR => 'cache_error_mobile',
            MobileDetectExceptionCode::IS_TABLET_ERR => 'cache_error_tablet',
            MobileDetectExceptionCode::IS_MAGIC_ERR => 'cache_error_magic',
            default => 'unknown_error',
        };
    }
}
