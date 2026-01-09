# Docker Compose for Pre-Release Validation

This document describes the Docker Compose setup for running all necessary checks before a release in a controlled PHP environment.

## Architecture Overview

```
┌─────────────────────────────────────────────────────────────────────────┐
│                              SETUP SERVICE                              │
│  (composer:latest) - Installs dependencies into ./vendor                │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                    service_completed_successfully
                                    │
        ┌───────────────────────────┼───────────────────────────┐
        ▼                           ▼                           ▼
┌───────────────┐         ┌─────────────────┐         ┌─────────────────┐
│ runUnitTests  │         │  runPerfTests   │         │   runLinting    │
│ (php:8.4+xdebug)│       │ (php:8.4-alpine)│         │ (php:8.4-alpine)│
│ phpunit       │         │ phpbench        │         │ phpcs           │
└───────────────┘         └─────────────────┘         └─────────────────┘
        │                           │                           │
        │                           │                           ▼
        │                           │                 ┌─────────────────┐
        │                           │                 │ runQualityCheck │
        │                           │                 │ (php:8.4-alpine)│
        │                           │                 │ phpstan         │
        │                           │                 └─────────────────┘
        │                           │                           │
        └───────────────────────────┴───────────────────────────┘
                                    │
                    all services completed successfully
                                    │
                                    ▼
                        ┌─────────────────────┐
                        │       runAll        │
                        │  Pre-release gate   │
                        └─────────────────────┘
                                    │
                                    ▼
                        ┌─────────────────────┐
                        │  generateJsonModel  │
                        │  export_to_json.php │
                        └─────────────────────┘
```

## Services

| Service | Image | Purpose |
|---------|-------|---------|
| `setup` | composer:latest | Install dependencies |
| `runUnitTests` | alcohol/php:8.4-xdebug | PHPUnit tests with coverage |
| `runPerfTests` | php:8.4-alpine | PHPBench performance tests |
| `runLinting` | php:8.4-alpine | PHPCS code style checks + auto-fix |
| `runQualityCheck` | php:8.4-alpine | PHPStan static analysis |
| `runAll` | php:8.4-alpine | Pre-release validation gate |
| `generateJsonModel` | php:8.4-alpine | Export detection rules to JSON |

## Usage

### Run all pre-release checks

```bash
docker compose -p mobile-detect up --build runAll
```

### Run individual services

```bash
# Unit tests with coverage
docker compose -p mobile-detect up --build runUnitTests

# Performance benchmarks
docker compose -p mobile-detect up --build runPerfTests

# Code style linting
docker compose -p mobile-detect up --build runLinting

# Static analysis
docker compose -p mobile-detect up --build runQualityCheck

# Generate JSON model (runs after all checks pass)
docker compose -p mobile-detect up --build generateJsonModel
```

### Clean up

```bash
docker compose -p mobile-detect down --volumes --remove-orphans
```
