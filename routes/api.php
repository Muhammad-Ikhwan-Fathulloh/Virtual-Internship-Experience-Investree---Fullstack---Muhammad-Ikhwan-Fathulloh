<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostCategoryController;
use App\Http\Controllers\Api\PostController;

$version = 'v1';

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

Route::middleware('auth:api')->get('/', function (Request $request) {
    Route::prefix('v1')->group(function () {
        // Post
        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'index']);
            Route::get('/show/{id}', [PostController::class, 'show']);
            Route::get('/paginate/limit={limit}&offset={offset}', [PostController::class, 'paginate']);
            Route::post('/store', [PostController::class, 'store']);
            Route::post('/update/{id}', [PostController::class, 'update']);
            Route::delete('/delete/{id}', [PostController::class, 'delete']);
        });

        // Post Category
        Route::prefix('post-category')->group(function () {
            Route::get('/', [PostCategoryController::class, 'index']);
            Route::get('/show/{id}', [PostCategoryController::class, 'show']);
            Route::get('/paginate/limit={limit}&offset={offset}', [PostCategoryController::class, 'paginate']);
            Route::post('/store', [PostCategoryController::class, 'store']);
            Route::post('/update/{id}', [PostCategoryController::class, 'update']);
            Route::delete('/delete/{id}', [PostCategoryController::class, 'delete']);
        });
    });
});

Route::prefix('v1')->group(function () {
    // Post
    Route::prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/show/{id}', [PostController::class, 'show']);
        Route::get('/paginate/limit={limit}&offset={offset}', [PostController::class, 'paginate']);
        Route::post('/store', [PostController::class, 'store']);
        Route::post('/update/{id}', [PostController::class, 'update']);
        Route::delete('/delete/{id}', [PostController::class, 'delete']);
    });

    // Post Category
    Route::prefix('post-category')->group(function () {
        Route::get('/', [PostCategoryController::class, 'index']);
        Route::get('/show/{id}', [PostCategoryController::class, 'show']);
        Route::get('/paginate/limit={limit}&offset={offset}', [PostCategoryController::class, 'paginate']);
        Route::post('/store', [PostCategoryController::class, 'store']);
        Route::post('/update/{id}', [PostCategoryController::class, 'update']);
        Route::delete('/delete/{id}', [PostCategoryController::class, 'delete']);
    });
});


