# FitnessCenter

## Description

A Proof-of-concept of a running Symfony 5 application inside containers, with MVC software design pattern and SQL database querying.

It is composed by 4 containers:

- `nginx`, acting as the webserver with a **nginx:1.19.4-alpine** image.
- `php-fpm`, the PHP-FPM container with a **php:7.4-fpm** image and **composer** which will run the app.
- `database` which is the MariaDB database container with a **mariadb:10.5** image.
- `phpMyAdmin` Which is used to administer the database easily **phpmyadmin:5.0.4** image.

## Installation

1. git clone https://github.com/AlnPir/FitnessCenter.git

2. cd FitnessCenter

3. Run `docker-compose up -d`

## Tips

phpMyAdmin access : http://localhost:8081/
App access : http://localhost/

root access DB : root root
user access DB : user user

user access app : user user
admin access app : admin admin
