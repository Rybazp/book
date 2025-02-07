<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;
use App\Models\AuthorBook;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       Author::factory(50)->create();
       Book::factory(50)->create();
       AuthorBook::factory()->count(20)->create();
    }
}
