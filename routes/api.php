<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostRelationshipController;
use App\Http\Controllers\CommentsController;
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
// Route::get('posts', [PostsController::class, 'index']);

Route::apiResource('posts', PostsController::class);
Route::apiResource('comments', CommentsController::class);

Route::get(
    'posts/{post}/relationships/comments',
    [
        'uses' => PostRelationshipController::class . '@comments',
        'as' => 'posts.relationships.comments',
    ]
);

Route::get(
    'posts/{post}/comments',
    [
        'uses' => PostRelationshipController::class . '@comments',
        'as' => 'posts.comments',
    ]
);