<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCommentsRelationshipResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $post = $this->additional['post'];

        $comments = CommentIdentifierResource::collection($this->collection);
        $commentsCount = count($comments);

        return [
            'data'  => $comments->sortByDesc('id')->take(5),
            'commentsCount' => $commentsCount,
            'links' => [
                'self'    => route('posts.relationships.comments', ['post' => $post->id]),
                'related' => route('posts.comments', ['post' => $post->id]),
            ],
        ];
    }

    // public function with($request)
    // {
    //     return [
    //         'links' => [
    //             'self' => route('posts.index'),
    //         ],
    //     ];
    // }

}
