#!/usr/bin/env bash

apt-get update
apt-get install git

pecl install xdebug

echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20160303/xdebug.so" >> $PHP_INI_DIR/conf.d/xdebug.ini
# Enable Remote xdebug
# Enable Remote xdebug
echo "xdebug.idekey = PHPSTORM" >> $PHP_INI_DIR/conf.d/xdebug.ini
echo "xdebug.default_enable = 0" >> $PHP_INI_DIR/conf.d/xdebug.ini
echo "xdebug.remote_enable = 1" >> $PHP_INI_DIR/conf.d/xdebug.ini
echo "xdebug.remote_autostart = 0" >> $PHP_INI_DIR/conf.d/xdebug.ini
echo "xdebug.remote_connect_back = 0" >> $PHP_INI_DIR/conf.d/xdebug.ini
echo "xdebug.profiler_enable = 0" >> $PHP_INI_DIR/conf.d/xdebug.ini
echo "xdebug.remote_host = 10.254.254.254" >> $PHP_INI_DIR/conf.d/xdebug.ini
echo "xdebug.remote_port = 9001" >> $PHP_INI_DIR/conf.d/xdebug.ini

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --install-dir=bin --filename=composer
php -r "unlink('composer-setup.php');"

PATH=/root/.composer/vendor/bin:$PATH
