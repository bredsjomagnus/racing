<?php

use Illuminate\Http\Request;
use App\User;
use App\Models\Mylapsdata;
use App\Models\Hardcarddata;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/users', function () {
    return User::all();
});




Route::get('/mylapsdata', function(){
	$sortkey = $_GET['sortkey'];
	$sortorder = $_GET['sortorder'];
	$raceid = $_GET['raceid'];

	$res = Mylapsdata::where('raceid', $raceid)->orderBy($sortkey, $sortorder)->get();

	return $res;
});

Route::get('/mylapsdata/{id}', function($id){
	return Mylapsdata::find($id);
});
Route::put('/mylapsdata/{id}', function(Request $request, $id) {
    $mylapsdata = Mylapsdata::findOrFail($id);
    $mylapsdata->update($request->all());

    return $mylapsdata;
});




Route::get('/hardcarddata', function(){
	$sortkey = $_GET['sortkey'];
	$sortorder = $_GET['sortorder'];
	$raceid = $_GET['raceid'];

	$res = Hardcarddata::where('raceid', $raceid)->orderBy($sortkey, $sortorder)->get();

	return $res;
});


Route::get('/team/{id}', function($id){
	$teamid = $_GET['teamid'];
	$res = Mylapsdata::where('raceid', $id)->where('teamid', $teamid)->get();
	return $res;
});
