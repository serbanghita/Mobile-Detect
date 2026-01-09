# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.
Whenever you find a new rule that applies to this project, add it to this file.

## Project Overview

Mobile-Detect is a lightweight PHP library for detecting mobile devices (including tablets) using User-Agent strings and HTTP headers. The main namespace is `Detection\MobileDetect`.

## Git Workflow

When working on 4.8.x-based branches, always rebase changes into the `4.8.x` branch only (not `main` or `master`).
When releasing a new version tag, make sure that the new tag is reflected in the `@version` comment section of `MobileDetect.php` and also 
in the `protected string $VERSION` property of the `MobileDetect` class.
The latest tag should also be reflected in `MobileDetect.json`'s `version` property.

## Code Navigation

Always use LSP tools when working with code references:
- Use `goToDefinition` to find where a class, method, or function is defined
- Use `findReferences` to locate all usages of a symbol
- Use `hover` to get type information and documentation
- Use `documentSymbol` to list all symbols in a file

## Common Commands

### Testing
```bash
# Run all tests with coverage
vendor/bin/phpunit -v -c tests/phpunit.xml --coverage-html .coverage

# Run a single test file
vendor/bin/phpunit -v -c tests/phpunit.xml tests/MobileDetectGeneralTest.php

# Run a specific test method
vendor/bin/phpunit -v -c tests/phpunit.xml --filter testMethodName
```

### Code Quality
```bash
# Linting (PSR-12 standard)
vendor/bin/phpcs

# Auto-fix code style issues
vendor/bin/php-cs-fixer fix

# Static analysis (level 3)
vendor/bin/phpstan analyse --memory-limit=1G --level 3 src tests
```

### Benchmarking
```bash
# Create baseline
vendor/bin/phpbench run tests/benchmark/MobileDetectBench.php --retry-threshold=1 --iterations=10 --revs=1000 --report=aggregate --tag=baseline

# Compare against baseline
vendor/bin/phpbench run tests/benchmark/MobileDetectBench.php --ref=baseline --retry-threshold=1 --iterations=10 --revs=1000 --report=aggregate
```

## Architecture

### Core Classes (src/)
- **MobileDetect.php** - Main detection class containing:
  - Device/tablet/browser regex patterns as static arrays
  - Magic `isXXXX()` methods for device/browser detection (e.g., `isiPhone()`, `isAndroidOS()`)
  - `isMobile()`, `isTablet()` - Primary detection methods
  - `version()` - Extract version numbers from User-Agent
  - PSR-16 cache integration for regex match results

- **MobileDetectStandalone.php** - Extends MobileDetect for use without Composer (autoloads dependencies from `standalone/`)

- **Cache/Cache.php** - In-memory PSR-16 cache implementation with TTL support

### Test Structure (tests/)
- **MobileDetectGeneralTest.php** - Core functionality tests
- **UserAgentTest.php** - Data-driven tests using User-Agent fixtures
- **providers/vendors/*.php** - Test data files organized by device vendor (Apple.php, Samsung.php, etc.)
  - Each file returns an array of User-Agent strings mapped to expected results (`isMobile`, `isTablet`, `version`, etc.)
- **benchmark/MobileDetectBench.php** - PHPBench performance tests

### Key Patterns
- Detection results are cached using configurable PSR-16 cache (default: in-memory)
- Cache key generation is configurable via `cacheKeyFn` (default: sha1)
- HTTP headers from `$_SERVER` are auto-initialized unless `autoInitOfHttpHeaders` is false
- CloudFront headers are recognized for AWS-based detection
