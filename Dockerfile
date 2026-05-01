FROM php:8.1-fpm

RUN apt-get update && apt-get install -y nodejs npm git unzip \
    && npm install -g sass \
    && docker-php-ext-install pdo pdo_mysql mysqli

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]