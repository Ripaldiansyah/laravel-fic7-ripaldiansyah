# versi php
FROM php:8.2-cli-alpine

#ENV
ENV \
    APP_DIR="/JagoFlutter"\
    APP_PORT="8002"

# Copy seluruh proyek Laravel ke dalam container
COPY . $APP_DIR
COPY .env $APP_DIR/.env

RUN apk add --update \
    curl\
    php\
    php-opcache\
    php-openssl\
    php-pdo\
    php-json\
    php-phar\
    php-dom\
    && rm -rf /var/cache/apk/*

# Install dependensi PHP dengan Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN cd $APP_DIR && composer update
RUN cd $APP_DIR && php artisan key:generate

WORKDIR $APP_DIR
CMD php artisan serve --host=0.0.0.0 --port=$APP_PORT

# Expose port 5354 untuk PHP-FPM
EXPOSE $APP_PORT
