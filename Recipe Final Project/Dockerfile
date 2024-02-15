FROM php:8.0-apache

# Install PDO MySQL extension to interact with MySQL
RUN docker-php-ext-install pdo_mysql

# Install MySQL client
RUN apt-get update \
    && apt-get install -y default-mysql-client


# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Set ServerName to suppress FQDN warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy your PHP files to the default Apache serve directory
COPY ./*.php /var/www/html/

# Copy your CSS and other static files
COPY ./*.css /var/www/html/
COPY header.html /var/www/html/

# Expose port 80 for the Apache server
EXPOSE 80
