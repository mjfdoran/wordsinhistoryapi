#!/usr/bin/env bash

sudo apt-get update
sudo apt-get install -y nginx
sudo apt-get install -y software-properties-common python-software-properties
sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get update
sudo apt-get -y install php7.0
sudo apt-get -y install vim
sudo service nginx restart
if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi

#cp /var/www/nginx_vhost /etc/nginx/sites-available/nginx_vhost > /dev/null
#ln -s /etc/nginx/sites-available/nginx_vhost /etc/nginx/sites-enabled/
#rm /etc/nginx/sites-enabled/default
#service nginx restart > /dev/null

#don't think i needed php7-mysql
#sudo apt-get install php7-mysql

sudo apt-get install php7.0-fpm
sudo apt-get install php7.0-mysql
sudo apt-get install pdo-mysql
cd /var/www
mv phpunit-6.5.8.phar phpunit
chmod +x phpunit
sudo mv phpunit /usr/local/bin/
sudo apt-get update
sudo apt-get install php7.0-xml
#chmod +x phpunit-6.5.phar
#sudo mv phpunit-6.5.phar /usr/local/bin/phpunit

sudo apt-get install mysql-server

#ssh vagrant@127.0.0.1 -p 2200

