# Performance log

Each performance review appends a new section below, using the template at the
bottom of this file. Do not edit prior sections — they are a historical record.

---

## 2026-04-24 — 4.x bench-suite overhaul

- Branch / base: `4.x` @ `c91cc4b`
- PHP: `8.4-alpine` (linux/amd64), run via `docker compose -p mobile-detect up runPerfTests`
- Host: Apple Silicon, OrbStack
- PHPBench config: `iterations=10, revs=1000, warmup=2, retry_threshold=1` (percent; from `/phpbench.json`)
- Subjects: 13, Assertions: 13, Failures: 0, Errors: 0

| Subject | ops/s | rstdev |
|---|---:|---:|
| `benchMatchOnlyBestRegex` | 3,421,012 | ±0.51% |
| `benchMatchOnlyWorstRegex` | 2,338,811 | ±0.38% |
| `benchIsMobileCacheWarm` | 1,004,507 | ±0.42% |
| `benchIsTabletAgainstBestMatch` | 303,764 | ±0.52% |
| `benchIsIOS` | 99,981 | ±0.36% |
| `benchIsIpad` | 99,263 | ±0.35% |
| `benchIsSamsungTablet` | 76,596 | ±0.58% |
| `benchIsMobileCacheCold` | 69,089 | ±0.44% |
| `benchIsMobileAgainstBestMatch` | 68,982 | ±0.49% |
| `benchIsMobileCacheKeyFnCustomAgainstBestMatch` | 66,851 | ±0.52% |
| `benchIsSamsung` | 56,603 | ±0.53% |
| `benchIsTabletAgainstWorstMatch` | 19,776 | ±0.16% |
| `benchIsMobileAgainstWorstMatch` | 8,883 | ±0.30% |

### Notes

- The warm cache hit is ~15× faster than cold (1.00M vs 69k ops/s) — validates the cache-path split was worth adding, and confirms the PSR-16 cache actually short-circuits the regex loop on hit.
- Isolated `match()` runs at 2.3–3.4M ops/s; `isMobile()` on the same best-match UA runs 50× slower at 69k. So ~98% of an `isMobile()` call is *not* the regex — it's constructor + `$_SERVER` init + cache init/check + loop overhead. Cheap cache-key wins would be the highest-leverage optimization.
- The self-audit in `setUpMatchOnlyWorst` passed — `UA_KT107` still matches the last tablet key (currently `GenericTablet`). If a future release reorders tablet rules, the audit throws and this fixture needs refreshing.

---

## 2026-11-03 — bqTablet regex: brand guard restored, `(bq)?.*` removed

- Branch / base: `fix/bq-tablet-regex` on top of `4.x` @ `f024e73`
- PHP: `8.5-alpine` (linux/amd64), run via `docker run --rm --platform linux/amd64 -v "$PWD":/app -v "$PWD/vendor":/app/vendor:ro -w /app php:8.5-alpine vendor/bin/phpbench run --report=aggregate` (the `runPerfTests` compose command, without the `setup` service)
- Host: Apple Silicon (8 CPU), OrbStack
- PHPBench config: `iterations=10, revs=1000, warmup=2, retry_threshold=1` (percent; from `/phpbench.json`)
- Subjects: 13, Assertions: 13, Failures: 0, Errors: 0

| Subject | ops/s | rstdev |
|---|---:|---:|
| `benchMatchOnlyBestRegex` | 3,343,300 | ±0.65% |
| `benchMatchOnlyWorstRegex` | 2,235,913 | ±0.46% |
| `benchIsMobileCacheWarm` | 1,044,116 | ±0.40% |
| `benchIsTabletAgainstBestMatch` | 313,369 | ±0.63% |
| `benchIsIpad` | 93,198 | ±0.62% |
| `benchIsIOS` | 92,278 | ±0.43% |
| `benchIsSamsungTablet` | 72,593 | ±0.57% |
| `benchIsMobileCacheCold` | 67,553 | ±0.36% |
| `benchIsMobileCacheKeyFnCustomAgainstBestMatch` | 67,531 | ±0.51% |
| `benchIsMobileAgainstBestMatch` | 67,417 | ±0.54% |
| `benchIsSamsung` | 56,349 | ±0.54% |
| `benchIsTabletAgainstWorstMatch` | 20,155 | ±0.41% |
| `benchIsMobileAgainstWorstMatch` | 8,908 | ±0.44% |

### Notes

- Base `4.x` @ `f024e73` was run first in the same session and image: `benchIsTabletAgainstWorstMatch` 20,409 ops/s, `benchIsMobileAgainstWorstMatch` 9,057, `benchIsSamsungTablet` 74,234, `benchIsMobileCacheCold` 69,663, `benchMatchOnlyBestRegex` 3,303,659. Every delta is within ±3%, and the largest one (`benchIsMobileCacheCold`, −3.0%) is on a path that never reaches the bq rule, so that is the noise floor of the emulated run, not a regression. On real User-Agents the rule change is invisible, which is the expected outcome: the old `(bq)?.*` only hurt when "Android" occurred many times.
- The change is about adversarial input, which this suite does not cover. Measured separately (PHP 8.4.27, PCRE2 10.44, native arm64, rule compiled as the library does): `isTablet()` on "Android bq " repeated to the 500-byte cap costs 109.6 ms with `pcre.jit=0` before and 6.6 ms after (0.86 ms vs 0.16 ms with JIT on). The bq regex alone hit `PREG_BACKTRACK_LIMIT_ERROR` at 8,000 bytes before; after the change it completes in 49 µs with JIT.
- The 2% `@Assert` in `bench:compare` can trip on `benchIsSamsungTablet` (−2.2% here) for this kind of run; it is the same noise band as the untouched subjects.

---

## Template (copy this block, do not fill it in-place)

```md
## YYYY-MM-DD — <short change summary>

- Branch / base: `<branch>` @ `<sha>`
- PHP: `<php version/image>` (<arch>), run via `<command>`
- Host: <cpu, runtime>
- PHPBench config: `iterations=N, revs=N, warmup=N, retry_threshold=N` (percent; from `/phpbench.json`)
- Subjects: N, Assertions: N, Failures: N, Errors: N

| Subject | ops/s | rstdev |
|---|---:|---:|
| `benchFoo` | N | ±N% |
| ... | | |

### Notes

- Interpretation bullet 1
- Interpretation bullet 2
- Any self-audit / fixture / regression notes

---
```
