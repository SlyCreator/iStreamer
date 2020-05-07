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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function (){
    Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>''],function (){

        Route::prefix('series')->group(function (){
            Route::get('/','SeriesController@index');
            Route::post('/','SeriesController@create');
            Route::group(['prefix'=>'{series}'],function (){
                Route::get('/','SeriesController@show');
                Route::put('/','SeriesController@update');
                Route::delete('/','SeriesController@delete');
            });
        });

        Route::prefix('Message')->group(function (){
            Route::get('/','MessagesController@fetchAll');
            Route::post('/','MessagesController@create');
            Route::group(['prefix'=>'{message}'],function (){
                Route::get('/','MessagesController@fetch');
                Route::put('/','MessagesController@update');
                Route::delete('/','MessagesController@delete');
            });
        });

        Route::prefix('Tags')->group(function (){
            Route::get('/','TagsController@fetchAll');
            Route::post('/','TagsController@create');
            Route::group(['prefix'=>'{tag}'],function (){
                Route::get('/','TagsController@fetch');
                Route::put('/','TagsController@update');
                Route::delete('/','TagsController@delete');
            });
        });

        Route::prefix('Ministrations')->group(function (){
            Route::get('/','MinistrationsController@fetchAll');
            Route::post('/','MinistrationsController@create');
            Route::prefix('ministration')->group(function (){
                Route::get('/','MinistrationsController@fetch');
                Route::put('/','MinistrationsController@update');
                Route::delete('/','MinistrationsController@delete');
            });
        });
    });
});
