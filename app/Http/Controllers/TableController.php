<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use DataTables;

class TableController extends Controller
{
    public function index()
    {
        return view('tables.index');
    }

    public function data()
    {
        $table = Table::query();
        return DataTables::of($table)->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'room' => 'required',
            'status' => 'required'
        ], [
            'room.required' => 'The Room or Table field is required',
            'status.required' => 'The status field is required'
        ]);

        $create = Table::create([
            'nomor_meja' => $request->room,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $table = Table::find($id);
        return view('tables.modal-edit', compact('table'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'eroom' => 'required',
                'estatus' => 'required'
            ],
            [
                'eroom.required' => 'The number field is required',
                'estatus.required' => 'The status field is required'
            ]
        );

        $update = Table::where('id',$id)->update([
            'nomor_meja' => $request->eroom,
            'status' => $request->estatus
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function delete($id)
    {
        $table = Table::find($id);
        $table->delete();
        return response()->json([
            'message' => 'success'
        ]);
    }
}
