FROM php:7.2-apache
run apt-get update && apt-get install libfontconfig nano -y
COPY src/ /var/www/html/
COPY config/php.ini /usr/local/etc/php/
RUN echo 'FLAG{Path_to_the_dark_side}' >> /etc/passwd
