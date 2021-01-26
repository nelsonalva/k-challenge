<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'id' => (string)$this->id,
            'attributes' => [
                'content' => $this->content,
                'user_id' => $this->user_id,
                'post_id' => $this->post_id,
                'is_protected' => $this->is_protected,
                'is_published' => $this->is_published,

            ]
        ];
    }
}
