---
description: Learn how to contribute with code patches.
---

# 🚢 Contribute by developing code

1. ### [Fork](https://help.github.com/articles/fork-a-repo/#fork-an-example-repository) the repository.

```bash
git clone https://github.com/[yourname]/Mobile-Detect.git
git add remote serbanghita https://github.com/serbanghita/Mobile-Detect.git
git remote -v
...
origin       git@github.com:serbanghita/Mobile-Detect.git
serbanghita  https://github.com/serbanghita/Mobile-Detect.git
```

2. ### Create a local git branch.

Create your own git working branch from one of the existing branches `4.x`, `3.x` or `2.x` depending on your PHP version:

```bash
git checkout -b my-new-patch origin/x.x.x
composer install
```

3. ### Lint the code.

Ensure the code is clean, just run the linters:

```bash
./vendor/bin/phpcs
./vendor/bin/phpcbf
```

4. ### Run unit and integration tests.

If you add new methods or make structural changes to the library then you need to add unit tests otherwise your PR will not be accepted. If you add new regexes make sure you commit the User-Agents in [`tests/providers/vendors`](https://github.com/serbanghita/Mobile-Detect/tree/master/tests/providers/vendors). Now that your changes are done, **run the unit tests**:

```bash
vendor/bin/phpunit -v -c tests/phpunit.xml --coverage-html .coverage
```

Make sure you check the `.coverage` folder and open the report.\
The coverage should be just like you first started (close to 100%).

5. ### Run performance tests.

{% code overflow="wrap" %}
```bash
./vendor/bin/phpbench run tests/Benchmark/MobileDetectBench.php --ref=baseline --retry-threshold=1 --iterations=10 --revs=1000 --report=aggregate
```
{% endcode %}

Baseline re-creation:

{% code overflow="wrap" %}
```bash
./vendor/bin/phpbench run tests/Benchmark/ --retry-threshold=1 --iterations=10 --revs=1000 --report=aggregate --tag=baseline --dump-file=phpbench-baseline.xml
```
{% endcode %}

6. ### Commit

If no errors left, then proceed to committing your changes:

```bash
git status
git stage
git commit -m "your commit message here"
git push
```

7. ### Submit PR

Now go to your repo on GitHub and ["Submit the PR"](https://help.github.com/articles/about-pull-requests/).
