# Stage 1: Installer TinyMCE avec Node.js
FROM node:20-alpine as npm-builder

WORKDIR /build
COPY package.json ./
RUN npm install --omit=dev

# Stage 2: PHP Runtime
FROM php:8.1-apache

# Installer les dépendances PHP
RUN apt-get update \
 && apt-get install -y libpq-dev \
 && docker-php-ext-install pdo_pgsql \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

# Activer mod_rewrite et AllowOverride pour le rewriting d'URL
RUN a2enmod rewrite \
 && sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Créer le répertoire pour TinyMCE
RUN mkdir -p /var/www/html/assets/lib

# Copier node_modules depuis le stage builder
COPY --from=npm-builder /build/node_modules /var/www/html/assets/lib/node_modules

# Définir le répertoire de travail
WORKDIR /var/www/html