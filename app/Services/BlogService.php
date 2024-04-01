<?php

namespace App\Services;

use App\Models\Blog;
use App\Repositories\BlogRepository;
use Dotenv\Util\Str;
use Illuminate\Http\Request;

class BlogService
{
    private $repo;

    public function __construct(
        BlogRepository $repo
    )
    {
        $this->repo = $repo;
    }

    public function all()
    {
        return $this->repo->all();
    }

    public function find(string $id)
    {
        return $this->repo->find($id);
    }
    
    public function create(array $validated)
    {
        return $this->repo->create($validated);
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