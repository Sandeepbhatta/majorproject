FROM node:18 as frontend_builder
WORKDIR /app
COPY package.json .
COPY package-lock.json .
RUN npm install
COPY vite.config.js .
COPY tailwind.config.js .
COPY resources resources
COPY postcss.config.js .
COPY public/ public/
RUN npm run build

FROM php:8.2.7-apache-bullseye
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json .
COPY composer.lock .
COPY database database
RUN composer update
# RUN composer install --no-interaction --no-scripts --prefer-dist --optimize-autoloader

COPY . .
COPY --from=frontend_builder /app/public/ public/

RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 8000
RUN chmod u+x entrypoint.sh
CMD ["./entrypoint.sh"]
