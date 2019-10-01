FROM php:7.0-apache
run apt-get update && apt-get install libfontconfig nano -y
COPY src/ /var/www/html/
COPY config/php.ini /usr/local/etc/php/
RUN chown root /var/www/html/*
RUN chmod 655 /var/www/html/*
RUN chmod 777 /var/www/html/images/
