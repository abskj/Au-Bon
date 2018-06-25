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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login',[
    'uses'=> 'userController@login'
]);
Route::post('/user',[
    'uses' => 'userController@create',
    'auth.jwt' => \Tymon\JWTAuth\Middleware\GetUserFromToken::class
]);
Route::delete('/user/{username}',[
    'uses' => 'userController@delete'
]);
Route::put('/user/{username}',[
    'uses'=>'userController@update'
]);

Route::get('/user',[
    'uses'=>'userController@test'
]);

//CRUD for Restro model

Route::post('/restro',[
    'uses' => 'dashboardController@addRestro'
]);

Route::get('/restro',[
    'uses' => 'dashboardController@getRestro'
]);
Route::delete('/restro',[
    'uses' => 'dashboardController@delRestro'
]);
Route::put('/restro',[
    'uses' => 'dashboardController@updateRestro'
]);





Route::get('/branch',[
    'uses' =>'dashboardController@getRestro'
]);
Route::post('/foodCategory',[
    'uses' => 'dashboardController@addFoodCategory'
]);


