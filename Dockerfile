FROM php:8.2-cli

# Instala dependências
RUN apt-get update && apt-get install -y \
    libpq-dev git unzip curl libzip-dev zip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www

# Copia tudo (de forma simples, pois volume vai sobrescrever em dev)
COPY . .

# Ajusta permissões
RUN chown -R www-data:www-data /var/www
