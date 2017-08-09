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

Route::post('/users/create', 'UserController@create');
Route::post('/users/login', 'UserController@login');
/*Route::get('/user', [
    'uses' => 'UserController@getAuthUser',
    'middleware' => 'jwt.auth'
]);*/
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/user', 'UserController@getAuthenticatedUser');
});

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
