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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home','ReportController@index');
    Route::get('/', 'ReportController@index');
    Route::get('/report', 'ReportController@index');
    Route::post('/new_remarks', 'RemarkController@store');
    Route::post('/update_remarks/{id}', 'RemarkController@update');
    Route::post('/notifications/mark-as-read/{id}', 'NotificationController@markAsRead')->name('notifications.markAsRead');



    Route::get('/gp-report','GPReportController@index');
});