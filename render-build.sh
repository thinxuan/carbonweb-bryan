#!/usr/bin/env bash
# Render.com build script for Laravel

set -e

echo "🚀 Starting Render build process..."

# Install PHP dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

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

