FROM php:8.1-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html

# Pastikan hanya prefork yang aktif
RUN a2dismod mpm_event || true
RUN a2enmod mpm_prefork || true

EXPOSE 80

CMD ["apache2-foreground"]
