**Reporting issues**

1. Specify the User-agent by visiting [http://demo.mobiledetect.net](http://demo.mobiledetect.net).
1. Specify the expected behaviour.

**Developing**

1. Fork Mobile Detect repository. See ["How to fork"](https://help.github.com/articles/fork-a-repo/#fork-an-example-repository) example.
1. `git clone https://github.com/[yourname]/Mobile-Detect.git`
1. `git add remote serbanghita https://github.com/serbanghita/Mobile-Detect.git`
1. `git remote -v` - You should see:
    ```
    origin       git@github.com:serbanghita/Mobile-Detect.git
    serbanghita  https://github.com/serbanghita/Mobile-Detect.git
    ```
1. `git checkout -b devel origin/devel`
1. `composer install`
1. Start working on your changes.
    1. If you add new methods or make structural changes to the `Mobile_Detect.php` class
    you need to add unit tests!
    1. If you add new regexes make sure you commit the User-Agents in [`tests/providers/vendors`](https://github.com/serbanghita/Mobile-Detect/tree/master/tests/providers/vendors)
1. Run tests `vendor/bin/phpunit -v -c tests/phpunit.xml --coverage-text --strict-coverage --stop-on-risky`
1. `git status` or `git diff` - inspect your changes
1  `git stage .`
1. `git commit -m "[your commit message here]`
1. `git push origin devel`
1. Go to your repo on GitHub and ["Submit the PR"](https://help.github.com/articles/about-pull-requests/)

**New module, plugin, plugin or port**

[Submit new module, plugin, port](../../issues/new?title=New%203rd%20party%20module&body=Name,%20Link%20and%20Description%20of%20the%20module.)
 including the following information:
* Module name
* Description
* Link
* Author

Or you can submit a PR against `README.md`.

**Website updates**

1. Our official website is hosted at [http://mobiledetect.net](http://mobiledetect.net).
1. The files are found on the `gh-pages` branch.
1. `git checkout gh-pages`
1. `npm install -g browser-sync`
1. `browser-sync start --s . --f . --port 3000 --reload-debounce 1500 --no-ui`
1. Go to `http://localhost:3000` and make changes.
1. Commit, push and submit the PR against `serbanghita:gh-pages`.