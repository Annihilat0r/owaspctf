#!/bin/bash

set -e

chown -R mysql:mysql /var/lib/mysql
chown -R mysql:mysql /var/run/mysqld
chown -R mysql:mysql /var/log/mysql
ln -sf /usr/share/zoneinfo/Europe/Kiev /etc/localtime
service mysql restart

while true; do
    sleep 5
    service mysql status
done
