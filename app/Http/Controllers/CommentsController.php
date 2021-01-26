<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

        // $comments = (new CommentsResource(
        //     Comment::get()
        //         ->where('post_id', $post)
        //         ->where('is_protected', 0)
        //         ->where('is_published', 1)
        // ));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        // CommentResource::withoutWrapping();

        return new CommentResource($comment);
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
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
