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

Route::get('/', 'PageController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/phpinfo','HomeController@phpinfo')->name('phpinfo');
Route::get('/test','HomeController@test')->name('test');

// DataController
Route::get('/data/addmylapsdata', 'DataController@addMylapsData')->name('addtrackdatamylaps');
Route::get('/data/addrace', 'DataController@addRace')->name('addrace');
Route::post('/data/addraceprocess', 'DataController@addRaceProcess')->name('addraceprocess');
Route::post('/data/addmylapsdataconfirm', 'DataController@addMylapsDataConfirm')->name('addmylapsdataconfirm');
Route::post('/data/addtrackdataprocess', 'DataController@addMylapsDataProcess')->name('addmylapsdataprocess');
Route::get('/data/edit/mylapsdata/{id}', 'DataController@editMylapsData')->name('editmylapsdata');
Route::get('/data/delete/race/{id}', 'DataController@deleteRace')->name('deleterace');

Route::get('/data/addhardcarddata', 'DataController@addHardcardData')->name('addtrackdatahardcard');
Route::post('/data/addhardcarddataconfirm', 'DataController@addHardcardDataConfirm')->name('addhardcarddataconfirm');
Route::post('/data/addhardcarddataprocess', 'DataController@addHardcardDataProcess')->name('addhardcarddataprocess');
Route::get('/data/edit/hardcarddata/{id}', 'DataController@editHardcardData')->name('edithardcarddata');

Route::get('/data/teams', 'DataController@teams')->name('teams');
Route::get('/data/addteams', 'DataController@addTeams')->name('addteams');
Route::post('/data/addteamsconfirm', 'DataController@addTeamsConfirm')->name('addteamsconfirm');
Route::post('/data/addteamsrocess', 'DataController@addTeamsProcess')->name('addteamsprocess');
Route::post('/data/addoneprocess', 'DataController@addOneTeamsProcess')->name('addoneprocess');

Route::get('/data/teams/delete/{id}', 'DataController@deleteTeam')->name('deleteteam');
Route::post('/data/teams/edit/{id}', 'DataController@editTeam')->name('editteam');
