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
        Route::post('register', [App\Http\Controllers\Api\UserController::class, 'register']);
        Route::post('login', [App\Http\Controllers\Api\UserController::class, 'login']);
    });
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('get-user', [App\Http\Controllers\Api\UserController::class, 'getUser']);
        Route::get('logout', [App\Http\Controllers\Api\UserController::class, 'logout']);

        // check role & permission
        Route::get('check-per', [App\Http\Controllers\Api\PermissionUserController::class, 'checkPermission']);
        Route::get('check-role', [App\Http\Controllers\Api\RoleUserController::class, 'checkRoleUser']);

        // create roles & permission & middleware & give
        Route::group(['middleware' => ['role:super-admin|mod product']], function () {
            // product

            Route::apiResource('product', App\Http\Controllers\Api\ProductController::class);


            Route::apiResource('categories', App\Http\Controllers\Api\CategorieController::class);
            Route::apiResource('cat-pro', App\Http\Controllers\Api\CatProController::class);

            // createRoleUser
            Route::post('create-role', [App\Http\Controllers\Api\RoleUserController::class, 'createRoleUser']);
            Route::post('role', [App\Http\Controllers\Api\RoleUserController::class, 'giveRoleUser']);

            //createPermissionUser
            Route::post('create-permission', [App\Http\Controllers\Api\PermissionUserController::class, 'CreatePermissionUser']);
            Route::post('empower', [App\Http\Controllers\Api\PermissionUserController::class, 'givePermission']);
            Route::get('del-permission', [App\Http\Controllers\Api\PermissionUserController::class, 'deletePermission']);

        });

    });

});

