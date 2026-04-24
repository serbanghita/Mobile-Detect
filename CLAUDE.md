# CLAUDE.md

Whenever you find a new rule that applies to this project, add it to this file.

## Project

PHP library (`Detection\MobileDetect`) for detecting mobile devices/tablets via User-Agent strings and HTTP headers. Requires PHP >= 8.0. PSR-12 code style.

## Branch & Release

- Active branch: `4.x` (rolling — one branch per major). Always rebase into `4.x` (not `main` or `master`). Tags follow `<major>.<minor>.<patch>`.
- On new tag: update `@version` docblock + `$VERSION` property in `src/MobileDetect.php`, and `version` in `MobileDetect.json`.

## Commands

```bash
# Tests
vendor/bin/phpunit -v -c tests/phpunit.xml
vendor/bin/phpunit -v -c tests/phpunit.xml --filter testMethodName

# Lint + static analysis
vendor/bin/phpcs
vendor/bin/php-cs-fixer fix
vendor/bin/phpstan analyse --memory-limit=1G --level 3 src tests

# Benchmark (defaults live in /phpbench.json and per-method @Revs/@Iterations)
composer bench                # aggregate report
composer bench:baseline       # stores tag=baseline + phpbench-baseline.xml
composer bench:compare        # runs with --ref=baseline, enforces 2% @Assert
# Advisory CI: .github/workflows/4.x-bench.yml runs on every PR to 4.x,
# uploads artifacts, and posts a PR comment. Does not block merge.
```

## Performance reviews

Every time you run a performance review (ad-hoc benchmarking, before a release,
after touching a hot path, or at the end of a perf-oriented PR), **append a new
dated section to `PERFORMANCE.md`** using the template block at the bottom of
that file. Do not edit prior sections — they are a historical record for
regression comparison.

Minimum contents per section: branch/commit, PHP image, host, phpbench config,
the full aggregate table (13 subjects today), and a short notes list
interpreting what's surprising or actionable in the numbers.

## Architecture

```
src/
  MobileDetect.php          # Core class: regex patterns, isMobile(), isTablet(), is(), version(), magic isXXXX() via __call
  MobileDetectStandalone.php # Non-Composer wrapper (loads standalone/ autoloader)
  Cache/Cache.php            # In-memory PSR-16 cache with TTL
  Exception/                 # MobileDetectException + error codes
tests/
  providers/vendors/*.php    # UA fixture arrays per vendor (Apple, Samsung, etc.)
  UserAgentTest.php          # Data-driven tests from vendor fixtures
  MobileDetectGeneralTest.php # Core logic tests
  CacheTest.php, MobileDetectWithCacheTest.php, MobileDetectExceptionTest.php
  Benchmark/MobileDetectBench.php   # PHPBench suite (PSR-4: DetectionTests\Benchmark)
```

## Key Patterns

- Detection results are cached via PSR-16 (`CacheInterface`). Default: in-memory `Cache`. Cache keys use `sha1` by default.
- `$_SERVER` HTTP headers auto-initialized unless `autoInitOfHttpHeaders` config is `false`.
- CloudFront headers (`HTTP_CLOUDFRONT_IS_MOBILE_VIEWER`, etc.) are recognized for AWS detection.
- Magic `isXXXX()` calls dispatch through `__call` -> `is()` -> `match()` against static regex arrays (`$phoneDevices`, `$tabletDevices`, `$operatingSystems`, `$browsers`).
