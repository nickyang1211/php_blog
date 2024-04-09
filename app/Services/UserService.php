<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UserService
{
    private $repo;
    public function __construct(
        UserRepository $repo,
    )
    {
        $this->repo = $repo;
    }

    public function login(array $validated)
    {
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            $user = Auth::user();
            return $user;
        } else {
            throw new HttpResponseException(response()->json(['message' => 'Invalid credentials'], 422));
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->regenerateToken();
        session()->invalidate();
        return redirect(route('login'));
    }

    public function find(string $id)
    {
        return $this->repo->find($id);
    }
    
    public function create(array $validated)
    {
        $user = $this->repo->find($validated['email']);
        if (isset($user)) {
            throw new HttpResponseException(response()->json([
                "status"=>422,
                "message"=>'用户已存在'
            ],422));
        }
        $validated['password'] = password_hash($validated['password'], PASSWORD_BCRYPT);
        $user = $this->repo->create($validated);
        return $user;
        
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