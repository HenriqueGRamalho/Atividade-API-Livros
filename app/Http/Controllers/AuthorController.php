<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthorService;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AuthorController extends Controller
{
    private AuthorService $authorService;

    public function __construct(AuthorService $authorService){
        $this->authorService = $authorService;
    }

    public function get(){
        $authors = $this->authorService->get();
        return AuthorResource::collection($authors);
    }

    public function details($id){
        try{
            $author = $this->authorService->details($id);
        }catch(ModelNotFoundException $e){
            return response->json(['error'=>'Author not found'], 404);
        }
        
        return new AuthorResource($author);
    }

    public function store(StoreAuthorRequest $request){
        $data = $request->validated();
        $author = $this->authorService->store($data);
        return new AuthorResource($author);
    }

    public function update(int $id, UpdateAuthorRequest $request) {
        $data = $request->validated();
        try {
            $autor = $this->authorService->update($id, $data);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error'=>'Author not found'],404);
        }
        return new AuthorResource($autor);
    }


    public function delete(int $id) {
        try {
            $author = $this->authorService->delete($id);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error'=>'Author not found'],404);
        }
        return new AuthorResource($autor);
    }

    public function GetBooks($id)
    {
        $author = $this->authorService->GetAuthorBooks($id);
        return new AuthorResource($author);
    }

    public function AuthorsWithBooks()
    {
        $authors = $this->authorService->GetBooksWithAuthors();
        return AuthorResource::collection($authors);
    }

}
