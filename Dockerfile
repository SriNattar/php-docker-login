FROM php:8.2-cli

WORKDIR /app

# Copy only application files (keep build context small)
COPY src/ /app

# Install PostgreSQL client dev headers and PHP pgsql extensions
RUN apt-get update \
    && apt-get install -y --no-install-recommends libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

EXPOSE 8080
# Built-in server for development only; use php-fpm + nginx in production
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/app"]
