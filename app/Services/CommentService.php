<?php

namespace App\Services;
use App\Repositories\CommentRepository;


class CommenrService
{
    private $repo;

    public function __construct(
        CommentRepository $repo
    )
    {
        $this->repo = $repo;
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