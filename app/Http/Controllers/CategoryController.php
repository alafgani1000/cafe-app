<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }

    public function data()
    {
        $categories = Category::query();
        return DataTables::of($categories)->toJson();
    }

    public function edit(Request $request, $id)
    {
        $category = Category::find($id);
        return view('categories.modal-edit', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $create = Category::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'ename' => 'required'
            ],
            [
                'ename.required' => 'The name field is required'
            ]
        );

        $update = Category::where('id',$id)->update([
            'name' => $request->ename
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function delete($id)
    {
        $category = Category::where('id',$id)->first();
        $category->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
