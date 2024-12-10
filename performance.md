# Performance

Results are taken from a PC with 32GB RAM, Intel(R) Core(TM) i7-10700KF CPU @ 3.80GHz, Win11 Pro running WSL, PHP 8.x (xdebug: yes, opcache: no)

{% code fullWidth="true" %}
```
+-------------------+------------------------------------------------------+-----+------+-----+----------+------------------+--------+
| benchmark         | subject                                              | set | revs | its | mem_peak | mode             | rstdev |
+-------------------+------------------------------------------------------+-----+------+-----+----------+------------------+--------+
| MobileDetectBench | benchIsMobileAgainstBestMatch                        |     | 1000 | 10  | 1.632mb  | 69,032.085ops/s  | ±0.49% |
| MobileDetectBench | benchIsMobileAgainstWorstMatch                       |     | 1000 | 10  | 1.632mb  | 8,961.427ops/s   | ±0.50% |
| MobileDetectBench | benchIsTabletAgainstBestMatch                        |     | 1000 | 10  | 1.632mb  | 285,304.793ops/s | ±0.45% |
| MobileDetectBench | benchIsTabletAgainstWorstMatch                       |     | 1000 | 10  | 1.632mb  | 19,453.726ops/s  | ±0.29% |
| MobileDetectBench | benchIsIOS                                           |     | 1000 | 10  | 1.632mb  | 74,720.864ops/s  | ±0.39% |
| MobileDetectBench | benchIsIpad                                          |     | 1000 | 10  | 1.632mb  | 73,812.347ops/s  | ±0.39% |
| MobileDetectBench | benchIsSamsung                                       |     | 1000 | 10  | 1.632mb  | 45,855.938ops/s  | ±0.54% |
| MobileDetectBench | benchIsSamsungTablet                                 |     | 1000 | 10  | 1.632mb  | 62,689.887ops/s  | ±0.50% |
| MobileDetectBench | benchIsMobileCacheKeyFnBase64AgainstBestMatch        |     | 1000 | 10  | 1.632mb  | 14.789μs         | ±0.39% |
| MobileDetectBench | benchIsMobileCacheKeyFnSha1AgainstBestMatch          |     | 1000 | 10  | 1.632mb  | 15.427μs         | ±0.71% |
| MobileDetectBench | benchIsMobileCacheKeyFnCustomCryptFnAgainstBestMatch |     | 1000 | 10  | 1.632mb  | 19.226μs         | ±0.45% |
+-------------------+------------------------------------------------------+-----+------+-----+----------+------------------+--------+
```
{% endcode %}
