##  User Time Table Management System
a simple system for managing user TimeTable 

--------------------------------------------------

## installation

1. clone the repo

2. `cd projectname` .

3. run `composer install` .

4. configure appURl , database & APIKEY in `.env` file .

5. migrate database  `php artisan migrate --seed`

6. run `php artisan serve` to serve ,
   or you can set your server index path to `public` folder to serve it without the need to run the command.
--------------------------------------------------

## login 
localhost/admin/login
Admins's credentials: user@user.com - 123456
--------------------------------------------------
localhost//login
User's credentials: admin@admin.com - 123456
--------------------------------------------------
## requirements

1. laravel 9 server requirements [here](https://laravel.com/docs/9.x#server-requirements) .
2. composer dependency manager [here](https://getcomposer.org/).
--------------------------------------------------

## Demo

`http://timetable.i3rby.com/` [here](http://timetable.i3rby.com/).

> by @adelezzatl