<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Services\UserService;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return new PostsResource(Post::paginate());

    }

    public function indexPublicPosts()
    {
        $posts = new PostsResource(
            Post::where([
                ['is_protected', 0],
                ['is_published', 1]
            ])->paginate(5)
        );

        return $posts;
    }

    public function indexProtectedPosts(Request $request)
    {
        $validation = UserService::validateCredentials($request);

        if ($validation == "ok") {
            $posts = new PostsResource(
                Post::where([
                    ['is_protected', 1],
                    ['is_published', 1]
                ])->paginate(5)
            );
            return $posts;
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
            $post = Post::create($request->all());
            return response()->json($post, 201);
        } else {
            return ['validationError' => $validation];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    }

    public function showPublicPosts(Post $post)
    {
        /** To remove 'data' at the top when searching individual posts */
        PostResource::withoutWrapping();

        $isProtected = json_decode((new PostResource($post))
            ->toJson(), true)['attributes']['is_protected'];

        if ($isProtected == 0) {
            return new PostResource($post);
        } else {
            return array('ErrorMessage' => 'you are trying to access to a protected resource from a public endpoint');
        }
    }

    public function showProtectedPosts(Request $request, Post $post)
    {
        $validation = UserService::validateCredentials($request);

        PostResource::withoutWrapping();
        if ($validation == "ok") {
            $isProtected = json_decode((new PostResource($post))
                ->toJson(), true)['attributes']['is_protected'];
            if ($isProtected == 1) {
                return new PostResource($post);
            } else {
                return array('ErrorMessage' => 'you are trying to access to a public resource from a protected endpoint');
            }
        } else {
            return ['validationError' => $validation];
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $postId)
    {
        $validation = UserService::validateCredentials($request);

        if ($validation == "ok") {
            $post = Post::find($postId);
            if (is_null($post)) {
                return response()->json(null, 404);
            }
            $post->update($request->all());
            return response()->json($post, 200);
        } else {
            return ['validationError' => $validation];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $postId)
    {
        $validation = UserService::validateCredentials($request);

        if ($validation == "ok") {
            $post = Post::find($postId);
            if (is_null($post)) {
                return response()->json(null, 404);
            }

            $post->delete();
            return response()->json(null, 204);
        } else {
            return ['validationError' => $validation];
        }
    }
}
