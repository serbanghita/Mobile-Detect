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
