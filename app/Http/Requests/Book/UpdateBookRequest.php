<?php

namespace App\Http\Requests\Book;

class UpdateBookRequest extends StoreBookRequest
{
    /**
     * @return array|string[]
     */
    public function rules(): array
    {
        $this->rules['title'] = 'nullable|string';
        $this->rules['authors'] = 'nullable|array';
        $this->rules['publication_date'] = 'nullable|date';

        return $this->rules;
    }
}
