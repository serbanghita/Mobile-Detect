echo "Start building ..."
rm -rf vendor
rm -f composer.lock composer.phar
set -xe
composer install
