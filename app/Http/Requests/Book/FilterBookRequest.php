<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class FilterBookRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'surname' => 'nullable|string|min:3',
            'name' => 'nullable|string|min:3',
        ];
    }
}
