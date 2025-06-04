<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Review;

class BookRepository
{
    public function get(){
        return Book::all();
    }

    public function details(int $id){
        return Book::findOrFail($id);
    }

    public function store(array $data){
        return Book::create($data);
    }

    public function update(int $id, array $data){
        $book = $this->details($id);
        $book->update($data);
        return $book;
    }

    public function delete(int $id){
        $book = $this->details($id);
        $book->delete();
        return $book;
    }

    public function bookReviews($id)
    {
        return Review::with(['users'])->where('book_id', $id)->get();
    }

    public function booksComTudo()
    {
        return book::with(['authors', 'genres', 'reviews.users'])->get();
    }
}