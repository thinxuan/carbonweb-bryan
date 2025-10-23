#!/bin/bash
set -e

echo "Installing Node.js dependencies..."
npm install

echo "Building assets..."
npm run build

echo "Installing PHP and Composer..."
# Install PHP 8.2
curl -fsSL https://packages.sury.org/php/apt.gpg | apt-key add -
echo "deb https://packages.sury.org/php/ bullseye main" | tee /etc/apt/sources.list.d/sury-php.list
apt-get update
apt-get install -y php8.2-cli php8.2-mbstring php8.2-xml php8.2-curl php8.2-sqlite3 php8.2-zip

# Install Composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "Build completed successfully!"
