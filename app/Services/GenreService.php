<?php

namespace App\Services;

use App\Repositories\GenreRepository;

class GenreService
{
    private GenreRepository $GenreRepository;

    public function __construct(GenreRepository $GenreRepository){
        $this->GenreRepository = $GenreRepository;
    }

    public function get(){
        $genres = $this->GenreRepository->get();
        return $genres;
    }

    public function details($id){
        return $this->GenreRepository->details($id);
    }

    public function store(array $data){
        return $this->GenreRepository->store($data);
    }

    public function update($id, $data){
        $genre = $this->GenreRepository->update($id,$data);
        return $genre;
    }

    public function delete(int $id){
        return $this->GenreRepository->delete($id);
    }

    public function GenreBooks($id)
    {
        return $this->GenreRepository->GenreBooks($id);
    }

    public function GenresWithTheirBooks()
    {
        return $this->GenreRepository->GenresWithBooks();
    }
}