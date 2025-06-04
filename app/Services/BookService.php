<?php

namespace App\Services;

use App\Repositories\BookRepository;

class BookService
{
    private BookRepository $BookRepository;

    public function __construct(BookRepository $BookRepository){
        $this->BookRepository = $BookRepository;
    }

    public function get(){
        $books = $this->BookRepository->get();
        return $books;
    }

    public function details($id){
        return $this->BookRepository->details($id);
    }

    public function store(array $data){
        return $this->BookRepository->store($data);
    }

    public function update($id, $data){
        $book = $this->BookRepository->update($id,$data);
        return $book;
    }

    public function delete(int $id){
        return $this->BookRepository->delete($id);
    }

    public function bookReviews($id)
    {
        return $this->BookRepository->bookReviews($id);
    }

    public function booksWithAuthorGenreReviews()
    {
        return $this->BookRepository->CompleteBooks();
    }
}