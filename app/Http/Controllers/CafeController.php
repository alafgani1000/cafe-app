<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cafe;
use DataTables;

class CafeController extends Controller
{
    public function index()
    {
        return view('profiles.index');
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
        return view('profiles.modal-edit', compact('cafe'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'ename' => 'required',
                'etagline' => 'required',
                'eaddress' => 'required'
            ],
            [
                'ename.required' => 'The name field is required',
                'etagline.required' => 'The tagline field is required',
                'eaddress.required' => 'The address field is required'
            ]
        );

        $update = Cafe::where('id',$id)->update([
            'nama' => $request->ename,
            'tagline' => $request->etagline,
            'alamat' => $request->eaddress
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function delete($id)
    {
        $cafe = Cafe::where('id',$id)->first();
        $cafe->delete();
        return response()->json([
            'message' => 'success'
        ]);
    }
}
