# Contributing to Mobile Detect

### Developing

First [fork](https://help.github.com/articles/fork-a-repo/#fork-an-example-repository) locally Mobile Detect repository. 

```
git clone https://github.com/[yourname]/Mobile-Detect.git`
git add remote serbanghita https://github.com/serbanghita/Mobile-Detect.git`
git remote -v
```

You should see:

```
origin       git@github.com:serbanghita/Mobile-Detect.git
serbanghita  https://github.com/serbanghita/Mobile-Detect.git
```

Next create your own git working branch from one of the existing branches 4.x 3.x or 2.x
depending on your PHP version:

```
git checkout -b my-new-patch origin/x.x.x
composer install
```

If you add new methods or make structural changes to the `Mobile_Detect.php` class you need to add unit tests
otherwise your PR will not be accepted.

If you add new regexes make sure you commit the User-Agents in [`tests/providers/vendors`](https://github.com/serbanghita/Mobile-Detect/tree/master/tests/providers/vendors).

Now that your changes are done, **run the unit tests**:

```
vendor/bin/phpunit -v -c tests/phpunit.xml --coverage-html .coverage
```

Make sure you check the `.coverage` folder and open the report. \
The coverage should be just like you first started (close to 100%).

Next step is to ensure the code is clean, just run the linters:

```
./vendor/bin/phpcs
./vendor/bin/phpcbf
```

If no errors left, then proceed to committing your changes:

```
git status
git stage
git commit -m "your commit message here"
git push
```

Now go to your repo on GitHub and ["Submit the PR"](https://help.github.com/articles/about-pull-requests/).

### Reporting issues

1. Specify the User-agent by visiting [http://demo.mobiledetect.net](http://demo.mobiledetect.net).
2. Specify the expected behaviour.

### New module, plugin, plugin or port

[Submit new module, plugin, port](issues/new?title=New%203rd%20party%20module&body=Name,%20Link%20and%20Description%20of%20the%20module.)
 including the following information:
* Module name
* Description
* Link
* Author

Or you can submit a PR against `README.md`.

### Website updates

1. Our official website is hosted at [http://mobiledetect.net](http://mobiledetect.net).
2. The files are found on the `gh-pages` branch.
3. `git checkout gh-pages`
4. `npm install -g browser-sync`
5. `browser-sync start --s . --f . --port 3000 --reload-debounce 1500 --no-ui`
6. Go to `http://localhost:3000` and make changes.
7. Commit, push and submit the PR against `serbanghita:gh-pages`.

### License

By contributing to Mobile Detect library you agree with the [MIT License](LICENSE) + contributing agreement below.