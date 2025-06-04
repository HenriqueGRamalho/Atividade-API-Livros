<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Review;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = ['title', 'synopsis', 'author_id', 'genre_id'];

    public function authors(){
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function genres(){
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'book_id', 'id');
    }
}
