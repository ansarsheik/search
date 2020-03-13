FROM php:7.2-fpm-stretch
WORKDIR "/app"

# Install selected extensions and other stuff
RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-install -j$(nproc) iconv \
	&& docker-php-ext-install mysqli pdo pdo_mysql zip \
	&& docker-php-ext-install gd

# install Xdebug
RUN apt-get update && pecl install xdebug \
    && docker-php-ext-enable xdebug
# Xdebug setup
RUN echo "xdebug.remote_enable=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN apt-get update && apt-get install -y pkg-config patch
RUN docker-php-ext-configure gd --with-freetype-dir --with-jpeg-dir=/usr/include/

# Install git
RUN apt-get update \
    && apt-get -y install git vim \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer