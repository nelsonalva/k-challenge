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
            // 'type' => 'comments',
            'id' => (string)$this->id,
            // 'content' =>(string)$this->content,
            'attributes' => [
                'content' => $this->content,
            ]
        ];
    }
}
