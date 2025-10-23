# Simple Dockerfile for Render deployment
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (essential only)
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application code
COPY . .

# Run composer scripts
RUN composer run-script post-autoload-dump

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage
RUN chmod -R 755 /var/www/bootstrap/cache

# Expose port (Render uses $PORT environment variable)
EXPOSE $PORT

# Start PHP built-in server
CMD php artisan serve --host=0.0.0.0 --port=$PORT
