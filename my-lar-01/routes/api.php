<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('welcome/{name}', function(Request $req, $username) {
    return response()->json("$username", 200);
});

Route::get('task', 'TaskController@getTask');

Route::post('createTask', 'TaskController@postCreate');

Route::put('editTask/{id}', 'TaskController@editTask');


Route::post('login','api\UserController@login');
Route::post('register', 'api\UserController@register');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('details', 'api\UserController@details');
});
