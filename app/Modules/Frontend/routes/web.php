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

Route::get('/welcome', function(){
    echo "Welcome Quiz";
});
Route::group(
    [
        'middleware' => ['web'],
        'namespace'=>'App\Modules\Frontend\Controllers',
    ], function(){
    //password
    Auth::routes([
        'loginFrontend' => true,
        'registerFrontend' => true,
        'resetFrontend' => true,
        'verifyFrontend' => true,
    ]);
    //home
    Route::get('/', ['as' => 'home','uses' => 'HomeController@index'])->middleware('verified');
    //login register and logout
    //login with facebook
    Route::get('/redirect/{social}',['as' => 'redirect.social','uses' => 'Auth\SocialAuthController@redirect']);
    Route::get('/callback/{social}',['as' => 'callback.social','uses' => 'Auth\SocialAuthController@callback']);
    }
);
