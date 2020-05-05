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

Route::prefix('v1')->group(function (){

    Route::middleware('admin')->group(

        Route::group(['namespace'=>'Admin','prefix'=>'admin'],function (){

            Route::prefix('collections')->group(function (){
                Route::get('/','AdminController@fetchSeries');
                Route::get('/{series}','AdminController@fetchserie');
                Route::post('/','AdminController@create');
                Route::put('/','AdminController@update');
                Route::delete('/','AdminController@delete');
            });

            Route::get('/series','AdminController@fetchSeries');
            Route::get('/series/{serie}','AdminController@fetchserie');
            Route::post('/series','AdminController@create');
            Route::put('/series','AdminController@update');
            Route::delete('/series','AdminController@delete');
        })
    );
});