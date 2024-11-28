FROM php:8.1-fpm-alpine

WORKDIR /var/www/html/

COPY ./vendor ./vendor

COPY ./app .

VOLUME [ "/var/www/html/" ]

EXPOSE 80

CMD ["php-fpm"]