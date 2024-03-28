<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Services\BlogService;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function __construct(
        protected BlogService $service,
    )
    {
        
    }

    public function store(Request $request)
    {
        $post = $this->service->store(
            $request->get(key:'title'),
            $request->get(key:'body'),
            $request->get(key:'record'),
            $request->get(key:'author'),
            $request->get(key:'image')
    );

        return response()->json([
            'post' => $post
        ]);
    }

    public function index()
    {
        $index = $this->service->index();
        return $index;
    }

    public function show(int $id)
    {
        $blog = $this->service->show(
            $id
        );
        return $blog;
    }

    public function update(Request $request, int $id)
    {
        $blog = $this->service->update(
            $request,
            $id
        );
        return $blog;
    }
}
