<?php

use App\Http\Controllers\API\TodoController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TodoResource;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/categories', function() {
    return CategoryResource::collection(Category::all());
});

Route::middleware('auth:api')->group(function () {
    Route::resource('todos', TodoController::class)->only(['index','store','destroy']);
});



