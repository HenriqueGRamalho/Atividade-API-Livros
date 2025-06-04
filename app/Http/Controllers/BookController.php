<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    private BookService $BookService;

    public function __construct(BookService $BookService)
    {
        $this->BookService = $BookService;
    }

    public function get()
    {
        $Books = $this->BookService->get();
        return BookResource::collection($Books);
    }

    public function details($id)
    {
        try {
            $Book = $this->BookService->details($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        return new BookResource($Book);
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $Book = $this->BookService->store($data);
        return new BookResource($Book);
    }

    public function update(int $id, UpdateBookRequest $request)
    {
        $data = $request->validated();
        try {
            $Book = $this->BookService->update($id, $data);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        return new BookResource($Book);
    }

    public function delete(int $id)
    {
        try {
            $Book = $this->BookService->delete($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Book not found'], 404);
        }
        return new BookResource($Book);
    }

    public function GetReviews($id)
    {
        $reviews = $this->BookService->BookReviews($id);
        return ReviewResource::collection($reviews);
    }

    public function CompleteBooks()
    {
        $Books = $this->BookService->BooksWithAuthorGenreReviews();
        return BookResource::collection($Books);
    }
}