<?php

namespace App\Services;

use App\Models\Blog;
use App\Repositories\BlogRepositories;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;

class BlogService
{
    /**
     * @var BlogRepository
     */
    private $repo;

    /**
     * Construct function
     *
     * @param BlogRepository $repo repo
     */
    public function __construct(
        BlogRepository $repo
    )
    {
        $this->repo = $repo;
    }
    public function store(string $title, string $body, string $record, string $author, string $image)
    {
        return Blog::create([
            'title'=> $title,
            'body'=> $body,
            'record'=> $record,
            'author'=> $author,
            'image'=> $image,
        ]);
    }

    public function index()
    {
        $all_data = Blog::all();
        if($all_data->count() > 0){
            return response()->json([
                'status'=> 200,
                'message'=>json_decode($all_data)
            ], 200);
        }else{
            return response()->json([
                'status'=> 200,
                'message'=>"暂无任何内容"
            ], 200);
        }
    }

    public function show(string $id)
    {
        $content = $this->repo->getBlogId($id);
        // $content = Blog::find($id);
        if($content){
            return response()->json([
                'status'=> 200,
                'message'=>json_decode($content)
            ], 200);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=>"not found"
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $content = Blog::find($id);
        print json_encode($content);
        $record = [];
        print $record[] = $content;
        if($content){
            $content->update([
                'title'=> $request->title,
                'body'=> $request->body,
                'record'=> json_encode($record),
                'author'=> $request->author,
                'image'=> $request->image,
            ]);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=>"not found"
            ], 404);
        }
    }
}