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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/phpinfo','HomeController@phpinfo')->name('phpinfo');

// DataController
Route::get('/data/addtrackdata', 'DataController@addTrackData')->name('addtrackdata');
Route::post('/data/addtrackdataconfirm', 'DataController@addTrackDataConfirm')->name('addtrackdataconfirm');
Route::post('/data/addtrackdataprocess', 'DataController@addTrackDataProcess')->name('addtrackdataprocess');
