# README #

This README would normally document whatever steps are necessary to get your application up and running.

### What is this repository for? ###

* Quick summary
* Version  ``1.1.1``

* [Learn Markdown](https://bitbucket.org/tutorials/markdowndemo)

### How do I get set up? ###
* Summary of set up
```
#!git
git init
git remote add origin https://alex2cs@bitbucket.org/alex2cs/2017_alex.git
git fetch && git checkout master
-- Pass: Alex2cs
php composer.phar update

chmod -R 777 storage
chcon -t httpd_sys_rw_content_t storage -R
php artisan cache:clear
```
* Database configuration
```
#!manual job
copy .env.example .env
vi .env
-- edit it
:x 
-- pentru save & exit
```
* How to run tests
``` php phpunit ```
* Deployment instructions

```
#!git
artisan down

git pull
php composer.phar update
-- ATENTIE la modificari de DB
php artisan migrate:state 
phpunit

artisan up
```


### Contribution guidelines ###

* Writing tests
* Code review
* Other guidelines

### Who do I talk to? ###

* Repo owner or admin
* Other community or team contact