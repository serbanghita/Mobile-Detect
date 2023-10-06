#!/bin/sh

# Linting
vendor/bin/phpcs
vendor/bin/phpcbf

# Unit tests
vendor/bin/phpunit -v -c tests/phpunit.xml --coverage-html .coverage

# Performance tests
vendor/bin/phpbench run tests/Benchmark/MobileDetectBench.php --ref=baseline --retry-threshold=1 --iterations=10 --revs=1000 --report=aggregate
