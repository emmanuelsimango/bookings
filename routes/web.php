<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
        Route::resource('booking','BookingController',['names'=>['index'=>'booking']]);
        Route::get('booking/requests/{projectorId}','BookingController@requests');
        Route::get('booking/approve/{bookingId}','BookingController@approve');
        Route::get('booking/reject/{bookingId}','BookingController@destroy');
        Route::resource('projector', 'ProjectorController',['names'=>['index'=>'projector']]);
        Route::get("projector/request/{id}",'BookingController@request');
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
        Route::resource('department','DepartmentController',['names'=>['index'=>'department']]);
        Route::get('myProjectors','ProjectorController@myProjectors');
        Route::get('reports','BookingController@reports');
        Route::get('reports/today','BookingController@todayReports');
        Route::get('reports/thisWeek','BookingController@thisWeekReports');
        Route::get('reports/thisMonth','BookingController@thisMonthReports');
        Route::get('reports/thisYear','BookingController@thisYearReports');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

