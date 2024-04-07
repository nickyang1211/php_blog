<?php

namespace App\Services;

use App\Repositories\UserRepository;


class UserService
{
    private $repo;

    public function __construct(
        UserRepository $repo
    )
    {
        $this->repo = $repo;
    }

    public function find(string $id)
    {
        return $this->repo->find($id);
    }
    
    public function create(array $validated)
    {
        $user = $this->repo->find($validated['email']);
        if (isset($user)) {
            return response()->json([
                "status"=>422,
                "message"=>'用户已存在'
            ],422);
        }else {
            $validated['password'] = password_hash($validated['password'], PASSWORD_BCRYPT);
            $user = $this->repo->create($validated);
            return $user;
        }
    }

    public function update(array $validated)
    {
        return $this->repo->update($validated);
    }

    public function delete(string $id)
    {
        return $this->repo->delete($id);
    }

}