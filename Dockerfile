FROM php:8.2-apache

RUN rm -f /etc/apache2/mods-enabled/mpm_event.load \
    && rm -f /etc/apache2/mods-enabled/mpm_event.conf

CMD ls -lah /etc/apache2/mods-enabled && sleep 600
