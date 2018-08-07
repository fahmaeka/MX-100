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


### API Routes
| HTTP Method	| Path | Action | Scope | Desciption  |
| ----- | ----- | ----- | ---- |------------- |
| GET      | /proposal | index | proposal:list | Get all proposal
| GET      | /proposal?jobs_code | index | proposal:params | Get proposal detail and get all freelancer partisipan
| POST     | /proposal | store | proposal:store | Create an proposal with authenticated
| GET      | /proposal/{user_id} | show | proposal:read |  Fetch an jobs by id with authenticated
| POST      | /login | index | login:index | Login freelance / companya to get api_token
| POST      | /register-company | index | login:registerFreelancer | create freelance and get api_token
| POST      | /register-freelance | index | login:registerCompany | create company and get api_token



#### Codeception
TDD from MX100:
```bash
$ vendor/bin/codecept run api
```