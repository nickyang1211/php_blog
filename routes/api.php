<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentConttroller;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('userAuth')->resource('blogs', BlogController::class, ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::middleware('userAuth')->resource('users', UserController::class, ['only' => ['show', 'update', 'destroy']])->parameter('users', 'userId');

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [UserController::class, 'store']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::controller(BlogController::class)
->middleware('userAuth')
->group(function () {
    Route::get('/','index');
    Route::get('/{id}','show');
    Route::post('/','store');
    Route::put('/{id}','update');
    Route::delete('/','destroy');
});

Route::controller(CommentConttroller::class)
->group(function () {
    Route::post('/comment','store');
    Route::put('/comment/{id}','update');
    Route::delete('/comment','destroy');
});
