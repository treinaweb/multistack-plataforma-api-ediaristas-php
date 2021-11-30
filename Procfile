web: composer production-script && $(composer config bin-dir)/heroku-php-apache2 public
scheduler: php -d memory_limit=512M artisan schedule:daemon