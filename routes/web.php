<?php

use Illuminate\Support\Facades\Route;
use Zend\Debug\Debug;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth', 'permission']], function() {
        /**
         * Home Routes
         */
        Route::get('/', 'HomeController@index')->name('home.index');
        Route::get('/home', 'HomeController@index')->name('home.index');
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
        });

        /**
         * User Routes
         */
        Route::group(['prefix' => 'posts'], function() {
            Route::get('/', 'PostsController@index')->name('posts.index');
            Route::get('/create', 'PostsController@create')->name('posts.create');
            Route::post('/create', 'PostsController@store')->name('posts.store');
            Route::get('/{post}/show', 'PostsController@show')->name('posts.show');
            Route::get('/{post}/edit', 'PostsController@edit')->name('posts.edit');
            Route::patch('/{post}/update', 'PostsController@update')->name('posts.update');
            Route::delete('/{post}/delete', 'PostsController@destroy')->name('posts.destroy');
        });


        Route::get('/surat-masuk', 'SuratMasukController@index')->name('surat-masuk.index');
        Route::get('/surat-keluar', 'SuratKeluarController@index')->name('surat-keluar.index');
        Route::get('/arsip', 'ArsipController@index')->name('arsip.index');




        /**
         * API Routes
         */

        Route::group(['prefix' => 'api'], function() {
            Route::get('/user', [App\Http\Controllers\Api\UserController::class, 'index']);
            Route::post('/user', [App\Http\Controllers\Api\UserController::class, 'addUser']);
            Route::put('/user/{user_id}', [App\Http\Controllers\Api\UserController::class, 'editUser']);
            Route::delete('/user/{user_id}', [App\Http\Controllers\Api\UserController::class, 'deleteUser']);

            Route::get('/role', [App\Http\Controllers\Api\RoleController::class, 'index']);
            Route::post('/role', [App\Http\Controllers\Api\RoleController::class, 'addRole']);
            Route::put('/role/{role_id}', [App\Http\Controllers\Api\RoleController::class, 'editRole']);
            Route::delete('/role/{role_id}', [App\Http\Controllers\Api\RoleController::class, 'deleteRole']);
        });

        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    });
});