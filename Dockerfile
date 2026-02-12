FROM php:8.2-cli

WORKDIR /var/www/html

COPY . /var/www/html
COPY cors.ini /usr/local/etc/php/conf.d/cors.ini

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]
