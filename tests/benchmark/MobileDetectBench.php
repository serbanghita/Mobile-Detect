<?php

namespace DetectionTests\Benchmark;

use Detection\Exception\MobileDetectException;
use Detection\MobileDetect;

/**
 * ./vendor/bin/phpbench run tests/Benchmark --report=aggregate
 */
final class MobileDetectBench
{
    /**
     * @Revs(10000)
     * @Iterations(5)
     * @throws MobileDetectException
     */
    public function benchIsMobile()
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('Mozilla/5.0 (iPad; U; CPU OS 4_2_1 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8C148 Safari/6533.18.5');
        $detect->isMobile();
    }

    /**
     * @Revs(10000)
     * @Iterations(5)
     * @throws MobileDetectException
     */
    public function benchIsTablet()
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('Mozilla/5.0 (iPad; U; CPU OS 4_2_1 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8C148 Safari/6533.18.5');
        $detect->isMobile();
    }

    /**
     * @Revs(10000)
     * @Iterations(5)
     */
    public function benchIsIOS()
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('Mozilla/5.0 (iPad; U; CPU OS 4_2_1 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8C148 Safari/6533.18.5');
        $detect->isiOS();
    }

    /**
     * @Revs(10000)
     * @Iterations(5)
     */
    public function benchIsSamsung()
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('Mozilla/5.0 (Linux; Android 12; SM-F926U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.58 Safari/537.36');
        $detect->isSamsung();
    }
}