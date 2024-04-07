<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserRepository
{
    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    
    public function find(string $id) 
    { 
        return $this->model::with(['blogs'])->find($id); 
    }
    
    public function create(array $validated) 
    { 
        return $this->model->create($validated); 
    } 

    public function update(array $validated) 
    { 
        return $this->model->find($validated['id'])->update($validated); 
    }

    public function delete(string $id)
    {
        // 数据库事务处理，要不全部成功，要不全部失败
        DB::transaction(function () use ($id) {
            $user = $this->model->find($id);
            $user->delete();
        });
    }
}
