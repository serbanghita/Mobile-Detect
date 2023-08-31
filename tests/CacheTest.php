<?php

namespace DetectionTests;

use Detection\Cache\Cache;
use Detection\Cache\CacheException;
use Detection\Cache\CacheItem;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\InvalidArgumentException;

final class CacheTest extends TestCase
{
    protected Cache $cache;
    protected function setUp(): void
    {
        $this->cache = new Cache();
    }

    public function testGetInvalidCacheKey()
    {
        $this->expectException(CacheException::class);
        $this->cache->get('');
    }

    public function testSetInvalidCacheKey()
    {
        $this->expectException(CacheException::class);
        $this->cache->set('', 'a', 100);
    }

    /**
     * @throws CacheException
     */
    public function testGetNonExistent()
    {
        $this->assertNull($this->cache->get('random'));
    }

    /**
     * @throws CacheException
     */
    public function testSetBoolean()
    {
        $this->cache->set('isMobile', true, 100);
        $this->assertInstanceOf(CacheItem::class, $this->cache->get('isMobile'));
        $this->assertTrue($this->cache->get('isMobile')->get());

        $this->cache->set('isTablet', false, 100);
        $this->assertInstanceOf(CacheItem::class, $this->cache->get('isTablet'));
        $this->assertFalse($this->cache->get('isTablet')->get());
    }

    /**
     * @throws CacheException
     */
    public function testGetTTL0()
    {
        $this->cache->set('isMobile', true, 0);
        $this->assertInstanceOf(CacheItem::class, $this->cache->get('isMobile'));
        $this->assertEquals(0, $this->cache->get('isMobile')->getTtl());
    }

    /**
     * @throws CacheException
     */
    public function testGetTTLNull()
    {
        $this->cache->set('isMobile', true);
        $this->assertInstanceOf(CacheItem::class, $this->cache->get('isMobile'));
        $this->assertNull($this->cache->get('isMobile')->getTtl());
    }

    /**
     * @throws CacheException
     * @throws InvalidArgumentException
     */
    public function testDelete()
    {
        $this->cache->set('isMobile', true, 100);
        $this->assertTrue($this->cache->get('isMobile')->get());
        $this->cache->delete('isMobile');
        $this->assertNull($this->cache->get('isMobile'));
    }

    /**
     * @throws CacheException
     */
    public function testClear()
    {
        $this->cache->set('isMobile', true);
        $this->cache->set('isTablet', true);
        $this->cache->clear();
        $this->assertNull($this->cache->get('isMobile'));
        $this->assertNull($this->cache->get('isTablet'));
    }
}
