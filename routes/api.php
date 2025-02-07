<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

Route::get('/authors', [AuthorController::class, 'index']);
Route::post('/authors', [AuthorController::class, 'store']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/search', [BookController::class, 'searchByAuthors']);
Route::get('/books/{book}', [BookController::class, 'show']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{book}', [BookController::class, 'update']);
