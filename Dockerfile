# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
RUN npm install --prefer-offline --no-audit
RUN npm run build

# Ensure static assets are accessible (CSS/Images/Fonts)
# Set directory permissions to 755 and file permissions to 644 recursively
RUN if [ -d public/images ]; then \
      find public/images -type d -exec chmod 755 {} \; && \
      find public/images -type f -exec chmod 644 {} \; && \
      chown -R www-data:www-data public/images; \
    fi
RUN if [ -d public/css ]; then \
      chmod 644 public/css/* || true && \
      chown -R www-data:www-data public/css; \
    fi
RUN if [ -d public/font ]; then \
      chmod 644 public/font/* || true && \
      chown -R www-data:www-data public/font; \
    fi

# Create storage directories and set permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Create SQLite database
RUN touch database/database.sqlite \
    && chmod 664 database/database.sqlite \
    && chown www-data:www-data database/database.sqlite

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache DocumentRoot to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy custom Apache config
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n\
\n\
<Directory /var/www/html/public/css>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride None\n\
    Require all granted\n\
</Directory>\n\
\n\
<Directory /var/www/html/public/js>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride None\n\
    Require all granted\n\
</Directory>\n\
\n\
<Directory /var/www/html/public/images>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride None\n\
    Require all granted\n\
</Directory>\n\
\n\
<Directory /var/www/html/public/font>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride None\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf

RUN a2enconf laravel

# Expose port (Cloud Run sets PORT env var, defaults to 8080)
EXPOSE 8080

# Start Laravel development server (Cloud Run compatible)
# Note: Cloud Run will set PORT environment variable dynamically (but we use 8080 as default)
CMD php artisan migrate --force && php artisan config:cache && php -S 0.0.0.0:8080 -t public

