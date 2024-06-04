<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;


class CommentRepository
{
    private Comment $model;

    public function __construct(Comment $model)
    {
        $this->model = $model;
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
