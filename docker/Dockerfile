FROM ubuntu:latest

ENV TZ=Europe/London

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get update && apt-get install -qqy software-properties-common && add-apt-repository ppa:ondrej/php
RUN apt-get update && apt-get install -qqy \
	  php8.4-cli \
	  php8.4-fpm \
	  php8.4-mbstring \
      php8.4-dom \
      php8.4-zip \
      php8.4-curl \
      php8.4-gd \
      curl \
      git \
      zip \
      unzip
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php && \
    php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

ENTRYPOINT bash
