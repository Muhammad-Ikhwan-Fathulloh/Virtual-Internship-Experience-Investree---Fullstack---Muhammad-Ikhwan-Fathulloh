<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('landingpage');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Post
Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, 'Postindex']);
    Route::post('/storepost', [PostController::class, 'store'])->name('storePost');
    Route::get('/fetchpost', [PostController::class, 'fetchAll'])->name('fetchPost');
    Route::delete('/deletepost', [PostController::class, 'destroy'])->name('deletePost');
    Route::get('/editpost', [PostController::class, 'edit'])->name('editPost');
    Route::post('/updatepost', [PostController::class, 'update'])->name('updatePost');
});


// Post Category
Route::prefix('post-category')->group(function () {
    Route::get('/', [PostCategoryController::class, 'PostCategoryindex']);
    Route::post('/storepostcategory', [PostCategoryController::class, 'store'])->name('storePostCategory');
    Route::get('/fetchallpostcategory', [PostCategoryController::class, 'fetchAll'])->name('fetchPostCategory');
    Route::delete('/deletepostcategory', [PostCategoryController::class, 'destroy'])->name('deletePostCategory');
    Route::get('/editpostcategory', [PostCategoryController::class, 'edit'])->name('editPostCategory');
    Route::post('/updatepostcategory', [PostCategoryController::class, 'update'])->name('updatePostCategory');
});


