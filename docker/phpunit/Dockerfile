# Use an official PHP image as the base
FROM php:8.4-cli

# Set environment variables
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="/root/.composer/vendor/bin:/app/vendor/bin:$PATH"

# Install necessary system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && apt-get clean

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /app

# Copy composer.json to the container
COPY composer.json ./

# Install dependencies from composer.json
RUN composer install --prefer-dist --no-interaction

# Explicitly update
RUN composer update

# Expose the app directory for mounting source and test files
VOLUME ["/app"]

# Default command to keep the container running
ENTRYPOINT ["tail", "-f", "/dev/null"]
