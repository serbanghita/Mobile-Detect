FROM composer:latest as setup

WORKDIR app
COPY . .

RUN set -xe && composer install
RUN composer -v
RUN ls -al

FROM php:8.2-fpm

WORKDIR .
COPY --from=setup app .

RUN php -v
RUN ls -al app

RUN cd app && ./vendor/bin/phpunit -v -c tests/phpunit.xml --coverage-text --strict-coverage --stop-on-risky