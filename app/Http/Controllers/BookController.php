<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\FilterBookRequest;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Services\BookService;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    /**
     * @param BookService $bookService
     */
    public function __construct(protected BookService $bookService)
    {
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $books = $this->bookService->getBooks();

        return BookResource::collection($books);
    }

    /**
     * @param StoreBookRequest $request
     * @return BookResource
     */
    public function store(StoreBookRequest $request): BookResource
    {
        $data = $request->validated();
        $book = $this->bookService->createBook($data);

        return BookResource::make($book);
    }

    /**
     * @param Book $book
     * @return BookResource
     */
    public function show(Book $book): BookResource
    {
        $book = $this->bookService->getBook($book);
        $image = $this->bookService->getImage($book->id);
        $book->image_url = $image;

        return BookResource::make($book);
    }

    /**
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return BookResource
     */
    public function update(UpdateBookRequest $request, Book $book): BookResource
    {
        $data = $request->validated();
        $book = $this->bookService->updateBook($book, $data);

        return  BookResource::make($book);
    }

    /**
     * @param FilterBookRequest $request
     * @return AnonymousResourceCollection
     */
    public function searchByAuthors(FilterBookRequest $request): AnonymousResourceCollection
    {
        $filters = $request->validated();
        $books = $this->bookService->searchByAuthors($filters);

        return BookResource::collection($books);
    }
}
