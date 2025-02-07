FROM php:8.2-cli

WORKDIR /var/www/html

COPY . .

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

CMD ["php", "-S", "0.0.0.0:8000", "-t", "src"]