# Use an official PHP runtime as the base image
FROM php:7.4-apache

# Change the document root of Apache to /var/www/html/templates
ENV APACHE_DOCUMENT_ROOT /var/www/html/templates

# Update Apache configuration
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN apt-get update && \
    apt-get install -y libzip-dev && \
    docker-php-ext-install zip
# Copy the current directory contents into the container
COPY . /var/www/html/

# Expose port 80
EXPOSE 80

# Start Apache service
CMD ["apache2-foreground"]
