#!/bin/bash
set -e

echo "Installing Node.js dependencies..."
npm install

echo "Building assets..."
npm run build

echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "Build completed successfully!"
