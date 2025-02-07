<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Services\AuthorService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthorController extends Controller
{
    /**
     * @param AuthorService $authorService
     */
    public function __construct(protected AuthorService $authorService)
    {
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $authors = $this->authorService->getAuthors();

        return AuthorResource::collection($authors);
    }

    /**
     * @param StoreAuthorRequest $request
     * @return AuthorResource
     */
    public function store(StoreAuthorRequest $request): AuthorResource
    {
        $data = $request->validated();
        $author = $this->authorService->createAuthor($data);

        return AuthorResource::make($author);
    }
}
