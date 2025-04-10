<?php

namespace DetectionTests;

use Detection\Cache\Cache;
use Detection\Exception\MobileDetectException;
use Detection\MobileDetect;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

final class MobileDetectWithCacheTest extends TestCase
{
    /**
     * @var MobileDetect
     */
    protected MobileDetect $detect;

    public function testFlattenHeaders()
    {
        $detect = new MobileDetect();
        $cacheKey = $detect->flattenHeaders([
            'HTTP_REQUEST_METHOD' => 'DELETE',
            'HTTP_USER_AGENT'     => 'Mozilla/5.0 iPhone;',
            'HTTP_ACCEPT_LANGUAGE' => 'en-us,en;q=0.5',
        ]);

        $expectedString = "HTTP_REQUEST_METHOD: DELETE" . PHP_EOL .
        "HTTP_USER_AGENT: Mozilla/5.0 iPhone;" . PHP_EOL .
        "HTTP_ACCEPT_LANGUAGE: en-us,en;q=0.5";

        $this->assertEquals($expectedString, $cacheKey);
    }

    /**
     * @throws MobileDetectException
     * @throws InvalidArgumentException
     */
    public function testDefaultCacheClassCreatesACacheRecord()
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('Some iPhone user agent');
        $isMobile = $detect->isMobile();

        $this->assertTrue($isMobile);
        $this->assertTrue($detect->getCache()->has(sha1("mobile:Some iPhone user agent:")));
    }

    /**
     * @throws MobileDetectException|InvalidArgumentException
     */
    public function testDefaultCacheClassCreatesMultipleCacheRecordsForAllCalls()
    {
        $userAgent = 'iPad; AppleWebKit/533.17.9 Version/5.0.2 Mobile/8C148 Safari/6533.18.5';
        $detect = new MobileDetect();
        $detect->setUserAgent($userAgent);

        $isMobile = $detect->isMobile();
        $isTablet = $detect->isTablet();
        $isMobile2 = $detect->is("mobile");
        $isTablet2 = $detect->is("tablet");

        $isIpad = $detect->isiPad();
        $isIpad2 = $detect->is("iPad");
        $isiOS = $detect->isiOS();
        $isiOS2 = $detect->is("iOS");

        $this->assertTrue($isMobile);
        $this->assertTrue($isTablet);
        $this->assertTrue($isMobile2);
        $this->assertTrue($isTablet2);
        $this->assertTrue($isIpad);
        $this->assertTrue($isIpad2);
        $this->assertTrue($isiOS);
        $this->assertTrue($isiOS2);


        $this->assertTrue($detect->getCache()->get(sha1("mobile:$userAgent:")));
        $this->assertTrue($detect->getCache()->get(sha1("tablet:$userAgent:")));
        $this->assertTrue($detect->getCache()->get(sha1("iPad:$userAgent:")));
        $this->assertTrue($detect->getCache()->get(sha1("iOS:$userAgent:")));
    }

    /**
     * @throws MobileDetectException
     */
    public function testCustomCacheWithInvalidFnThrowsException()
    {
        $this->expectException(MobileDetectException::class);
        $this->expectExceptionMessage('Cache problem in isMobile(): cacheKeyFn is not a function.');
        $cache = new Cache();

        $detect = new MobileDetect($cache, ['cacheKeyFn' => 'not a function']);
        $detect->setUserAgent('iPad; AppleWebKit/533.17.9 Version/5.0.2 Mobile/8C148 Safari/6533.18.5');
        $detect->isMobile();
    }

    /**
     * @throws MobileDetectException
     */
    public function testCustomCacheForConsecutiveCalls()
    {
        $cache = new Cache();

        $detect = new MobileDetect($cache, ['cacheKeyFn' => fn ($key) => sha1($key)]);
        $detect->setUserAgent('iPad; AppleWebKit/533.17.9 Version/5.0.2 Mobile/8C148 Safari/6533.18.5');

        $detect->isMobile();
        $this->assertCount(1, $cache->getKeys());

        $detect->isMobile();
        $this->assertCount(1, $cache->getKeys());
    }

    /**
     * @throws MobileDetectException
     */
    public function testGetCacheKeyIsUsedInConsecutiveCallsIfFoundIn()
    {
        $cache = $this->getMockBuilder(Cache::class)
            ->enableProxyingToOriginalMethods()
            ->getMock();

        $cache->expects($this->exactly(3))->method('get');
        $cache->expects($this->exactly(1))->method('set');

        $detect = new MobileDetect($cache);
        $detect->setUserAgent('iPad; AppleWebKit/533.17.9 Version/5.0.2 Mobile/8C148 Safari/6533.18.5');

        $detect->isMobile();
        $detect->isMobile();
        $detect->isMobile();
    }

    /**
     * @throws MobileDetectException
     */
    public function testMainClassWorksWithCustomPsr16Class()
    {
        $cacheClass = new class () implements CacheInterface {
            public array $cache = [];

            public function get(string $key, mixed $default = null): mixed
            {
                return $this->cache[$key] ?? null;
            }

            public function set(string $key, mixed $value, \DateInterval|int|null $ttl = null): bool
            {
                $this->cache[$key] = $value;
                return true;
            }

            public function delete(string $key): bool
            {
                unset($this->cache[$key]);
                return true;
            }

            public function clear(): bool
            {
                $this->cache = [];
                return true;
            }

            public function getMultiple(iterable $keys, mixed $default = null): iterable
            {
                return [];
            }

            public function setMultiple(iterable $values, \DateInterval|int|null $ttl = null): bool
            {
                return true;
            }

            public function deleteMultiple(iterable $keys): bool
            {
                return true;
            }

            public function has(string $key): bool
            {
                return true;
            }
        };

        $detect = new MobileDetect($cacheClass);
        $detect->setUserAgent('iPad; AppleWebKit/533.17.9 Version/5.0.2 Mobile/8C148 Safari/6533.18.5');

        $this->assertTrue($detect->isMobile());
        $this->assertTrue($detect->isMobile());
        $this->assertTrue($detect->isMobile());
        $this->assertTrue($detect->isTablet());
        $this->assertCount(2, $cacheClass->cache);
    }
}
