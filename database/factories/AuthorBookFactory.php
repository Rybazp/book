<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorBookFactory extends Factory
{
    protected $model = AuthorBook::class;

    public function definition()
    {
        $authorId = Author::all()->random()->id;
        $bookId = Book::all()->random()->id;

        return [
            'author_id' => $authorId,
            'book_id' => $bookId,
        ];
    }
}
