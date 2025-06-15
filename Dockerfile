FROM richarvey/nginx-php-fpm:1.7.2

COPY . /var/www/html

# Ensure correct working directory
WORKDIR /var/www/html

ENV WEBROOT /var/www/html/public
ENV SKIP_COMPOSER 0
ENV RUN_SCRIPTS 1

# Laravel config
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV COMPOSER_ALLOW_SUPERUSER=0

CMD ["/start.sh"]
