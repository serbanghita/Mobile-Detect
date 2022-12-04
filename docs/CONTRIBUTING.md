# Contributing to Mobile Detect

### License

By contributing to Mobile Detect library you agree with the [MIT License](../LICENSE) + contributing agreement below.

```
Developer’s Certificate of Origin 1.1

By making a contribution to this project, I certify that:

(a) The contribution was created in whole or in part by me and I
    have the right to submit it under the open source license
    indicated in the file; or

(b) The contribution is based upon previous work that, to the best
    of my knowledge, is covered under an appropriate open source
    license and I have the right under that license to submit that
    work with modifications, whether created in whole or in part
    by me, under the same open source license (unless I am
    permitted to submit under a different license), as indicated
    in the file; or

(c) The contribution was provided directly to me by some other
    person who certified (a), (b) or (c) and I have not modified
    it.

(d) I understand and agree that this project and the contribution
    are public and that a record of the contribution (including all
    personal information I submit with it, including my sign-off) is
    maintained indefinitely and may be redistributed consistent with
    this project or the open source license(s) involved.
```

### Reporting issues

1. Specify the User-agent by visiting [http://demo.mobiledetect.net](http://demo.mobiledetect.net).
1. Specify the expected behaviour.

### Developing

1. Fork Mobile Detect repository. See ["How to fork"](https://help.github.com/articles/fork-a-repo/#fork-an-example-repository) example.
2. `git clone https://github.com/[yourname]/Mobile-Detect.git`
3. `git add remote serbanghita https://github.com/serbanghita/Mobile-Detect.git`
4. `git remote -v` - You should see:
    ```
    origin       git@github.com:serbanghita/Mobile-Detect.git
    serbanghita  https://github.com/serbanghita/Mobile-Detect.git
    ```
5. `git checkout -b devel origin/devel`
6. `composer install`
   1. On Windows use `php composer.phar update` first.
7. Start working on your changes.
    1. If you add new methods or make structural changes to the `Mobile_Detect.php` class
    you need to add unit tests!
    1. If you add new regexes make sure you commit the User-Agents in [`tests/providers/vendors`](https://github.com/serbanghita/Mobile-Detect/tree/master/tests/providers/vendors)
8. Run tests 
9. `vendor/bin/phpunit -v -c tests/phpunit.xml --coverage-text --strict-coverage --stop-on-risky`
   1. On Windows use `%cd%/vendor/bin/phpunit ...`
10. `git status` or `git diff` - inspect your changes
1  `git stage .`
11. `git commit -m "[your commit message here]`
12. `git push origin devel`
13. Go to your repo on GitHub and ["Submit the PR"](https://help.github.com/articles/about-pull-requests/)

### New module, plugin, plugin or port

[Submit new module, plugin, port](../../issues/new?title=New%203rd%20party%20module&body=Name,%20Link%20and%20Description%20of%20the%20module.)
 including the following information:
* Module name
* Description
* Link
* Author

Or you can submit a PR against `README.md`.

### Website updates

1. Our official website is hosted at [http://mobiledetect.net](http://mobiledetect.net).
1. The files are found on the `gh-pages` branch.
1. `git checkout gh-pages`
1. `npm install -g browser-sync`
1. `browser-sync start --s . --f . --port 3000 --reload-debounce 1500 --no-ui`
1. Go to `http://localhost:3000` and make changes.
1. Commit, push and submit the PR against `serbanghita:gh-pages`.
