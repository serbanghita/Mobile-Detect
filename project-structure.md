# 📄 Project structure

```
├── .github                                 # Definitions of GitHub workflows.
├── scripts                                 # Various utility PHP scripts for dev purposes.
├── src                                     
│    ├── Cache                              
│    │    ├── Cache.php                     # PSR-16 cache array implementation.
│    │    ├── CacheException.php
│    │    └── CacheItem.php                 # Cache item that holds key, value and ttl.
│    ├── Exception                          
│    │    └── MobileDetectException.php     # Generic exception.
│    └── MobileDetect.php                   # Main library PHP code.
├── tests                                   
│    ├── Benchmark                          # Performance tests.
│    │    └── MobileDetectBench.php         
│    ├── providers                          
│    │    └── vendors                       # Mobile vendors (Acer, Apple, Samsung, etc.) 
│    │         └── ... 
│    ├── bootstrap.php  
│    ├── CacheTest.php  
│    ├── MobileDetectGeneralTest.php        # Unit tests
│    ├── MobileDetectVersionTest.php        # Unit tests for $detect->version("...")
│    ├── MobileDetectWithCacheTest.php      # Unit tests for caching system.
│    ├── UserAgentList.inc.php  
│    ├── UserAgentTest.php                  # Integration tests using User-Agents. These prevent collisions.
│    ├── phpunit.xml  
│    └── ualist.json  
└── MobileDetect.json                       # Use this file to create a 3rd-party project.
```
