FROM php:7.2-apache
run apt-get update && apt-get install libfontconfig nano -y
COPY src/ /var/www/html/
COPY config/php.ini /usr/local/etc/php/
