<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'surname' => 'required|string|min:3',
            'name' => 'required|string|min:3',
            'middle_name' => 'nullable|string'
        ];
    }
}
