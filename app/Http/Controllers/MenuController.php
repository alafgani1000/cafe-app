<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('menus.index', compact('categories'));
    }

    public function data()
    {
        $menus = Menu::with('category')->with('status');
        return DataTables::of($menus)->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'status' => 'required',
            'price' => 'required|numeric',
            'priceInitial' => 'required',
            'discount' => 'required'
        ]);

        $oriName = $request->file('image')->getClientOriginalName();
        $ext = $request->file('image')->extension();
        $name = uniqid();

        $imageName = $name . '.' . $ext;
        $path = $request->file('image')->storeAs('public', $imageName);
        $create = Menu::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'status' => $request->status,
            'price' => $request->price,
            'price_initial' => $request->priceInitial,
            'discount' => $request->discount,
            'image' => $oriName,
            'image_path' => $imageName
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $menu = Menu::find($id);
        $categories = Category::all();
        return view('menus.modal-update', compact('menu', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ecategory' => 'required',
            'ename' => 'required',
            'estatus' => 'required',
            'eprice' => 'required|numeric',
            'epriceInitial' => 'required',
            'ediscount' => 'required'
        ]);

        if ($request->file('eimage') != null) {
            $oriName = $request->file('eimage')->getClientOriginalName();
            $ext = $request->file('eimage')->extension();
            $name = uniqid();

            $imageName = $name . '.' . $ext;
            $path = $request->file('eimage')->storeAs('public', $imageName);

            $update = Menu::where('id', $id)->update([
                'category_id' => $request->ecategory,
                'name' => $request->ename,
                'status' => $request->estatus,
                'price' => $request->eprice,
                'price_initial' => $request->epriceInitial,
                'discount' => $request->ediscount,
                'image' => $oriName,
                'image_path' => $imageName
            ]);
        } else {
            $update = Menu::where('id', $id)->update([
                'category_id' => $request->ecategory,
                'name' => $request->ename,
                'status' => $request->estatus,
                'price' => $request->eprice,
                'price_initial' => $request->epriceInitial,
                'discount' => $request->ediscount,
            ]);
        }

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return response()->json([
            'message' => 'success'
        ]);
    }

    public function listMenu()
    {
        $foods = Menu::with('category')->get();
        return view('menus.list-menu', compact('foods'));
    }

    public function listCategory($id)
    {
        $menus = Menu::where('category_id', $id)->get();
        return view('menus.list-category', compact('menus'));
    }
}
