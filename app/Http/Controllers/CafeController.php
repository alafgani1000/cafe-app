<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cafe;
use DataTables;

class CafeController extends Controller
{
    public function index()
    {
        return view('cafes.index');
    }

    public function data()
    {
        $cafe = Cafe::query();
        return DataTables::of($cafe)->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tagline' => 'required',
            'address' => 'required'
        ]);

        $create = Cafe::create([
            'nama' => $request->name,
            'tagline' => $request->tagline,
            'alamat' => $request->address
        ]);

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function edit(Request $request, $id)
    {
        $cafe = Cafe::find($id);
        return view('cafes.modal-edit', compact('cafe'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'tagline' => 'required',
            'address' => 'required'
        ]);

        $update = Cafe::where('id',$id)->update([
            'nama' => $request->name,
            'tagline' => $request->tagline,
            'alamat' => $request->address
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function delete($id)
    {
        $delete = Cafe::where('id',$id)->destroy();
        return response()->json([
            'message' => 'success'
        ]);
    }
}
