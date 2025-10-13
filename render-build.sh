#!/usr/bin/env bash
# Render.com build script for Laravel

set -e

echo "🚀 Starting Render build process..."

# Install PHP if needed
echo "🔍 Checking PHP installation..."
if ! command -v php &> /dev/null; then
    echo "❌ PHP not found. Please set Environment to 'docker' in Render settings."
    exit 1
fi

# Install Composer
echo "📦 Installing Composer..."
if ! command -v composer &> /dev/null; then
    EXPECTED_CHECKSUM="$(php -r 'copy("https://composer.github.io/installer.sig", "php://stdout");')"
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

    if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]; then
        echo "❌ Invalid Composer installer"
        rm composer-setup.php
        exit 1
    fi

    php composer-setup.php --quiet
    rm composer-setup.php
    export PATH="$PATH:$PWD"
    alias composer="php composer.phar"
    COMPOSER_CMD="php composer.phar"
else
    COMPOSER_CMD="composer"
fi

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
$COMPOSER_CMD install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
echo "📦 Installing NPM dependencies..."
npm install --prefer-offline --no-audit

echo "🏗️  Building frontend assets..."
npm run build

# Create necessary directories
echo "📁 Creating storage directories..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
echo "🔐 Setting permissions..."
chmod -R 775 storage bootstrap/cache

# Create SQLite database
echo "💾 Creating SQLite database..."
touch database/database.sqlite
chmod 664 database/database.sqlite

# Run migrations
echo "🗄️  Running migrations..."
php artisan migrate --force --no-interaction

# Link storage
echo "🔗 Linking storage..."
php artisan storage:link || true

echo "✅ Build complete!"
