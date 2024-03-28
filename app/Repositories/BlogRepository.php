<?php

namespace App\Repositories;

use App\Models\Blog;

class BlogRepository
{
    public function getBlogId(int $id): ?Blog
    {
        return Blog::where('id', $id)->first();
    }
}