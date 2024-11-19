<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\IndexController;
use App\Http\Controllers\Api\V1\GoodsController;
use App\Http\Controllers\Api\V1\SqlLogController;
use App\Http\Controllers\Api\V1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 接口V1
Route::prefix('v1')->group(function () {
    //无需认证
    Route::any('test', [IndexController::class, 'test']);
    Route::post('user/login', [UserController::class, 'login']);
    Route::post('uploads', [IndexController::class, 'uploads']);
    Route::apiResource('index', IndexController::class);
    //登陆认证
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('user/info', [UserController::class, 'info']);
        Route::post('user/logout', [UserController::class, 'logout']);
        Route::apiResource('sqlLog', SqlLogController::class);
        Route::post('goods/export', [GoodsController::class, 'export']);
        Route::apiResource('goods', GoodsController::class);
    });
});
