FROM php:8.2-apache

RUN rm -f /etc/apache2/mods-enabled/mpm_event.load \
    && rm -f /etc/apache2/mods-enabled/mpm_event.conf

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/

CMD ["apache2-foreground"]
