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
/*
 * CRUD for staff
 */
Route::post('/staff',[
    'uses' => 'userController@createStaff'
]);


//CRUD for Restro model

Route::post('/restro',[
    'uses' => 'dashboardController@addRestro',
    //'middleware' => 'auth.jwt'
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

/*
 * CRUD for food Category for a particular branch
 */

Route::post('/get-foodCategory',[
    'uses' => 'foodCategoryController@get'
]);

Route::post('/foodCategory',[
    'uses' => 'foodCategoryController@create'
]);

Route::put('/foodCategory',[
    'uses' => 'foodCategoryController@update'
]);

Route::delete('/foodCategory',[
    'uses' => 'foodCategoryController@delete'
]);

/*
 * CRUD for food Item for a particilar branch
 */

Route::post('/get-foodItem',[
    'uses' => 'foodItemController@get'
]);

Route::post('/foodItem',[
    'uses' => 'foodItemController@create'
]);

Route::put('/foodItem',[
    'uses' => 'foodItemController@update'
]);

Route::delete('/foodItem',[
    'uses' => 'foodItemController@delete'
]);

/*
 * Routes for billing
 * 1.add to bill an item
 * 2.finish transaction
 * check if customer exist in DB based on mobile number
 * fetch his data if he does
 * add him if he doesn't
 * create select based on get category
 * fetch items based on branch display according to category
 *  * with item details
 * with add item send it to bill transaction and with the transaction id create tran_detail
 *
 *
 */

//Customer
/*
 * checks if customer exists
 * sends code=5 if he doesn't
 * sends customer data if he doea
 */
Route::post('/customer',[
    'uses' => 'billController@customer'
]);
Route::post('/start-transaction',[
    'uses' => 'billController@initiateTransaction'
]);
Route::post('/complete-transaction',[
    'uses' => 'billController@complete'
]);
Route::post('/part-transaction',[
    'uses' => 'billController@partTransaction'
]);
Route::post('/get-transaction',[
    'uses' => 'billController@getTransaction'
]);
Route::post('/del-item-transaction',[
    'uses' => 'billController@removeItem'
]);
//reset a transaction
Route::post('/reset-transaction',[
    'uses' => 'billController@reset'
]);
Route::post('/customerCreate',[
    'uses'=>'custController@create'
]);
//steward controllers
Route::post('/steward',[
    'uses' => 'stewardController@create'
]);
Route::post('/get-steward',[
    'uses' => 'stewardController@get'
]);

