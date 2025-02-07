<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * @var array|string[]
     */
    public array $rules = [
        'title' => 'required|string',
        'description' => 'nullable|string',
        'image' => 'nullable|string',
        'authors' => 'required|array',
        'publication_date' => 'required|date',
    ];

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return $this->rules;
    }
}
