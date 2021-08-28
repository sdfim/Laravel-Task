<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


# Install

`mkdir example-laravel`

`cd example-laravel`

`git clone git@github.com:sdfim/Laravel-Task.git .` 

`cp .env.example .env` 

fill in parameters in file: .env

`composer install` 

`php artisan migrate` 

## generate a seeders
`php artisan db:seed --class=PositionSeeder`

`php artisan db:seed --class=EmployeeSeeder`

## generate key
`php artisan key:generate`

## create a symbolic link from public/storage to storage/app/public
`php artisan storage:link`

---

# Steps to Building Laravel Project with AdminLTE and DataTables

## install Laravel
`composer create-project --prefer-dist laravel/laravel Laravel-Task`

`cd Laravel-Task`

## install AdminLTE 
- https://github.com/jeroennoten/Laravel-AdminLTE.git

- https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Installation

`composer require jeroennoten/laravel-adminlte`

`php artisan adminlte:install`

`composer require laravel/ui`

`php artisan ui vue --auth`

`php artisan adminlte:install --only=auth_views`


## Install DataTables Quick Starter package and publish assets
- https://yajrabox.com/docs/laravel-datatables/master/quick-starter

`composer require yajra/laravel-datatables`

`php artisan vendor:publish --tag=datatables-buttons`

## Install Datatables.net assets
`yarn add datatables.net-bs4 datatables.net-buttons-bs4`

## Edit webpack.mix.js 
```
mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/admin-lte/dist/js/adminlte.js',
    'node_modules/bootstrap/dist/js/bootstrap.js',
    'node_modules/datatables.net/js/jquery.dataTables.js',
    'node_modules/datatables.net-bs/js/dataTables.bootstrap.js',
    // other scripts
], 'public/js/all.min.js');
```
- use in home.blade.php

`<script src="{{ mix('js/app.js') }}"></script>`
`composer install`

`npm install`

`npm run dev`

## Generate a model and a migration, factory, seeder

`php artisan make:model Position -ms`

`php artisan make:model EmployeeName -mfs`

`php artisan make:model Employee -mfs`

- edit migration *_create_employees_table, factory, seeder
- edit migration *_create_employee_names_table, factory, seeder
- edit migration *_create_positions_table, seeder

## edit .evn for connectinng DB and run migrate

`php artisan migrate`

or

`php artisan migrate:fresh`

## generate a seeders
`php artisan db:seed --class=PositionSeeder`

`php artisan db:seed --class=EmployeeSeeder`

## generate key
`php artisan key:generate`

## create a symbolic link from public/storage to storage/app/public
`php artisan storage:link`

## Edit CRUD EmployeeController and PositionController


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
