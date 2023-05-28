<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\PostController;
use App\Http\Controllers\V1\TagController;
use App\Http\Controllers\V1\CategoryController;

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
Route::group(['prefix' => 'v1'], function () {
    Route::name('v1.')->group(function () {
        /** 文章相關 */
        Route::apiResource('posts', PostController::class)->only(['store', 'index', 'show']);

        /** 標籤相關 */
        Route::apiResource('tags', TagController::class)->only(['index']);

        /** 文章類別相關 */
        Route::apiResource('categories', CategoryController::class)->only(['index']);
    });
});