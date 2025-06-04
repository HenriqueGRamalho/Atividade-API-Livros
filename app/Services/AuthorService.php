<?php

namespace App\Services;

use App\Repositories\AuthorRepository;

class AuthorService
{
    private AuthorRepository $AuthorRepository;

    public function __construct(AuthorRepository $AuthorRepository){
        $this->AuthorRepository = $AuthorRepository;
    }

    public function get(){
        $authors = $this->AuthorRepository->get();
        return $authors;
    }

    public function details($id){
        return $this->AuthorRepository->details($id);
    }

    public function store(array $data){
        return $this->AuthorRepository->store($data);
    }

    public function update($id, $data){
        $author = $this->AuthorRepository->update($id,$data);
        return $author;
    }

    public function delete(int $id){
        return $this->AuthorRepository->delete($id);
    }

    public function GetBooks($id)
    {
        return $this->AuthorRepository->GetAuthorBooks($id);
    }

    public function GetAuthorWithBooks()
    {
        return $this->AuthorRepository->AuthorWithBooks();
    }

}