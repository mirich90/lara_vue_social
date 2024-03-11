<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostImageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}/posts', [UserController::class, 'post']);
    Route::post('/users/{user}/toggle_following', [UserController::class, 'toggleFollowing']);
    Route::get('/users/following_posts', [\App\Http\Controllers\UserController::class, 'followingPost']);
    // Route::post('/users/stats', [UserController::class, 'stat']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/post_images', [PostImageController::class, 'store']);
    Route::post('/posts/{post}/toggle_like', [PostController::class, 'toggleLike']);
    Route::post('/posts/{post}/repost', [PostController::class, 'repost']);
    Route::post('/posts/{post}/comment', [PostController::class, 'comment']);
    Route::get('/posts/{post}/comment', [PostController::class, 'commentList']);
});
