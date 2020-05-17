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
Route::POST('/google_signup', 'Controller@google_signup');

Route::middleware('auth:api')->group(function () {
    Route::get('/logout', 'Controller@logout');
    Route::put('/change-password', 'Controller@change_password');
    Route::put('/update-profile', 'Controller@update_profile');
    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::get('/points', function (Request $request) { return $request->user()->points; });


    Route::POST('/create_user', 'Controller@create_user');


    Route::GET('/get_active_advertisements', 'CompanyController@get_active_advertisements');
    Route::GET('/advertisements', 'CompanyController@get_advertisements');
    Route::GET('/have_charity_advertisements', 'CompanyController@get_have_charity_advertisements');
    Route::GET('/advertisement/{advertisement}', 'CompanyController@show_advertisement');
    Route::GET('/advertisements/{company}', 'CompanyController@get_own_advertisements');
    Route::GET('/get_companies', 'CompanyController@get_companies');
    Route::POST('/set_up_company/{user}', 'CompanyController@set_up_company');
    Route::POST('/advertisement/{user}', 'CompanyController@upload_advertisement');
    Route::PUT('/approve-advertisement/{advertisement}', 'CompanyController@approve_advertisement');
    Route::PUT('/reject-advertisement/{advertisement}', 'CompanyController@reject_advertisement');
    Route::PUT('/approve-company/{company}', 'CompanyController@approve_company');
    Route::PUT('/reject-company/{company}', 'CompanyController@reject_company');


    Route::GET('/feeds', 'CharityController@get_feeds');
    Route::GET('/get_supports/{charity}', 'CharityController@get_supports');
    Route::GET('/charities', 'CharityController@get_charities');
    Route::GET('/charity/{charity}', 'CharityController@show');
    Route::GET('/event/{event}', 'CharityController@show_event');
    Route::GET('/events', 'CharityController@get_events');
    Route::GET('/events/{charity}', 'CharityController@get_own_events');
    Route::GET('/achievement/{achievement}', 'CharityController@show_achievement');
    Route::GET('/achievements', 'CharityController@get_achievements');
    Route::GET('/achievements/{charity}', 'CharityController@get_own_achievements');
    Route::POST('/set_up_charity/{user}', 'CharityController@set_up_charity');
    Route::POST('/achievement/{user}', 'CharityController@upload_achievement');
    Route::POST('/event/{user}', 'CharityController@upload_event');
    Route::POST('/donate/{user}', 'CharityController@donate');
    Route::PUT('/approve-charity/{charity}', 'CharityController@approve_charity');
    Route::PUT('/reject-charity/{charity}', 'CharityController@reject_charity');
    Route::DELETE('/charity', 'CharityController@delete_charity');

    
    Route::GET('/get_points/{user}', 'PhilanthropistController@get_points');
    Route::GET('/get_philanthropists', 'PhilanthropistController@get_philanthropists');
    Route::POST('/set_up_philanthropist/{user}', 'PhilanthropistController@set_up_philanthropist');
    

    Route::GET('/payment-record/{advertisement}', 'CompanyAdvertisementPaymentController@get_payment_record');
    Route::GET('/payment-record-company/{company}', 'CompanyAdvertisementPaymentController@get_payment_record_company');
    Route::POST('/payment', 'CompanyAdvertisementPaymentController@store');

    
});

// 
//     Route::get('/logout', 'Controller@logout');
//     Route::POST('/change_password', 'Controller@change_password');
//     Route::POST('/validate_charity', 'Controller@validate_charity');
//     Route::POST('/validate_philanthropist', 'Controller@validate_philanthropist');
//     Route::GET('/get_profile', 'Controller@get_profile');
//     Route::GET('/watch_count', 'Controller@watch_count');
//     Route::POST('/set_up_company', 'CompanyController@set_up_company');
//     Route::POST('/upload_advertisement', 'CompanyController@upload_advertisement');
//     Route::POST('/approve_company', 'CompanyController@approve_company');
//     Route::POST('/delete_company', 'CompanyController@delete_company');
//     Route::POST('/approve_advertisement', 'CompanyController@approve_advertisement');
//     Route::POST('/delete_advertisement', 'CompanyController@delete_advertisement');
//     Route::GET('/get_own_advertisements', 'CompanyController@get_own_advertisements');
//     Route::GET('/get_views', 'CompanyController@get_views');
//     Route::POST('/approve_charity', 'CharityController@approve_charity');
//     Route::GET('/get_own_achievements', 'CharityController@get_own_achievements');
//     Route::GET('/get_own_events', 'CharityController@get_own_events');
//     Route::GET('/get_achievements', 'CharityController@get_achievements');
//     Route::GET('/get_events', 'CharityController@get_events');
//     Route::GET('/get_active_charities', 'CharityController@get_active_charities');
//     Route::GET('/get_donations', 'WatchLogController@get_donations');
//     Route::GET('/get_admin_donations', 'WatchLogController@get_admin_donations');
//     Route::GET('/get_supports', 'WatchLogController@get_supports');

