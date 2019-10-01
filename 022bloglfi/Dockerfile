FROM php:7.3.9-apache
run apt-get update && apt-get install nano -y
COPY src/ /var/www/html/
RUN chmod -R 777 /var/www/html/ViroCMS/
