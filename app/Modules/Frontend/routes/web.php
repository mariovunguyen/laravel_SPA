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

Auth::routes();//(['verify' => true]);
Route::get('/welcome', function(){
    echo "Welcome Quiz";
});
Route::group(
    [
        'middleware' => ['web'],
        'namespace'=>'App\Modules\Frontend\Controllers',
    ], function(){
    //password
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('frontend.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('frontend.password.email');
    //reset password
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('frontend.password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('frontend.password.reset');
    //verify email when register
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    //home
    Route::get('/', ['as' => 'home','uses' => 'HomeController@index'])->middleware('verified');
    //login register and logout
    Route::get('/login',['as' => 'loginUser','uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('/login',['as' => 'loginUser','uses' => 'Auth\LoginController@login']);
    Route::get('/register',['as' => 'registerUser','uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('/register',['as' => 'registerUser','uses' => 'Auth\RegisterController@register']);
    Route::post('logout',['as' => 'logoutUser','uses' => 'Auth\LoginController@logout']);
    //login with facebook
    Route::get('/redirect/{social}',['as' => 'redirect.social','uses' => 'Auth\SocialAuthController@redirect']);
    Route::get('/callback/{social}',['as' => 'callback.social','uses' => 'Auth\SocialAuthController@callback']);
    }
);
