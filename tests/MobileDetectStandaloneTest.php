<?php

namespace DetectionTests;

use Detection\Exception\MobileDetectException;
use Detection\MobileDetectStandalone;
use PHPUnit\Framework\TestCase;

/**
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 * @link        http://mobiledetect.net
 */
final class MobileDetectStandaloneTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('\Detection\MobileDetectStandalone'));
    }

    /**
     * @throws MobileDetectException
     */
    public function testClassWithDefaultCache(): void
    {
        $detect = new MobileDetectStandalone();
        $detect->setUserAgent('iPhone');

        $this->assertTrue($detect->isMobile());
        $this->assertFalse($detect->isTablet());
    }

    /**
     * @throws MobileDetectException
     */
    public function testClassWithCustomCacheKeyFnInvalidKey(): void
    {
        $this->expectException(MobileDetectException::class);

        $detect = new MobileDetectStandalone(null, [
            'cacheKeyFn' => fn ($key) => str_repeat('a', 300)
        ]);
        $detect->setUserAgent('iPhone');

        $this->assertTrue($detect->isMobile());
    }
}
