FROM php:8.3-apache

# Dockerfile's Metadata
LABEL name="PulseGDPS" \
      description="A self-hosted Geometry Dash private server"

# Install necessary dependencies
RUN apt-get update && apt-get install -y --no-install-recommends libpq-dev && \
    docker-php-ext-install pdo pdo_mysql pdo_pgsql && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Set the working directory
WORKDIR /var/www/html

# Build the checked-out PulseGDPS source, including its database and companion
# service configuration, rather than cloning the upstream base at build time.
COPY --chown=www-data:www-data . /var/www/html

# Export Apache's port
EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
  CMD php /var/www/html/health.php || exit 1

# Start Apache
CMD ["apache2-foreground"]
