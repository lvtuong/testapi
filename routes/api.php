<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('register', [App\Http\Controllers\Api\PassportAuthController::class, 'register']);
        Route::post('login', [App\Http\Controllers\Api\PassportAuthController::class, 'login']);
    });
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('getuser', [App\Http\Controllers\Api\PassportAuthController::class, 'getUser']);
        Route::get('logout', [App\Http\Controllers\Api\PassportAuthController::class, 'logout']);

        Route::apiResource('categories', App\Http\Controllers\Api\CategorieController::class);
        Route::apiResource('product', App\Http\Controllers\Api\ProductController::class);
        Route::apiResource('catpro', App\Http\Controllers\Api\CatProController::class);
    });

});

