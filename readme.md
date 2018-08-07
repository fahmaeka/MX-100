# MX100 - API Job Portal

As back end developer you must provide API to
● Enable freelance to submit proposal to jo post
● Enable company to view proposal for their job post

## Getting Started

First, clone the repo:
```bash
$ git clone https://github.com/fahmaeka/MX-100.git
$ cd MX100
```

#### Lummen Homestead
You can use Laravel Homestead globally or per project for local development. Follow the [Installation Guide](https://lumen.laravel.com/docs/5.3/installation).


#### Configure the Environment
Edit `.env` file:
```
$ nano .env
```
If you want you can edit database name, database username and database password.


#### Import databases
Run code on terminal:
```
$ mysql -u <username> -p <databasename> < <filename.sql>
```
If you want you can edit database name, database username and database password.


#### Or, Migrations the database
Run the Artisan migrate command:
```bash
$ php artisan migrate
```


#### Running Server
Run the code:
```bash
$ php -S localhost:2000 -t public
```


#### Codeception
TDD from MX100:
```bash
$ vendor/bin/codecept run api
```