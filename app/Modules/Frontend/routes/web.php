<?php

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

Auth::routes();
Route::get('/welcome', function(){
    echo "Welcome Quiz";
});
Route::group(
    [
        'middleware' => ['web'],
        'namespace'=>'App\Modules\Frontend\Controllers',
    ], function(){

    Route::get('/', ['as' => 'home','uses' => 'HomeController@index']);
    Route::get('/login',['as' => 'loginUser','uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('/login',['as' => 'loginUser','uses' => 'Auth\LoginController@login']);
    Route::get('/register',['as' => 'registerUser','uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('/register',['as' => 'registerUser','uses' => 'Auth\RegisterController@register']);
    Route::post('logout',['as' => 'logoutUser','uses' => 'Auth\LoginController@logout']);
    }
);
