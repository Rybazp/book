<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorService
{
    /**
     * @return LengthAwarePaginator
     */
    public function getAuthors(): LengthAwarePaginator
    {
        return Author::paginate(5);
    }

    /**
     * @param array $data
     * @return Author
     */
    public function createAuthor(array $data): Author
    {
        return Author::firstOrCreate($data);
    }
}
