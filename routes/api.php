<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\PostController;
use App\Http\Controllers\V1\TagController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Middleware\V1\SetLocale;
use App\Http\Controllers\V1\AuthController;

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
        /** 登入後才可存取 */
        Route::middleware('auth:sanctum')->group(function () {
            /** Auth 相關 */
            Route::post('logout', [AuthController::class, 'logout'])->name('user.auth.logout');
            Route::get('is-logged-in', [AuthController::class, 'isLoggedIn'])->name('user.auth.is-logged-in');

            /** 文章相關 */
            Route::apiResource('posts', PostController::class)->only(['store', 'update']);
        });

        /** 登入相關 */
        Route::post('login/metamask', [AuthController::class, 'loginWithMetaMask'])->name('user.auth.login.metamask');

        Route::get('to-be-signed-message',
            [
                AuthController::class, 'getToBeSignedMessage'
            ])->name('user.auth.get-to-be-signed-message')->middleware(SetLocale::class);

        /** 文章相關 */
        Route::apiResource('posts', PostController::class)->only(['index', 'show'])->middleware(SetLocale::class);

        /** 標籤相關 */
        Route::apiResource('tags', TagController::class)->only(['index'])->middleware(SetLocale::class);
        Route::get('popular-tags',
            [TagController::class, 'indexPopularly'])->name('tags.index.popularly')->middleware(SetLocale::class);

        /** 文章類別相關 */
        Route::apiResource('categories', CategoryController::class)->only(['index'])->middleware(SetLocale::class);
    });
});