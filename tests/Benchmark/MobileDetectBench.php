<?php

namespace DetectionTests\Benchmark;

use Detection\Exception\MobileDetectException;
use Detection\MobileDetect;
use RuntimeException;

/**
 * PHPBench suite for Detection\MobileDetect.
 *
 * Defaults (iterations, revs, warmup, retry-threshold, path) live in /phpbench.json.
 *
 * Typical usage via Composer scripts:
 *   composer bench               # aggregate report
 *   composer bench:baseline      # stores tag=baseline + dumps phpbench-baseline.xml
 *   composer bench:compare       # runs with --ref=baseline and asserts 2% regression threshold
 *
 * Manual usage:
 *   vendor/bin/phpbench run --report=aggregate
 *   vendor/bin/phpbench run --report=aggregate --tag=baseline --dump-file=phpbench-baseline.xml
 *   vendor/bin/phpbench run --ref=baseline --report=aggregate
 */
final class MobileDetectBench
{
    private const UA_IPHONE = 'iPhone';
    private const UA_IPAD = 'iPad';
    private const UA_KT107 = 'KT107';
    private const UA_IPAD_FULL = 'Mozilla/5.0 (iPad; U; CPU OS 4_2_1 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8C148 Safari/6533.18.5';
    private const UA_IPAD_MODERN = 'Mozilla/5.0 (iPad; CPU OS 9_0_2 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13A452 Safari/601.1';
    private const UA_SAMSUNG_PHONE = 'Mozilla/5.0 (Linux; Android 12; SM-F926U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.58 Safari/537.36';
    private const UA_SAMSUNG_TABLET = 'Mozilla/5.0 (Linux; Android 12; SM-X906C Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.119 Mobile Safari/537.36';

    private MobileDetect $detect;
    private string $regex;
    private string $userAgent;

    // --- setUp methods used by @BeforeMethods (run once per iteration) ---

    /**
     * @throws MobileDetectException
     */
    public function setUpMatchOnlyBest(): void
    {
        $this->detect = new MobileDetect();
        $this->detect->setUserAgent(self::UA_IPHONE);
        $this->userAgent = self::UA_IPHONE;

        $phones = MobileDetect::getPhoneDevices();
        $first = reset($phones);
        $this->regex = is_array($first) ? implode('|', $first) : (string) $first;
    }

    /**
     * @throws MobileDetectException
     */
    public function setUpMatchOnlyWorst(): void
    {
        $this->detect = new MobileDetect();
        $this->detect->setUserAgent(self::UA_KT107);
        $this->userAgent = self::UA_KT107;

        $tablets = MobileDetect::getTabletDevices();
        $lastKey = array_key_last($tablets);
        if ($lastKey === null) {
            throw new RuntimeException('MobileDetect::getTabletDevices() returned empty.');
        }

        // Self-audit: UA_KT107 must still match the last tablet key (historically
        // GenericTablet). If a future release reorders or replaces that key, fail
        // loudly so the fixture gets updated instead of measuring the wrong regex.
        if (!$this->detect->is($lastKey)) {
            throw new RuntimeException(sprintf(
                'Worst-case UA "%s" no longer matches the last tablet rule "%s" - pick a new fixture.',
                self::UA_KT107,
                $lastKey
            ));
        }

        $last = $tablets[$lastKey];
        $this->regex = is_array($last) ? implode('|', $last) : (string) $last;
    }

    /**
     * @throws MobileDetectException
     */
    public function setUpCacheWarmMobile(): void
    {
        $this->detect = new MobileDetect();
        $this->detect->setUserAgent(self::UA_IPHONE);
        // Prime the cache so every rev in this iteration hits the cache path.
        $this->detect->isMobile();
    }

    // --- benchmark methods ---

    /**
     * isMobile best-case: first phoneDevices regex matches.
     *
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsMobileAgainstBestMatch(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent(self::UA_IPHONE);
        $detect->isMobile();
    }

    /**
     * isMobile worst-case: walks phoneDevices + tabletDevices, matches the last
     * regex (GenericTablet/KT107 at time of writing). benchMatchOnlyWorstRegex
     * audits the fixture position.
     *
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsMobileAgainstWorstMatch(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent(self::UA_KT107);
        $detect->isMobile();
    }

    /**
     * isTablet best-case: 'iPad' is the first tablet regex.
     *
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsTabletAgainstBestMatch(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent(self::UA_IPAD);
        $detect->isTablet();
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsTabletAgainstWorstMatch(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent(self::UA_KT107);
        $detect->isTablet();
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsIOS(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent(self::UA_IPAD_FULL);
        $detect->isiOS();
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsIpad(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent(self::UA_IPAD_MODERN);
        $detect->isiPad();
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsSamsung(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent(self::UA_SAMSUNG_PHONE);
        $detect->isSamsung();
    }

    /**
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsSamsungTablet(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent(self::UA_SAMSUNG_TABLET);
        $detect->isSamsungTablet();
    }

    /**
     * Custom cacheKeyFn overhead. Default cacheKeyFn is sha1; compare against
     * benchIsMobileAgainstBestMatch to isolate the extra closure + concat cost.
     *
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsMobileCacheKeyFnCustomAgainstBestMatch(): void
    {
        $detect = new MobileDetect(null, ['cacheKeyFn' => fn ($key) => sha1($key) . 'salt']);
        $detect->setUserAgent(self::UA_IPHONE);
        $detect->isMobile();
    }

    /**
     * Isolates match() fast-path by moving construction + setUserAgent to setUp.
     * Bench body is a single preg_match-wrapped call.
     *
     * @BeforeMethods({"setUpMatchOnlyBest"})
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     */
    public function benchMatchOnlyBestRegex(): void
    {
        $this->detect->match($this->regex, $this->userAgent);
    }

    /**
     * Isolates match() worst-case: the last tablet-array regex on UA_KT107.
     * setUp audits that UA_KT107 still matches the last tablet key.
     *
     * @BeforeMethods({"setUpMatchOnlyWorst"})
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     */
    public function benchMatchOnlyWorstRegex(): void
    {
        $this->detect->match($this->regex, $this->userAgent);
    }

    /**
     * Cache-miss path: fresh MobileDetect each rev. Mirrors first-request cost
     * (regex loop + cache write).
     *
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsMobileCacheCold(): void
    {
        $detect = new MobileDetect();
        $detect->setUserAgent(self::UA_IPHONE);
        $detect->isMobile();
    }

    /**
     * Cache-hit path: shared instance across revs; cache is primed in setUp.
     * Isolates the cache-lookup cost without regex matching.
     *
     * @BeforeMethods({"setUpCacheWarmMobile"})
     * @Revs(1000)
     * @Iterations(10)
     * @Warmup(2)
     * @OutputTimeUnit("seconds")
     * @OutputMode("throughput")
     * @Assert("mode(variant.time.avg) < mode(baseline.time.avg) +/- 2%")
     * @throws MobileDetectException
     */
    public function benchIsMobileCacheWarm(): void
    {
        $this->detect->isMobile();
    }
}
