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
Route::get('/home', function(){
    echo "Welcome Quiz Admin";
});

Route::group(
    [   'middleware' => ['web'],
        'namespace'=>'Controllers',
    ], function(){
        //password
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('backend.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('backend.password.email');
    //reset password
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('backend.password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('backend.password.reset');
    //verify email when register
    Route::get('email/verify', 'Auth\VerificationController@show')->name('backend.verification.notice');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('backend.verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('backend.verification.resend');

    Route::get('/dash_board', ['as' => 'admin.dash_board','uses' => 'HomeController@index']);
    Route::get('login',['as' => 'login','uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login',['as' => 'login','uses' => 'Auth\LoginController@login']);
    Route::get('register',['as' => 'register','uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('register',['as' => 'register','uses' => 'Auth\RegisterController@register']);
    Route::post('logout',['as' => 'logout','uses' => 'Auth\LoginController@logout']);
}
);

