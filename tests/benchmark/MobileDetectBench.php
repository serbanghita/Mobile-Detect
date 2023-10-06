<?php

namespace DetectionTests\Benchmark;

use Detection\Exception\MobileDetectException;
use Detection\MobileDetect;

/**
 * Create baseline (before changes):
 *  ./vendor/bin/phpbench run tests/Benchmark/MobileDetectBench.php --retry-threshold=1 --iterations=10 --revs=1000 --report=aggregate --tag=baseline --dump-file=phpbench-baseline.xml
 * Run variant (after changes):
 *  ./vendor/bin/phpbench run tests/Benchmark/MobileDetectBench.php --ref=baseline --retry-threshold=1 --iterations=10 --revs=1000 --report=aggregate
 */
final class MobileDetectBench
{
    /**
     * Benchmark isMobile using the first possible regex,
     * which is the fastest.
     *
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsMobileAgainstBestMatch(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('iPhone');
        $detect->isMobile();
    }

    /**
     * Benchmark isMobile using the last possible regex,
     * which is the slowest,
     * which is at the end of the last key of the tablet array (e.g. GenericTablet)
     *
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsMobileAgainstWorstMatch(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('KT107');
        $detect->isMobile();
    }

    /**
     * Benchmark isTablet against best match possible
     * (e.g. "iPad" is the first match)
     *
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsTabletAgainstBestMatch(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('iPad');
        $detect->isTablet();
    }

    /**
     * Benchmark isTablet against the worst match (the last in tablet regex list).
     *
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsTabletAgainstWorstMatch(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('KT107');
        $detect->isTablet();
    }

    /**
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     */
    public function benchIsIOS(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('Mozilla/5.0 (iPad; U; CPU OS 4_2_1 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8C148 Safari/6533.18.5');
        $detect->isiOS();
    }

    /**
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     */
    public function benchIsIpad(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('Mozilla/5.0 (iPad; CPU OS 9_0_2 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13A452 Safari/601.1');
        $detect->isiPad();
    }

    /**
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     */
    public function benchIsSamsung(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('Mozilla/5.0 (Linux; Android 12; SM-F926U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.58 Safari/537.36');
        $detect->isSamsung();
    }

    /**
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     */
    public function benchIsSamsungTablet(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent('Mozilla/5.0 (Linux; Android 12; SM-X906C Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.119 Mobile Safari/537.36');
        $detect->isSamsungTablet();
    }
}
