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
        $trimmed = Tools::trimRoute(Route::getFacadeRoot()->current()->uri());

        if ($trimmed == 'protected') {
            return new PostsResource(Post::where('is_protected', 1)
                ->paginate(5));
        }

        return new PostsResource(Post::where('is_published', 1)
            ->where('is_protected', 0)
            ->paginate(5));
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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $trimmed = Tools::trimRoute(Route::getFacadeRoot()->current()->uri());

        /** To remove 'data' at the top when searching individual posts */
        PostResource::withoutWrapping();

        $isProtected = json_decode((new PostResource($post))
            ->toJson(), true)['attributes']['is_protected'];

        /**  */
        if ($trimmed == 'protected' && $isProtected == '1') {
            # code...
            return new PostResource($post);
        } elseif ($trimmed == 'public' && $isProtected == '0') {
            return new PostResource($post);
        } elseif ($trimmed == 'protected' && $isProtected == '0') {
            return array('ErrorMessage' => 'you are trying to access to a public resource from a protected endpoint');
        } elseif ($trimmed == 'public' && $isProtected == '1') {
            return array('ErrorMessage' => 'you are trying to access to a protected resource from a public endpoint');
        } else {
            return array('ErrorMessage' => 'There is a problem with the route you are trying to access');

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
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
