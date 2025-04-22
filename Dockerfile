# Use the official PHP image with Apache
FROM php:8.1-apache

# Install mysqli extension for MySQL support
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy all your project files to the Apache web root
COPY . /var/www/html/

# Enable Apache URL rewriting (optional, only needed for .htaccess and pretty URLs)
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html
