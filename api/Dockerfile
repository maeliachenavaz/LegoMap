# Utilise PHP avec Apache
FROM php:8.2-apache

# Copier le code source dans le conteneur
COPY ./public /var/www/html

# Dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Extension PHP zip (OBLIGATOIRE pour Composer)
RUN docker-php-ext-install zip

# Exposer le port 80
EXPOSE 80

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

WORKDIR /var/www/html

# Remplace pdo_pgsql par pdo_mysql
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_mysql
