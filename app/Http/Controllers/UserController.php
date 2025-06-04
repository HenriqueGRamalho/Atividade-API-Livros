<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    private UserService $UserService;


    public function __construct(UserService $UserService) {
        $this->UserService = $UserService;
    }


    public function get() {
        $Users = $this->UserService->get();
        return UserResource::collection($Users);
    }


    public function details($id) {
        try {
            $User = $this->UserService->details($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'User not found'],404);
        }
        return new UserResource($User);
    }


    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $User = $this->UserService->store($data);
        return new UserResource($User);
    }


    public function update(int $id, UpdateUserRequest $request) {
        $data = $request->validated();
        try {
            $User = $this->UserService->update($id, $data);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error'=>'User not found'],404);
        }
        return new UserResource($User);
    }


    public function delete(int $id) {
        try {
            $User = $this->UserService->delete($id);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error'=>'User not found'],404);
        }
        return new UserResource($User);
    }

    public function UserReviews(int $id)
    {
        $reviews = $this->UserService->UserReviews($id);
        return ReviewResource::collection($reviews);
    }
}