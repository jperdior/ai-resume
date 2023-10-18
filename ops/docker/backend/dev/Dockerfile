# this caches alpine packages so we don't need to download multiple times
FROM composer:2.5.5 as cache
USER root
RUN mkdir -p /etc/apk/cache
RUN apk update
RUN apk fetch -o /etc/apk/cache $PHPIZE_DEPS
RUN apk fetch -o /etc/apk/cache nginx sqlite sqlite-dev supervisor
RUN ls -la /etc/apk/cache

# we have a separate PHP container to build extensions,
# since composer's container doesn't guarantee PHP version
FROM php:8.2-alpine as extensions

## install packages we need
USER root
COPY --from=cache /etc/apk/cache /etc/apk/cache
RUN apk upgrade && apk add $PHPIZE_DEPS sqlite-dev

## we have to manually build these since they're not offered by default
RUN apk add --update linux-headers
RUN pecl install xdebug
RUN pecl install mongodb
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-enable mongodb
RUN docker-php-ext-install pdo_mysql pdo_sqlite

## copy extensions to somewhere we can grab them
RUN cd $(php -r 'echo ini_get("extension_dir");') && cp xdebug.so pdo_mysql.so pdo_sqlite.so mongodb.so /



# runtime container
FROM php:8.2-fpm-alpine as run

## copy over package cache
USER root
COPY --from=cache /etc/apk/cache /etc/apk/cache
RUN apk upgrade
## install packages
RUN apk add nginx sqlite supervisor

RUN apk add --no-cache bash
COPY --from=extensions /xdebug.so /pdo_mysql.so /pdo_sqlite.so /mongodb.so /
RUN mv /xdebug.so /pdo_mysql.so /pdo_sqlite.so /mongodb.so $(php -r 'echo ini_get("extension_dir");')
RUN docker-php-ext-enable xdebug pdo_mysql pdo_sqlite mongodb

RUN echo "max_execution_time = 200s" >> /usr/local/etc/php/php.ini

RUN install --directory /app --owner=www-data --mode=750
WORKDIR /app
## we need app files for this to work properly
COPY --chown=www-data:www-data . .

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"
USER www-data
RUN composer install

USER root

## alpine doesn't do this by default; needed to run as non-root
RUN chown -RL www-data:www-data /var/lib/nginx

## add pidfile to php-fpm
RUN echo -e '[global]\npid = /app/php-fpm.pid' > /usr/local/etc/php-fpm.d/pid.conf
## entry point
EXPOSE 8080
ENTRYPOINT ["/app/bin/run"]
CMD []