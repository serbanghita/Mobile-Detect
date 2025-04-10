<?php

namespace DetectionTests;

use Detection\Cache\Cache;
use Detection\Cache\CacheException;
use Detection\Cache\CacheInvalidArgumentException;
use Detection\Exception\MobileDetectException;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\InvalidArgumentException;

final class CacheTest extends TestCase
{
    protected Cache $cache;
    protected function setUp(): void
    {
        $this->cache = new Cache();
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testGetInvalidCacheKeyThrowsException()
    {
        $this->expectException(CacheInvalidArgumentException::class);
        $this->cache->get('');
    }

    /**
     * @throws CacheInvalidArgumentException
     * @throws InvalidArgumentException
     */
    public function testGetExpiringCacheKeyWithIntegerTTLIsDeleted()
    {
        $this->cache->set('someKey', 'someValue', 1);
        sleep(1);
        $this->assertNull($this->cache->get('someKey'));
    }

    /**
     * @throws CacheInvalidArgumentException
     * @throws InvalidArgumentException
     */
    public function testGetExpiringCacheKeyWithDateIntervalTTLIsDeleted()
    {
        $this->cache->set('someKey', 'someValue', new \DateInterval('PT1S'));
        sleep(1);
        $this->assertNull($this->cache->get('someKey'));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testSetInvalidCacheKeyThrowsException()
    {
        $this->expectException(CacheInvalidArgumentException::class);
        $this->cache->set('', 'a', 100);
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testGetNonExistentReturnsNull()
    {
        $this->assertNull($this->cache->get('random'));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testSetGetBooleanValues()
    {
        $this->cache->set('isMobile', true, 100);
        $this->assertTrue($this->cache->get('isMobile'));

        $this->cache->set('isTablet', false, 100);
        $this->assertFalse($this->cache->get('isTablet'));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testSetGetZeroTTL()
    {
        $this->cache->set('isMobile', true, 0);
        $this->assertNull($this->cache->get('isMobile'));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testSetGetNegativeTTL()
    {
        $this->cache->set('isMobile', true, -999);
        $this->assertNull($this->cache->get('isMobile'));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testSetZeroTTLWithInvalidKeyThrowsException()
    {
        $this->expectException(CacheInvalidArgumentException::class);
        $this->cache->set('', true, 0);
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testSetNegativeTTLWithInvalidKeyThrowsException()
    {
        $this->expectException(CacheInvalidArgumentException::class);
        $this->cache->set('', true, -999);
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testSetValidTTLAsAnIntegerReturnsTheSetValue()
    {
        $this->cache->set('isMobile', 'someValue', 1000);
        $this->assertEquals('someValue', $this->cache->get('isMobile'));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testSetNullTTLReturnsTheSetValue()
    {
        $this->cache->set('isMobile', 'abc');
        $this->assertEquals('abc', $this->cache->get('isMobile'));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testDeletionOfValidRecord()
    {
        $this->cache->set('isMobile', 'a b c', 100);
        $this->assertEquals('a b c', $this->cache->get('isMobile'));
        $this->cache->delete('isMobile');
        $this->assertNull($this->cache->get('isMobile'));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testClear()
    {
        $this->cache->set('isMobile', true);
        $this->cache->set('isTablet', true);
        $this->assertCount(2, $this->cache->getKeys());
        $this->cache->clear();
        $this->assertCount(0, $this->cache->getKeys());
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testGetMultiple(): void
    {
        $this->cache->set('isMobile', true, 100);
        $this->cache->set('isTablet', false, 200);

        $this->assertEquals(
            [
            'isMobile' => true,
            'isTablet' => false,
            'isUnknown' => null,
            ],
            $this->cache->getMultiple(['isMobile', 'isTablet', 'isUnknown'])
        );
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testSetMultiple(): void
    {
        $this->cache->setMultiple(['isA' => true, 'isB' => false], 200);
        $this->assertEquals([
            'isA' => true,
            'isB' => false
        ], $this->cache->getMultiple(['isA', 'isB']));
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testSetMultipleWithOneInvalidKey(): void
    {
        $result = $this->cache->setMultiple(['a' => 'valueA', 'b' => 'valueB'], 0);

        $this->assertFalse($result);
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testDeleteMultiple(): void
    {
        $this->cache->setMultiple(['isA' => true, 'isB' => false, 'isC' => true], 300);

        $this->cache->deleteMultiple(['isA', 'isB']);

        $this->assertEquals([
            'isA' => null,
            'isB' => null,
            'isC' => true
        ], $this->cache->getMultiple(['isA', 'isB', 'isC']));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testHasReturnsTrueForValidCacheRecord(): void
    {
        $this->cache->set('isA', 'some value1');
        $this->assertTrue($this->cache->has('isA'));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testHasReturnsTrueForInvalidCacheRecord(): void
    {
        $this->cache->set('isA', 'some value2', time());
        $this->assertTrue($this->cache->has('isA'));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testHasReturnsFalseForNonExistentCacheRecord(): void
    {
        $this->assertFalse($this->cache->has('non_existent'));
    }

    /**
     * @throws CacheInvalidArgumentException
     */
    public function testHasThrowsExceptionForNonExistentCacheRecord(): void
    {
        $this->expectException(CacheInvalidArgumentException::class);
        $this->cache->has('invalid key');
    }
}
