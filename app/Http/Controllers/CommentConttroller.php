<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Services\CommenrService;

class CommentConttroller extends Controller
{
    //
     //
    private $service;
    
    public function __construct(CommenrService $service)
     {
         $this->service = $service;
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
