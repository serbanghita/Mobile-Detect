<?php

namespace DetectionTests;

use Detection\Exception\MobileDetectException;
use Detection\MobileDetect;
use DetectionTests\Fixtures\CustomMobileDetect;
use PHPUnit\Framework\TestCase;

/**
 * Tests that MobileDetect supports subclassing via late static binding.
 * Subclasses can override static property arrays to provide custom detection rules.
 */
final class MobileDetectSubclassTest extends TestCase
{
    public function testGetPhoneDevicesReturnsSubclassRules(): void
    {
        $devices = CustomMobileDetect::getPhoneDevices();
        $this->assertArrayHasKey('CustomPhone', $devices);
        $this->assertArrayNotHasKey('iPhone', $devices);
    }

    public function testGetTabletDevicesReturnsSubclassRules(): void
    {
        $devices = CustomMobileDetect::getTabletDevices();
        $this->assertArrayHasKey('CustomTablet', $devices);
        $this->assertArrayNotHasKey('iPad', $devices);
    }

    public function testGetPropertiesReturnsSubclassProperties(): void
    {
        $properties = CustomMobileDetect::getProperties();
        $this->assertArrayHasKey('CustomPhone', $properties);
        $this->assertArrayNotHasKey('iPhone', $properties);
    }

    public function testGetRulesIncludesSubclassRules(): void
    {
        $detect = new CustomMobileDetect(null, ['autoInitOfHttpHeaders' => false]);
        $rules = $detect->getRules();
        $this->assertArrayHasKey('CustomPhone', $rules);
        $this->assertArrayHasKey('CustomTablet', $rules);
    }

    /**
     * @throws MobileDetectException
     */
    public function testIsMobileRecognizesCustomPhoneRule(): void
    {
        $detect = new CustomMobileDetect(null, ['autoInitOfHttpHeaders' => false]);
        $detect->setUserAgent('CustomPhone/2.1.0');
        $this->assertTrue($detect->isMobile());
    }

    /**
     * @throws MobileDetectException
     */
    public function testIsTabletRecognizesCustomTabletRule(): void
    {
        $detect = new CustomMobileDetect(null, ['autoInitOfHttpHeaders' => false]);
        $detect->setUserAgent('CustomTablet/1.0');
        $this->assertTrue($detect->isTablet());
    }

    /**
     * @throws MobileDetectException
     */
    public function testVersionExtractsFromCustomProperties(): void
    {
        $detect = new CustomMobileDetect(null, ['autoInitOfHttpHeaders' => false]);
        $detect->setUserAgent('CustomPhone/2.1.0');
        $this->assertSame('2.1.0', $detect->version('CustomPhone'));
        $this->assertSame(2.1, $detect->version('CustomPhone', 'float'));
    }

    /**
     * @throws MobileDetectException
     */
    public function testParentRulesDoNotLeakIntoSubclass(): void
    {
        // Prime the parent class getRules() cache first — without the class-keyed
        // cache fix, the parent's 186 rules would leak into the subclass and this
        // iPhone UA would incorrectly match.
        $parent = new MobileDetect(null, ['autoInitOfHttpHeaders' => false]);
        $parent->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X)');
        $this->assertTrue($parent->isMobile());

        $detect = new CustomMobileDetect(null, ['autoInitOfHttpHeaders' => false]);
        $detect->setUserAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X)');
        $this->assertFalse($detect->isMobile());
    }
}
