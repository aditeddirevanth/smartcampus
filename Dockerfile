FROM php:8.2-apache

RUN docker-php-ext-install mysqli

# Set Apache to use Railway PORT
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/
