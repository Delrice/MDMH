FROM php:7.1-fpm

RUN apt-get update \
    && apt-get install -y \
        git autoconf pkg-config libssl-dev

RUN pecl install mongodb-1.2.2
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN docker-php-ext-install \
        pdo \
        pdo_mysql \
        bcmath

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

RUN curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony \
    && chmod a+x /usr/local/bin/symfony
