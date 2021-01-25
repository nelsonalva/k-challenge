<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Models\Post;

class PostRelationshipController extends Controller
{
    public function comments(Post $post)
    {
        return new CommentsResource($post->comments);
    }
}
