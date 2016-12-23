FROM ubuntu:16.04

RUN apt-get update && apt-get install -y software-properties-common php7.0 php7.0-zip php7.0-mbstring php7.0-xml git --no-install-recommends
RUN rm -r /var/lib/apt/lists/*

RUN mkdir --parent /usr/src/composer && \
    cd /usr/src/composer && \
    php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" &&\
    mv composer.phar /usr/bin/composer

WORKDIR /php-application

ENV COMPOSER_HOME /tmp/.composer

CMD php -S 0.0.0.0:8000 -t web/
