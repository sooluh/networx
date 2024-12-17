FROM pratamatechsolution/frankenphp:8.2
COPY . /app

RUN composer install --no-ansi --no-dev --no-interaction \
    --no-plugins --no-progress --optimize-autoloader
RUN chmod -R 777 storage
RUN php artisan storage:link
