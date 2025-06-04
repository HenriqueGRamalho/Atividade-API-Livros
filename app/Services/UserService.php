<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $UserRepository;

    public function __construct(UserRepository $UserRepository){
        $this->UserRepository = $UserRepository;
    }

    public function get(){
        $users = $this->UserRepository->get();
        return $users;
    }

    public function details($id){
        return $this->UserRepository->details($id);
    }

    public function store(array $data){
        return $this->UserRepository->store($data);
    }

    public function update($id, $data){
        $user = $this->UserRepository->update($id,$data);
        return $user;
    }

    public function delete(int $id){
        return $this->UserRepository->delete($id);
    }

    public function userReviews($userId)
    {
        return $this->UserRepository->userReviews($userId);
    }
}