<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * menampilkan data user
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * menampilkan form untuk membuat user baru
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * menampilkan form untuk edit user
     * @param $request
     * @param $id
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * input data user
     * @param $request
     */
    public function store(Request $request)
    {   
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return 'Create user success';
    }

    /**
     * update data user
     * @param $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->update([
            'name' => $request->nama,
            'email'=> $request->email,
            'password' => $request->password
        ]);
        
        return 'Update user success';
    }

    /**
     * delete data user
     * @param $request
     * @param $id
     */
    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        return 'Delete user success';
    }
}
