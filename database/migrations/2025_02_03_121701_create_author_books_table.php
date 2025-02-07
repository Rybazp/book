<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('author_books', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('author_id');
            $table->UnsignedBigInteger('book_id');
            $table->timestamps();

            $table->softDeletes();

            $table->index('author_id', 'author_books_author_idx');
            $table->index('book_id', 'author_books_book_idx');
            $table->foreign('author_id', 'author_books_author_fk')->references('id')->on('authors');
            $table->foreign('book_id', 'author_books_book_fk')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_books');
    }
};
