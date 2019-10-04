FROM php:7.3.10-fpm

ENV DEBIAN_FRONTEND noninteractive
RUN echo "Europe/Rome" > /etc/timezone; dpkg-reconfigure tzdata

RUN apt-get update -y
RUN apt-get install --no-install-recommends -y libpng-dev zlib1g-dev curl wget git libmagickwand-dev \
	ca-certificates libzip-dev zip unzip libpq-dev

RUN docker-php-ext-install opcache
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install zip
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install pcntl
RUN pecl install imagick
RUN docker-php-ext-enable imagick

#RUN yes | pecl install xdebug \
#    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN echo 'opcache.memory_consumption=256' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
RUN echo 'opcache.max_accelerated_files=20000' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

WORKDIR /var/www/app

COPY --from=composer:1.9 /usr/bin/composer /usr/bin/composer

ADD docker/php/php.ini /usr/local/etc/php/
ADD docker/php/www.conf /usr/local/etc/php-fpm.d/

RUN useradd -m dev

USER dev

RUN echo "alias l='ls -la'" >> /home/dev/.bashrc
#RUN mkdir -p /var/www
#RUN chown -R dev:dev /var/www

# Add folder & permission for sessions
#RUN mkdir -p /var/www/sessions
#RUN chown -R dev:dev /var/www
