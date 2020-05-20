<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\SeriesController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\MinistrationsController;
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
    Route::group(['prefix'=>'admin'],function (){

        Route::prefix('series')->group(function (){
            Route::get('/',[SeriesController::class,'index']);
            Route::post('/',[SeriesController::class,'create']);
            Route::group(['prefix'=>'{series}'],function (){
                Route::get('/',[SeriesController::class,'show']);
                Route::post('/',[SeriesController::class,'update']);
                Route::delete('/',[SeriesController::class,'delete']);
            });
        });

        Route::prefix('Message')->group(function (){
            Route::get('/',[MessagesController::class,'fetchAll']);
            Route::post('/',[MessagesController::class,'create']);
            Route::group(['prefix'=>'{message}'],function (){
                Route::get('/',[MessagesController::class,'fetch']);
                Route::put('/',[MessagesController::class,'update']);
                Route::delete('/',[MessagesController::class,'delete']);
            });
        });

        Route::prefix('Tags')->group(function (){
            Route::get('/',[TagsController::class,'fetchAll']);
            Route::post('/',[TagsController::class,'create']);
            Route::group(['prefix'=>'{tag}'],function (){
                Route::get('/',[TagsController::class,'fetch']);
                Route::put('/',[TagsController::class,'update']);
                Route::delete('/',[TagsController::class,'delete']);
            });
        });

        Route::prefix('Ministrations')->group(function (){
            Route::get('/',[MinistrationsController::class,'fetchAll']);
            Route::post('/',[MinistrationsController::class,'create']);
            Route::prefix('ministration')->group(function (){
                Route::get('/',[MinistrationsController::class,'fetch']);
                Route::put('/',[MinistrationsController::class,'update']);
                Route::delete('/',[MinistrationsController::class,'delete']);
            });
        });
    });
});
