# 📊 Performance

Results are taken from a PC with 32GB RAM, i7-10700KF CPU, Win11 Pro, PHP 8.x (xdebug: yes, opcache: no)

{% code fullWidth="true" %}
```
+-------------------+--------------------------------+-----+------+-----+----------+------------------+--------+
| benchmark         | subject                        | set | revs | its | mem_peak | mode             | rstdev |
+-------------------+--------------------------------+-----+------+-----+----------+------------------+--------+
| MobileDetectBench | benchIsMobileAgainstBestMatch  |     | 1000 | 10  | 1.866mb  | 16,211.566ops/s  | ±0.43% |
| MobileDetectBench | benchIsMobileAgainstWorstMatch |     | 1000 | 10  | 1.866mb  | 2,327.531ops/s   | ±0.25% |
| MobileDetectBench | benchIsTabletAgainstBestMatch  |     | 1000 | 10  | 1.866mb  | 104,689.667ops/s | ±0.42% |
| MobileDetectBench | benchIsTabletAgainstWorstMatch |     | 1000 | 10  | 1.866mb  | 5,151.454ops/s   | ±0.39% |
| MobileDetectBench | benchIsIOS                     |     | 1000 | 10  | 1.866mb  | 52,449.311ops/s  | ±0.38% |
| MobileDetectBench | benchIsIpad                    |     | 1000 | 10  | 1.866mb  | 52,261.416ops/s  | ±0.40% |
| MobileDetectBench | benchIsSamsung                 |     | 1000 | 10  | 1.866mb  | 37,232.133ops/s  | ±0.41% |
| MobileDetectBench | benchIsSamsungTablet           |     | 1000 | 10  | 1.866mb  | 46,380.775ops/s  | ±0.49% |
+-------------------+--------------------------------+-----+------+-----+----------+------------------+--------+
```
{% endcode %}
