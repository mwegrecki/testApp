testApp
=======

#Test app description:

##Goal:
 - The goal is to create an API that will allow to create an article, answer to an article, rate an article (between 0 and 5 ==> 0, 1, 2, 3, 4, 5)
 - This API should also include to retrieve an article and all its answers
 - Write some unit tests.

##Bonus 1:
 - Write a front page that will allow us to write an article (keep it simple)

##Bonus 2:
 - Write a command that will send an email to the writer of an article if he has notifications from more than 24 hours.


#Installation
####install.sh
```sh
$ chmod 777 bin/install.sh
$ sh bin/install.sh
```

####Other way
```sh
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
$ ./app/console doctrine:database:drop --force
$ ./app/console doctrine:database:create
$ ./app/console doctrine:schema:create
$ ./app/console assetic:dump
$ ./app/console assets:install
```
# Accessing api:
$ ./app/console server:run
Open http://127.0.0.1:8000/api/doc in browser
All details are listed there.

# Runnng phpUnit tests:
(before running tests please set the KERNEL_DIR in phpunit.xml

for example:
<server name="KERNEL_DIR" value="/home/maciej/Symfony/2015/testApp/app" />

phpunit -c app/

### Version
1.0.0