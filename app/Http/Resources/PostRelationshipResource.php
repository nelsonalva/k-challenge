<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'comments' => (new PostCommentsRelationshipResource($this->comments))->additional(['post' => $this]),
        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('post.index'),
            ],
        ];
    }
}
