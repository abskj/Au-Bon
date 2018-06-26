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
Route::post('/manager',[
    'uses' => 'userController@createManager'
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
    'uses' => 'dashboardController@addRestro',
    'middleware' => 'auth.jwt'
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

//CRUD for branch
//all operations should be done by manager or admins

/*
 * Takes a restro(restro_id) and return all its branches
 */
Route::post('/get-branches',[
    'uses' =>'branchController@get'
]);
/*
 * create a branch
 */
Route::post('/branch',[
    'uses' =>'branchController@create'
]);

/*
 * delete a branch from a particular restro
 */
Route::delete('/branch',[
    'uses' => 'branchController@del'
]);

/*
 * Update a branch
 */

Route::put('/branch',[
    'uses' => 'branchController@update'
]);

Route::post('/foodCategory',[
    'uses' => 'branchController@create'
]);


