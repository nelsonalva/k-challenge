<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentsResource;
use Illuminate\Support\Facades\Route;
use App\Services\Tools;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    public function indexPublicPostComments(int $post)
    {

        $post = Post::find($post);
        if (is_null($post)){
            return response()->json(null, 404);
        }

        $comments = new CommentsResource(
            Comment::where([
                ['post_id', $post],
                ['is_protected', 0],
                ['is_published', 1]
            ])->paginate(5)
        );

        return $comments;
    }

    public function indexProtectedPostComments(int $post)
    {
        $post = Post::find($post);
        if (is_null($post)){
            return response()->json(null, 404);
        }

        $comments = new CommentsResource(
            Comment::where([
                ['post_id', $post],
                ['is_protected', 1],
                ['is_published', 1]
            ])->paginate(5)
        );

        return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = Comment::create($request->all());
        return response()->json($comment, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    public function indexPublicUserComments(int $user)
    {
        $comments = new CommentsResource(
            Comment::where([
                ['user_id', $user],
                ['is_protected', 0],
                ['is_published', 1]
            ])->paginate(5)
        );

        return $comments;
    }

    public function indexProtectedUserComments(User $user)
    {
        $comments = new CommentsResource(
            Comment::where([
                ['user_id', $user],
                ['is_protected', 1]
            ])->paginate(5)
        );

        return $comments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $commentId)
    {
        $comment = Comment::find($commentId);
        $userId = $comment->user_id;
        return $userId;
        // if (is_null($comment)){
        //     return response()->json(null, 404);
        // }
        // $comment->update($request->all());
        // return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($commentId)
    {

        $comment = Comment::find($commentId);
        if (is_null($comment)){
            return response()->json(null, 404);
        }

        $comment->delete();
        return response()->json(null, 204);
    }
}
