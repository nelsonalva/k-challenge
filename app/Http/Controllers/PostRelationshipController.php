<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Models\Post;
use APP\Http\Resources\CommentsResource;

class PostRelationshipController extends Controller
{
    public function comments(Post $post)
    {
        return new CommentsResource($post->comments);
    }
}
