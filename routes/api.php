<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::POST('/register', 'Auth\RegisterController@validator');
Route::POST('/login', 'Auth\LoginController@login');
Route::POST('/set_up', 'Controller@set_up');
Route::POST('/validate_charity', 'Controller@validate_charity');
Route::POST('/validate_philanthropist', 'Controller@validate_philanthropist');
Route::POST('/upload_achievement', 'CharityController@upload_achievement');

Route::GET('/get_profile', 'Controller@get_profile');
Route::GET('/get_own_achievements', 'CharityController@get_own_achievements');
Route::GET('/get_achievements', 'CharityController@get_achievements');
Route::GET('/get_charities', 'CharityController@get_charities');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
