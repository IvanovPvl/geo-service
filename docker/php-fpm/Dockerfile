FROM phusion/baseimage:latest

RUN add-apt-repository -y ppa:ondrej/php
RUN apt-get update && apt-get install -y software-properties-common

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libssl-dev \
    libmcrypt-dev \
    curl \
    php7.2 \
    php7.2-fpm \
    php7.2-mbstring \
    php7.2-pgsql \
    php7.2-curl

RUN rm -r /var/lib/apt/lists/*
RUN usermod -u 1000 www-data

ADD ./php-fpm.conf /etc/php/7.2/fpm/php-fpm.conf
ADD ./www.conf /etc/php/7.2/fpm/pool.d/www.conf
ADD ./site.ini /etc/php/7.2/fpm/conf.d/site.ini

WORKDIR /var/www

CMD ["/usr/sbin/php-fpm7.2", "-F"]

EXPOSE 9000