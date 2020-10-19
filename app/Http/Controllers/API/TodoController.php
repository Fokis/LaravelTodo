<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $user->load('todos');
        $category = $request->input('category');
        switch ($category) {
            case 'all':
                $list = $user->todos;
                break;
            case 0:
                $list = $user->todos->whereNUll('category_id');
                break;
            default:
                $list = $user->todos->where('category_id', $category);
        }
        return response()->json(TodoResource::collection($list));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'description' => 'required|max:255'
        ]);
        $todo = new Todo();
        $todo->description = $request->input('description');
        $todo->category_id = $request->input('category_id');
        $todo->user_id = Auth::user()->id;
        $todo->save();

        return response()->json(new TodoResource($todo));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Todo $todo
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json('ok');
    }
}
