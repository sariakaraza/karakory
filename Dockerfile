FROM php:8.1-apache

RUN apt-get update \
 && apt-get install -y libpq-dev \
 && docker-php-ext-install pdo_pgsql \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

# Activer mod_rewrite et AllowOverride pour le rewriting d'URL
RUN a2enmod rewrite \
 && sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf