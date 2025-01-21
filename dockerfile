FROM composer as composer

COPY ./source /app/source
COPY ./composer.json /app/composer.json
COPY ./composer.lock /app/composer.lock

WORKDIR /app

RUN composer install \
    --ignore-platform-reqs \
    --no-ansi \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --prefer-dist

FROM php:8.0-apache

LABEL maintainer="github.com/virtualitems"
LABEL version="1.0.0"
LABEL description="This is a simple PHP application"
LABEL application="virtualitems/dockerapp"

WORKDIR /app

COPY --from=composer /app /var/www/

RUN rm -rf /var/www/html

RUN ln -s /var/www/source /var/www/html

RUN apt update && apt install -y vim

ENV APP_VERSION=1.0
