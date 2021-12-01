web: composer production-script && $(composer config bin-dir)/heroku-php-nginx -C nginx_app.conf public
scheduler: php -d memory_limit=512M artisan schedule:daemon