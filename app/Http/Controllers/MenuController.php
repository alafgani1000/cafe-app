<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use DataTables;

class MenuController extends Controller
{
    public function index()
    {
        return view('menus.index');
    }

    public function data()
    {
        $menus = Menu::query();
        return DataTables::of($menus)->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'status' => 'required',
            'price' => 'required',
            'price_inital' => 'required',
            'discount' => 'required'
        ]);

        $create = Menu::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'status' => $request->status,
            'price' => $request->price,
            'price_initial' => $request->price_initial,
            'discount' => $request->discount
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $menu = Menu::find($id);
        return view('menus.modal-update', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'status' => 'required',
            'price' => 'required',
            'price_inital' => 'required',
            'discount' => 'required'
        ]);

        $update = Menu::where('id',$id)->update([
            'category_id' => $request->category,
            'name' => $request->name,
            'status' => $request->status,
            'price' => $request->price,
            'price_initial' => $request->price_initial,
            'discount' => $request->discount
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }
}
