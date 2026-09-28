FROM php:8.2-apache

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo_mysql zip \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure PHP settings
RUN echo "output_buffering = 4096" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize = 32M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size = 32M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/custom.ini

# Set working directory
WORKDIR /var/www/html

# Copy application source code
COPY . /var/www/html/

# Create required upload directories and grant Apache ownership
RUN mkdir -p /var/www/html/assets/qr_img \
    /var/www/html/assets/image/student_photo \
    /var/www/html/assets/image/profile_image/parent \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/assets

EXPOSE 80

CMD ["apache2-foreground"]
