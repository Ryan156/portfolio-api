FROM richarvey/nginx-php-fpm:8.3

COPY . /var/www/html

COPY .docker/nginx-site.conf /etc/nginx/sites-available/default.conf

RUN chmod +x /var/www/html/render-build.sh

CMD ["/var/www/html/render-build.sh"]
