<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $rootUrl = config('app.url');
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? Storage::url($this->image) : null,
            'genre' => $this->genre,
            'performer' => $this->performer,
            'director' => $this->director,
            'theater_name' => $this->theater_name,
            'ratings' => $this->ratings,
            'release' => $this->release,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'length' => $this->length,
        ];
    }
}
