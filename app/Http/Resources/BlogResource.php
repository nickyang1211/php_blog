<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this::withoutWrapping();
    }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'records' => $this->records,
            'author_id' => $this->author_id,
            'image' => $this->image,
        ];
    }
}