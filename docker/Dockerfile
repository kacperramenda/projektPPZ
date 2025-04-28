# Użyj oficjalnego obrazu PHP z rozszerzeniami
FROM php:8.1-fpm

# Instalacja zależności systemowych
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git libmcrypt-dev libicu-dev

# Instalacja Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalacja Node.js i NPM (w zależności od potrzeb)
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && apt-get install -y nodejs

# Ustawienia katalogu roboczego
WORKDIR /var/www/html

# Kopiowanie plików projektu
COPY . .

# Instalacja zależności PHP i frontendowych
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Uruchomienie PHP-FPM
CMD ["php-fpm"]
