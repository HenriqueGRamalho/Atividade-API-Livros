<?php

namespace App\Repositories;

use App\Models\Genre;

class GenreRepository
{
    public function get(){
        return Genre::all();
    }

    public function details(int $id){
        return Genre::findOrFail($id);
    }

    public function store(array $data){
        return Genre::create($data);
    }

    public function update(int $id, array $data){
        $genre = $this->details($id);
        $genre->update($data);
        return $genre;
    }

    public function delete(int $id){
        $genre = $this->details($id);
        $genre->delete();
        return $genre;
    }

    public function genreBooks($id)
    {
        return Genre::with('books')->findOrFail($id)->books;
    }

    public function genresWithBooks()
    {
        return Genre::with('books')->get();
    }
}