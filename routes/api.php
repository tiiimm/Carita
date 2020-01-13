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
Route::POST('/create_user', 'Controller@create_user');
Route::POST('/set_up', 'Controller@set_up');
Route::POST('/set_up_company', 'CompanyController@set_up_company');
Route::POST('/validate_charity', 'Controller@validate_charity');
Route::POST('/validate_philanthropist', 'Controller@validate_philanthropist');
Route::POST('/upload_achievement', 'CharityController@upload_achievement');
Route::POST('/upload_event', 'CharityController@upload_event');
Route::POST('/upload_advertisement', 'CompanyController@upload_advertisement');
Route::POST('/donate', 'CharityController@donate');
Route::POST('/approve_charity', 'CharityController@approve_charity');

Route::GET('/get_profile', 'Controller@get_profile');
Route::GET('/get_own_achievements', 'CharityController@get_own_achievements');
Route::GET('/get_own_events', 'CharityController@get_own_events');
Route::GET('/get_own_advertisements', 'CompanyController@get_own_advertisements');
Route::GET('/get_achievements', 'CharityController@get_achievements');
Route::GET('/get_events', 'CharityController@get_events');
Route::GET('/get_advertisements', 'CompanyController@get_advertisements');
Route::GET('/get_charities', 'CharityController@get_charities');
Route::GET('/get_active_charities', 'CharityController@get_active_charities');
Route::GET('/get_companies', 'CompanyController@get_companies');
Route::GET('/get_philanthropists', 'Controller@get_philanthropists');
Route::GET('/get_donations', 'WatchLogController@get_donations');
Route::GET('/get_supports', 'WatchLogController@get_supports');
Route::GET('/watch_count', 'Controller@watch_count');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
