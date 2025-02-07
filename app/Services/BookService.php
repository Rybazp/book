<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class BookService
{
    /**
     * @return LengthAwarePaginator
     */
    public function getBooks(): LengthAwarePaginator
    {
        return Book::paginate(5);
    }

    /**
     * @param array $data
     * @return Book
     */
    public function createBook(array $data): Book
    {
        $book = Book::Create([
            'title' => $data['title'],
            'description' => $data['description'],
            'publication_date' => $data['publication_date'],
        ]);

        foreach ($data['authors'] as $authorData) {
            $author = Author::firstOrCreate($authorData);
            $book->authors()->attach($author->id);
        }

        if (!empty($data['image'])) {
            $fileName = $this->uploadImage($data['image'], $book->id);
            $book->image = $fileName;
            $book->save();
        }

        return $book;
    }

    /**
     * @param string $base64Image
     * @param Book $book
     * @return string
     * @throws \Exception
     */
    public function uploadImage(string $base64Image, int $bookId): string
    {
        $imageData = base64_decode($base64Image);

        if (!$imageData) {
            throw new \Exception('Invalid image data');
        }

        $basePath = env('IMAGE_PATH');
        $directory = $basePath . 'books/' . $bookId;
        $fileName = uniqid() . '.jpg';
        $path = $directory . '/' . $fileName;

        Storage::disk('public')->put($path, $imageData);

        return $fileName;
    }

    /**
     * @param Book $book
     * @return Book
     */
    public function getBook(Book $book): Book
    {
        return $book;
    }

    /**
     * @param int $bookId
     * @return string|null
     */
   public function getImage(int $bookId): ?string
   {
       $book = Book::findOrFail($bookId);

       if (!$book->image) {
           return null;
       }

       $imagePath = env('IMAGE_PATH') . 'books/' . $book->id . '/' . $book->image;

       return asset($imagePath);
   }

    /**
     * @param Book $book
     * @param array $data
     * @return Book
     */
    public function updateBook(Book $book, array $data): Book
    {
        $book->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'publication_date' => $data['publication_date'],
        ]);

        if (!empty($data['authors'] ?? [])) {
            $authorIds = [];

            foreach ($data['authors'] as $authorData) {
                $author = Author::firstOrCreate($authorData);
                $authorIds[] = $author->id;
            }

            $book->authors()->sync($authorIds);
        }

        if (!empty($data['image'])) {
            Storage::delete($book->image ?? null);
            $book->image = $this->uploadImage($data['image'], $book->id);
            $book->save();
        }

        return $book;
    }


    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchByAuthors(array $filters): LengthAwarePaginator
    {
        $query = Book::query();

        if (count($filters) == 1 && isset($filters['surname'])) {
            $this->searchBySurname($query, $filters['surname']);
        } elseif (count($filters) == 2 && isset($filters['name'])) {
            $this->searchByFullName($query, $filters);
        }

        return $query->paginate(10);
    }

    /**
     * @param Builder $query
     * @param $filters
     * @return Builder
     */
    private function searchBySurname(Builder $query, $filters): Builder
    {
        return $query->whereHas('authors', function (Builder $query) use ($filters)  {
            $query->where('surname', $filters['surname']);
        });
    }

    /**
     * @param Builder $query
     * @param $filters
     * @return Builder
     */
    private function searchByFullName(Builder $query, $filters): Builder
    {
        return $query->whereHas('authors', function (Builder $query) use ($filters) {
            $query->where('surname', $filters['surname'])->where('name', $filters['name']);
        });
    }
}

