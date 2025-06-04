<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GenreService;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Http\Resources\GenreResource;
use App\Http\Resources\BookResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GenreController extends Controller
{
    private GenreService $GenreService;

    public function __construct(GenreService $GenreService)
    {
        $this->GenreService = $GenreService;
    }

    public function get()
    {
        $Genres = $this->GenreService->get();
        return GenreResource::collection($Genres);
    }

    public function details($id)
    {
        try {
            $Genre = $this->GenreService->details($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Genre not found'], 404);
        }
        return new GenreResource($Genre);
    }

    public function store(StoreGenreRequest $request)
    {
        $data = $request->validated();
        $Genre = $this->GenreService->store($data);
        return new GenreResource($Genre);
    }

    public function update(int $id, UpdateGenreRequest $request)
    {
        $data = $request->validated();
        try {
            $Genre = $this->GenreService->update($id, $data);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Genre not found'], 404);
        }
        return new GenreResource($Genre);
    }

    public function delete(int $id)
    {
        try {
            $Genre = $this->GenreService->delete($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Genre not found'], 404);
        }
        return new GenreResource($Genre);
    }

    public function GetBooks($id)
    {
        $Books = $this->GenreService->GenreOfBooks($id);
        return BookResource::collection($Books);
    }

    public function GenresWithBooks()
    {
        $Genres = $this->GenreService->GenresWithTheirBooks();
        return GenreResource::collection($Genres);
    }
}