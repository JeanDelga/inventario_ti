FROM thecodingmachine/php:8.3-v4-apache-node18

USER root

# Locale pt_BR e dependências
RUN apt-get update \
    && apt-get install -y locales libpng-dev libjpeg-dev libfreetype6-dev libicu-dev \
    && locale-gen pt_BR.UTF-8 \
    && update-locale LANG=pt_BR.UTF-8

ENV LANG=pt_BR.UTF-8

# Ativa as extensões PHP necessárias (modo correto nesta imagem)
ENV PHP_EXTENSIONS="intl gd"

# Ajustar o DocumentRoot para /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-enabled/*.conf

WORKDIR /var/www/html

COPY src/ /var/www/html

RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache
