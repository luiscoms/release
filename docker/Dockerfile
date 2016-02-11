FROM php:5.6-cli

MAINTAINER Luis Fernando Gomes <dev@luiscoms.com.br>

# Install extensions
RUN apt-get update \
		&& apt-get install -y \
		git \
		zlib1g-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
	&& mv composer.phar /usr/local/bin/composer

ENV COMPOSER_HOME=/opt/composer

ENV PATH=${PATH}:${COMPOSER_HOME}/vendor/bin

WORKDIR /release/

# Enable zip
RUN docker-php-ext-install zip \
	&& pecl install xdebug \
	&& docker-php-ext-enable xdebug

# Setup timezone to America/Sao_Paulo
RUN cat /usr/src/php/php.ini-production | sed 's/^;\(date.timezone.*\)/\1 \"America\/Sao_Paulo\"/' > /usr/local/etc/php/php.ini

# install phpunit globally
RUN composer global require phpunit/phpunit:~4 squizlabs/php_codesniffer
