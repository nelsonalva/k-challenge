<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use Illuminate\Support\Facades\Route;
use App\Services\Tools;
use Psy\Command\WhereamiCommand;

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

    public function indexProtectedPosts()
    {
        $posts = new PostsResource(
            Post::where([
                ['is_protected', 1],
                ['is_published', 1]
            ])->paginate(5)
        );

        return $posts;
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
            $post = Post::create($request->all());
            return response()->json($post, 201);
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

    public function showProtectedPosts(Post $post)
    {
        PostResource::withoutWrapping();

        $isProtected = json_decode((new PostResource($post))
            ->toJson(), true)['attributes']['is_protected'];

        if ($isProtected == 1) {
            return new PostResource($post);
        } else {
            return array('ErrorMessage' => 'you are trying to access to a public resource from a protected endpoint');
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
        $post = Post::find($postId);
        if (is_null($post)){
            return response()->json(null, 404);
        }
        $post->update($request->all());
        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId)
    {
        $post = Post::find($postId);
        if (is_null($post)){
            return response()->json(null, 404);
        }

        $post->delete();
        return response()->json(null, 204);
    }
}
