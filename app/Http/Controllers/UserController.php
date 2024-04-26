<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;


class UserController extends Controller
{
    //
     //
     private $service;
    
     public function __construct(UserService $service)
     {
         $this->service = $service;
     }

     public function login(UserLoginRequest $request)
     {
        $validated = $request->validated();
        $data = $this->service->login($validated);
        return response(new UserResource($data));
     }

     public function logout()
    {
        return $this->service->logout();
    }


     public function show(string $id)
     {
         $data = $this->service->find($id);
         if($data===null) {
             return response()->json([
                 'status'=>422,
                 "message"=>"用户不存在"
             ], 422);
         }
         return UserResource::make($data)->response();
     }
 
 
     public function store(UserStoreRequest $request)
     {
        
        $validated = $request->validated();
        echo $validated;
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
