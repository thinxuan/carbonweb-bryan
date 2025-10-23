#!/bin/bash

# Create database directory if it doesn't exist
mkdir -p /tmp

# Create SQLite database file if it doesn't exist
touch /tmp/database.sqlite

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the server
php artisan serve --host=0.0.0.0 --port=$PORT
