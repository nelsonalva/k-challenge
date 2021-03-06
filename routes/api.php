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

/** Routes and aliases for JAPI Links*/
Route::get('posts/{post}/relationships/comments', [
    'uses' => PostRelationshipController::class . '@comments',
    'as' => 'posts.relationships.comments',
]);

Route::get('posts/{post}/comments', [
    'uses' => PostRelationshipController::class . '@comments',
    'as' => 'posts.comments',
]);

/** Routes for Posts */

Route::get('public/posts', [
    'uses' => PostsController::class . '@indexPublicPosts',
    'as' => 'public.posts.show',
]);

Route::get('protected/posts', [
    'uses' => PostsController::class . '@indexProtectedPosts',
    'as' => 'protected.posts.show',
]);

Route::get('public/posts/{post}', ['uses' => PostsController::class . '@showPublicPosts']);

Route::get('protected/posts/{post}', [PostsController::class, 'showProtectedPosts']);

Route::post('protected/posts', [PostsController::class, 'store']);

Route::put('protected/posts/{post}', [PostsController::class, 'update']);

Route::delete('protected/posts/{post}', [PostsController::class, 'destroy']);


/**Routes for comments */

Route::get('public/comments/post/{post_id}', [CommentsController::class, 'indexPublicPostComments']);

Route::get('protected/comments/post/{post_id}', [CommentsController::class, 'indexProtectedPostComments']);

Route::get('public/comments/user/{user}', ['uses' => CommentsController::class . '@indexPublicUserComments']);

Route::get('protected/comments/user/{user}', ['uses' => CommentsController::class . '@indexProtectedUserComments']);

Route::post('protected/comments', [CommentsController::class, 'store']);

Route::put('protected/comments/{comment}', [CommentsController::class, 'update']);

Route::delete('protected/comments/{comment}', [CommentsController::class, 'destroy']);
