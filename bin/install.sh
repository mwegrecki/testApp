#!/bin/sh
curl -sS https://getcomposer.org/installer | php
php composer.phar install

./app/console doctrine:database:drop --force
./app/console doctrine:database:create
./app/console doctrine:schema:create
./app/console assetic:dump
./app/console assets:install