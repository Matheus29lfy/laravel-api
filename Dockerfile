# Dockerfile
FROM php:8.2-fpm

# Instala extensões necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev git unzip curl libzip-dev zip \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia os arquivos
COPY . .

# Instala dependências
RUN composer install --optimize-autoloader --no-dev

# Permissões
RUN chown -R www-data:www-data /var/www

CMD ["php-fpm"]
