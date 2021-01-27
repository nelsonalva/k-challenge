<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\CommentsResource;
use App\Services\UserService;


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

    public function indexPublicPostComments(int $postId)
    {
        /** Verify that the post exists */
        $post = Post::find($postId);
        if (is_null($post)) {
            return response()->json(null, 404);
        }

        $comments = new CommentsResource(
            Comment::where([
                ['post_id', $postId],
                ['is_protected', 0],
                ['is_published', 1]
            ])->paginate(5)
        );

        return $comments;
    }

    public function indexProtectedPostComments(Request $request, int $postId)
    {
        $validation = UserService::validateCredentials($request);
        /** Verify that the post exists */
        if ($validation == "ok") {
            $post = Post::find($postId);
            if (is_null($post)) {
                return response()->json(null, 404);
            }

            $comments = new CommentsResource(
                Comment::where([
                    ['post_id', $postId],
                    ['is_protected', 1],
                    ['is_published', 1]
                ])->paginate(5)
            );

            return $comments;
        } else {
            return ['validationError' => $validation];
        }
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
        $validation = UserService::validateCredentials($request);

        if ($validation == "ok") {
            $comment = Comment::create($request->all());
            return response()->json($comment, 201);
        } else {
            return ['validationError' => $validation];
        }
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

    public function indexProtectedUserComments(Request $request, int $user)
    {
        $validation = UserService::validateCredentials($request);

        if ($validation == "ok") {
            $comments = new CommentsResource(
                Comment::where([
                    ['user_id', $user],
                    ['is_protected', 1]
                ])->paginate(5)
            );

            return $comments;
        } else {
            return ['validationError' => $validation];
        }
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
        $validation = UserService::validateCredentials($request);
        $userId = UserService::findUserId($request);

        if ($validation == "ok") {
            $comment = Comment::find($commentId);

            if (is_null($comment)) {
                return response()->json(null, 404);
            }
            /** Verifying user match */
            if ($userId == $comment->user_id) {
                $comment->update($request->all());
                return response()->json($comment, 200);
            } else {
                return ['validationError' => 'A post can only be updated by its autor'];
            }
        } else {
            return ['validationError' => $validation];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $commentId)
    {
        $validation = UserService::validateCredentials($request);
        $userId = UserService::findUserId($request);

        if ($validation == "ok") {
            $comment = Comment::find($commentId);
            if (is_null($comment)) {
                return response()->json(null, 404);
            }
            /** Verifying user match */
            if ($userId == $comment->user_id) {
                $comment->delete();
                return response()->json(null, 204);
            } else {
                return ['validationError' => 'A comment can only be deleted by its autor'];
            }
        } else {
            return ['validationError' => $validation];
        }
    }
}
