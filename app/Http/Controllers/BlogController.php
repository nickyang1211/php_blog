<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Http\Resources\BlogResource;
use App\Http\Resources\EmptyResource;


class BlogController extends Controller
{
    //
    private $service;
    
    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    public function show(string $id)
    {
        $data = $this->service->find($id);
        if($data===null) {
            return response()->json([
                'status'=>404,
                "message"=>"文章不存在"
            ], 404);
        }
        return BlogResource::make($data)->response();
    }

    public function index()
    {
        $data = $this->service->all();
        if($data === null) {
            return response()->json([
                'status'=>200,
                "message"=>"暂无任何内容"
            ], 200);
        }
        return response(BlogResource::collection($data));
    }

    public function store(Request $request)
    {
        $validated = $request->validated();
        $data = $this->service->create($validated);
        return response($data);
    }

    public function update(Request $request)
    {
        $validated = $request->validated();
        $validated['id'] = $request->route('id');
        $this->service->update($validated);
        return response('success');
    }

    public function destroy(Request $request)
    {
        $this->service->delete($request->route('id'));
        return response('success');
    }
}
