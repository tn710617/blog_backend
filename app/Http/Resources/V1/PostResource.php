<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'post_title' => $this->post_title,
            'post_content' => $this->post_content,
            'is_public' => $this->is_public,
            'category_id' => $this->category_id,
            'category' => $this->whenLoaded('category', function () {
                return CategoryResource::make($this->category);
            }),
            'tags' => $this->whenLoaded('tags', function () {
                return TagResource::collection($this->tags);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'locale' => $this->locale
        ];
    }
}
