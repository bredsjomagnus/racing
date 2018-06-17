<?php

use Illuminate\Http\Request;
use App\User;
use App\Models\Trackdata;
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




Route::get('/trackdata', function(){
	$sortkey = $_GET['sortkey'];
	$sortorder = $_GET['sortorder'];

	$res = Trackdata::orderBy($sortkey, $sortorder)->get();

	return $res;
});
Route::get('/trackdata/{id}', function($id){
	return Trackdata::find($id);
});
Route::put('/trackdata/{id}', function(Request $request, $id) {
    $trackdata = Trackdata::findOrFail($id);
    $trackdata->update($request->all());

    return $trackdata;
});
