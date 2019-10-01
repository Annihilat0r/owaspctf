FROM php:7.0-apache
run apt-get update && apt-get install libfontconfig gnupg nano python git wget -y
COPY opt/ /opt/
RUN tar xvjC /opt/ -f /opt/phantom.tar.bz2
COPY config/php.ini /usr/local/etc/php/
run ln -sf /opt/phantomjs/bin/phantomjs /usr/local/bin/phantomjs
run apt-get install git python -y
run cd /opt/ && git clone git://github.com/casperjs/casperjs.git
run ln -sf /opt/casperjs/bin/casperjs /usr/local/bin/casperjs
run ln -sf /opt/phantomjs-2.1.1-linux-x86_64/bin/phantomjs /usr/local/bin/phantomjs
COPY src/ /var/www/html/
run mkdir -p /var/www/html/report_to_support_/
run chown www-data /var/www/html/report_to_support_/
EXPOSE 80
