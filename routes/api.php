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
    Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>''],function (){

        Route::prefix('Series')->group(function (){
            Route::get('/','SeriesController@fetchAll');
            Route::post('/','SeriesController@create');
            Route::group(['prefix'=>'{series}'],function (){
                Route::get('/','SeriesController@fetch');
                Route::put('/','SeriesController@update');
                Route::delete('/','SeriesController@delete');
            });
        });

        Route::prefix('Message')->group(function (){
            Route::get('/','MessageController@fetchAll');
            Route::post('/','MessageController@create');
            Route::group(['prefix'=>'{message}'],function (){
                Route::get('/','MessageController@fetch');
                Route::put('/','MessageController@update');
                Route::delete('/','MessageController@delete');
            });
        });

        Route::prefix('Tags')->group(function (){
            Route::get('/','TagController@fetchAll');
            Route::post('/','TagController@create');
            Route::group(['prefix'=>'{tag}'],function (){
                Route::get('/','TagController@fetch');
                Route::put('/','TagController@update');
                Route::delete('/','TagController@delete');
            });
        });

        Route::prefix('Ministrations')->group(function (){
            Route::get('/','Controller@fetchAll');
            Route::post('/','Controller@create');
            Route::prefix('ministration')->group(function (){
                Route::get('/','Controller@fetch');
                Route::put('/','Controller@update');
                Route::delete('/','Controller@delete');
            });
        });
    });
});