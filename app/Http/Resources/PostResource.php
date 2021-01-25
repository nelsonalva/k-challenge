<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'posts',
            'id' => (string)$this->id,
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'content' => $this->content,
                'is_published' => $this->is_published,
                'is_protected' => $this->is_protected,
                'user_id' => $this->user_id,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,

            ],
            'relationships' => new PostRelationshipResource($this),
            'links' => [
                'self' => route('posts.show', ['post' => $this->id])
            ],

        ];
    }
}
