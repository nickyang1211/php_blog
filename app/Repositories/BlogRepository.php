<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Support\Facades\DB;


class BlogRepository
{
    private Blog $model;

    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function all() 
    { 
        return $this->model->get(); 
    } 
    
    public function find(string $id) 
    { 
        return $this->model->find($id); 
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
            $blog = $this->model->find($id);
            $blog->delete();
        });
    }
}
