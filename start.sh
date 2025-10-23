#!/bin/bash
echo "Starting CarbonWallet application..."

# Check if we're in Docker mode
if [ -f "/.dockerenv" ]; then
    echo "Running in Docker mode - starting PHP-FPM and Nginx"
    php-fpm -D && nginx -g 'daemon off;'
else
    echo "Running in Node.js environment - installing PHP and starting Laravel"

    # Install PHP if not available
    if ! command -v php &> /dev/null; then
        echo "Installing PHP..."
        curl -fsSL https://packages.sury.org/php/apt.gpg | apt-key add -
        echo "deb https://packages.sury.org/php/ bullseye main" | tee /etc/apt/sources.list.d/sury-php.list
        apt-get update
        apt-get install -y php8.2-cli php8.2-mbstring php8.2-xml php8.2-curl php8.2-sqlite3
    fi

    # Install Composer if not available
    if ! command -v composer &> /dev/null; then
        echo "Installing Composer..."
        curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    fi

    # Install PHP dependencies
    echo "Installing PHP dependencies..."
    composer install --no-dev --optimize-autoloader

    # Start Laravel development server
    echo "Starting Laravel server..."
    php artisan serve --host=0.0.0.0 --port=$PORT
fi
