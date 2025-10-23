#!/bin/bash
set -e

echo "Installing Node.js dependencies..."
npm install

echo "Building assets..."
npm run build

echo "Installing PHP..."
apt-get update && apt-get install -y php-cli php-mbstring php-xml php-curl

echo "Installing Composer..."
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "Build completed successfully!"
