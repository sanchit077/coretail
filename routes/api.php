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
Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function() { 	 
	Route::group(['prefix' => 'user'], function() { 	
		Route::post('verifySocialAccount', ['as' => 'verifySocialAccount', 
											'uses' => 'UserController@app_social_login']);
			Route::post('signUp', 	['as' => 'signUp', 'uses'		=> 'UserController@app_register']);
			Route::post('login',    	['as' => 'login', 'uses' 		=> 'UserController@app_login']); 

			Route::group(['middleware' => [ 'auth:api']], function() { 
		    	Route::post('logout',	['as' => 'logout', 'uses' => 'UserController@app_logout']);
		    });
	});
	
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
