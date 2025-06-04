<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;
use App\Model\Book;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['grade', 'text', 'user_id', 'book_id'];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function books(){
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
