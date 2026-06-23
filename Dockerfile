FROM php:8.2-apache

RUN a2dismod mpm_event || true
RUN a2enmod mpm_prefork || true

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/

CMD ["apache2-foreground"]
