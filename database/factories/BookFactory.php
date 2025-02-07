<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'publication_date' => $this->faker->date(),
        ];

        $authors = Author::all()->random(rand(1, 3));
        $book->authors()->attach($authors);

        return $book->toArray();
    }
}
