<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes: https://laravel.su/docs/6.x/routing
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Аутентификация
Route::post('login', 'Auth\LoginController@apilogin');
// curl -X POST -H 'Content-Type: application/json' -i 'http://laravel.loc/api/login' --data '{"email": "1@1.ru", "password": "11111111" }'

// /api/towns
Route::get('towns', 'Api\TownController@index');    // Получение списка Городов
Route::get('towns/{town_id}', 'Api\TownController@show');
Route::get('towns/{town_id}/deps', 'Api\TownController@deps');  // Получение списка Подразделений в конкретном Городе
/*
Пользователи не могут удалять/изменять Города или добавлять новые
Route::post('towns', 'Api\TownController@store');
Route::put('towns/{town_id}', 'Api\TownController@update');
Route::patch('towns/{town_id}', 'Api\TownController@update');
Route::delete('towns/{town_id}', 'Api\TownController@delete');
*/

// /api/deps
// Получение списка Подразделений, принадлежащих тому же Юридическому лицу, что и текущий Пользователь
Route::middleware('auth:api')->get('deps', 'Api\DepController@index');
// информации о Подразделении (из списка своего юрлица)
Route::middleware('auth:api')->get('deps/{dep_id}', 'Api\DepController@show')->where('dep_id', '[0-9]+');
// Получение информации о Юридическом лице конкретного Подразделения
Route::get('deps/{dep_id}/firma', 'Api\DepController@firma')->where('dep_id', '[0-9]+');
// Добавление Подразделений
Route::middleware('auth:api')->post('deps', 'Api\DepController@store');
// изменение Подразделений
Route::middleware('auth:api')->put('deps/{dep_id}', 'Api\DepController@update')->where('dep_id', '[0-9]+');
Route::middleware('auth:api')->patch('deps/{dep_id}', 'Api\DepController@update')->where('dep_id', '[0-9]+');
// удаление Подразделений
Route::middleware('auth:api')->delete('deps/{dep_id}', 'Api\DepController@delete')->where('dep_id', '[0-9]+');
// Получение списка Городов Подразделений, принадлежащих тому же Юридическому лицу, что и текущий Пользователь
Route::middleware('auth:api')->get('deps/towns', 'Api\DepController@towns');


// /api/users
// Получение списка Пользователей, принадлежащих тому же Юридическому лицу, что и текущий Пользователь
Route::middleware('auth:api')->get('users', 'Api\UserController@index');
// информации о пользователе (из списка своего юрлица)
Route::middleware('auth:api')->get('users/{user_id}', 'Api\UserController@show');
// Добавление Пользователей
Route::middleware('auth:api')->post('users', 'Api\UserController@store');
// Изменение Пользователей
Route::middleware('auth:api')->put('users/{user_id}', 'Api\UserController@update');
Route::middleware('auth:api')->patch('users/{user_id}', 'Api\UserController@update');
// Удаление Пользователей
Route::middleware('auth:api')->delete('users/{user_id}', 'Api\UserController@delete');
