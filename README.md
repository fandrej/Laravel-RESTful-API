## Laravel RESTful API

[Техническое задание](https://docs.google.com/document/d/12pf7fx3tTC9Vlk4-h0vWRxQHAEgWJBzsUa_IH6LcC4Y/edit)<br/>
[Результат: описание API с примерами](api.md)


### Стек
- PHP 7.4
- PostgreSQL 9.6.19
- Apache 2.4

### Database
database/pronkers.sql

#### Create database
sudo -u postgres psql
```SQL
CREATE DATABASE pronkers;
CREATE USER pronkers WITH ENCRYPTED PASSWORD 'pronkers';
GRANT ALL PRIVILEGES ON DATABASE pronkers TO pronkers;
\i full_path_and_file_name_with_extension_to database/pronkers.sql
```
or use `php artisan migrate`

### Models
(app/)
- Deptown.php  
- Firm.php
- User.php
- Dep.php
- Town.php

### Controllers
(app/Http/Controllers/Api/)
- [DepController.php](app/Http/Controllers/Api/DepController.php)  
- TownController.php  
- UserController.php

### Laravel modified files
- .env
- config/database.php
- app/User.php
- app/Http/Controllers/Auth/LoginController.php
- app/Http/Controllers/Auth/RegisterController.php
- routes/web.php
- routes/api.php

### Laravel additions
```sh
php artisan make:auth
php artisan migrate
```
If error: *Command "make:auth" is not defined*, do:
```sh
composer require laravel/ui
npm install && npm run dev
php artisan ui vue --auth
php artisan migrate
```
