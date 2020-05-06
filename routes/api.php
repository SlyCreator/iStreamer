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

            Route::prefix('Series')->group(function (){
                Route::get('/','SeriesController@fetchAllSeries');
                Route::get('/{series}','SeriesController@fetchserie');
                Route::post('/','SeriesController@create');
                Route::put('/','SeriesController@update');
                Route::delete('/','SeriesController@delete');
            });

            Route::get('/series','AdminController@fetchSeries');
            Route::get('/series/{serie}','AdminController@fetchserie');
            Route::post('/series','AdminController@create');
            Route::put('/series','AdminController@update');
            Route::delete('/series','AdminController@delete');
        })
    );
});