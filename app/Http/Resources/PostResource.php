<?php

namespace App\Http\Resources;

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
        $translations = $this->translations->where('lang_id' , 2);
        
        foreach($translations as $translation)
        {
            $title_vi = $translation->title;
            $content_vi = $translation->content;
        }
        return [
            'id' => $this->id,
            'title' => $title_vi,
            'content' => $content_vi,
        ];
    }
}
