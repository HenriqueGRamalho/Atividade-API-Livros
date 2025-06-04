<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Book;
use App\Models\Review;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UserController::class)->group(function () {
    Route::post('/users','store');
    Route::get('/users','get');
    Route::get('/users/{id}','details');
    Route::patch('/users/{id}','update');
    Route::delete('/users/{id}','delete');
    Route::get('/users/reviews/{id}','UserReviews');
});

Route::controller(AuthorController::class)->group( function () {
    Route::post('/authors','store');
    Route::get('/authors','get');
    Route::patch('/authors/{id}','update');
    Route::delete('/authors/{id}','delete');
    Route::get('/authors/books/{id}','GetBooks');
    Route::get('/authors/with-books','GetBooksWithAuthors');
    Route::get('/authors/{id}','details');
});

Route::controller(GenreController::class)->group( function () {
    Route::post('/genres','store');
    Route::get('/genres','get');
    Route::patch('/genres/{id}','update');
    Route::delete('/genres/{id}','delete');
    Route::get('/genres/books/{id}','GetBooks');
    Route::get('/genres/com-books','GenresWithBooks');
    Route::get('/genres/{id}','details');
});

Route::controller(BookController::class)->group( function () {
    Route::post('/books','store');
    Route::get('/books','get');
    Route::patch('/books/{id}','update');
    Route::delete('/books/{id}','delete');
    Route::get('/books/reviews/{id}','GetReviews');
    Route::get('/books/CompleteBooks','BooksWithAuthorGenreReviews');
    Route::get('/books/{id}','details');
});

Route::controller(ReviewController::class)->group( function () {
    Route::post('/reviews','store');
    Route::get('/reviews','get');
    Route::get('/reviews/{id}','details');
    Route::patch('/reviews/{id}','update');
    Route::delete('/reviews/{id}','delete');
});