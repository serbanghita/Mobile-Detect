<?php

namespace DetectionTests;

use Detection\Cache\Cache;
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
     * @throws \InvalidArgumentException|InvalidArgumentException
     */
    public function testGetInvalidCacheKey()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->cache->get('');
    }

    /**
     * @throws \InvalidArgumentException|InvalidArgumentException
     */
    public function testSetInvalidCacheKey()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->cache->set('', 'a', 100);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testGetNonExistent()
    {
        $this->assertNull($this->cache->get('random'));
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testSetBoolean()
    {
        $this->cache->set('isMobile', true, 100);
        $this->assertTrue($this->cache->get('isMobile'));

        $this->cache->set('isTablet', false, 100);
        $this->assertFalse($this->cache->get('isTablet'));
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testGetTTL0()
    {
        $this->cache->set('isMobile', true, 0);
        $this->assertNull($this->cache->get('isMobile'));
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testSetTtlAsInteger()
    {
        $this->cache->set('isMobile', true, 1000);
        $this->assertTrue($this->cache->get('isMobile'));
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testSetTtlAsNull()
    {
        $this->cache->set('isMobile', true);
        $this->assertTrue($this->cache->get('isMobile'));
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testDelete()
    {
        $this->cache->set('isMobile', true, 100);
        $this->assertTrue($this->cache->get('isMobile'));
        $this->cache->delete('isMobile');
        $this->assertNull($this->cache->get('isMobile'));
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testClear()
    {
        $this->cache->set('isMobile', true);
        $this->cache->set('isTablet', true);
        $this->cache->clear();
        $this->assertNull($this->cache->get('isMobile'));
        $this->assertNull($this->cache->get('isTablet'));
    }

    /**
     * @throws InvalidArgumentException
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
     * @throws InvalidArgumentException
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
     * @throws InvalidArgumentException
     */
    public function testHas(): void
    {
        $this->cache->set('isA', true);
        $this->assertTrue($this->cache->has('isA'));
    }
}
