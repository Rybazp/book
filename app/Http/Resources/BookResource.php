<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $authors = [];
        foreach ($this-> authors as $author) {
            $authors[] = [
                'name' => $author->name . ' ' . $author->surname,
            ];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'publication_date' => $this->publication_date,
            'authors' => $authors,
            'image' => url('storage/' . env('IMAGE_PATH') . 'books/' . $this->id . '/' . $this->image),
        ];
    }
}
