FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/

CMD cat /etc/apache2/mods-enabled/*.load && sleep 600
