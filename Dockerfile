FROM php:8.2-apache

# Nonaktifkan MPM event
RUN a2dismod mpm_event

# Aktifkan MPM prefork
RUN a2enmod mpm_prefork

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]
