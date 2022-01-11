<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function data()
    {
        $user = User::query();
        return DataTables::of($user)->toJson();
    }

    public function create()
    {
        $roles = Role::all();
        $users = User::all();
        $emps = Employee::whereNotIn('email',$users->pluck('email'))->get();
        return view('users.user-create',compact('roles','emps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'password' => 'required|same:re_password',
            're_password' => 'required',
            'role' => 'required',
        ]);

        $store = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user = User::where('username', $request->username)->first();
        $user->assignRole($request->role);

        return response()->json([
            'message' => 'Success'
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $role = isset($user->roles) ? $user->roles()->first()->name : '';
        return view('users.user-edit', compact('user','roles','role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ename' => 'required',
            'eusername' => 'required',
            'eemail' => 'email',
            'erole' => 'required',
            'ejabatan' => 'required'
        ],[
            'ename.required' => 'The name field is required',
            'eusername.required' => 'The username field is required',
            'erole.required' => 'The role field is required',
            'eemail.email' => 'The email field format is not same',
            'ejabatan.requried' => 'The jabatan field is required'
        ]);

        $user = User::find($id);
        $roles = $user->getRoleNames();
        $role = $roles->first();
        $user->removeRole($role);
        $user->assignRole($request->erole);

        if(isset($request->epassword)) {
            $request->validate([
                'ere_password' => 'required',
                'epassword' => 'same:ere_password'
            ], [
                'epassword.same' => 'The password and re password must match.'
            ]);
            $update = User::where('id',$id)->update([
                'name' => $request->ename,
                'username' => $request->eusername,
                'email' => $request->eemail,
                'password' => Hash::make($request->epassword),
                'jabatan' => $request->ejabatan
            ]);
        }else{
            $update = User::where('id',$id)->update([
                'name' => $request->ename,
                'username' => $request->eusername,
                'email' => $request->eemail,
                'jabatan' => $request->ejabatan
            ]);
        }

        return response()->json([
            'message' => 'Success'
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $roles = $user->getRoleNames();
        $role = $roles->first();
        $user->removeRole($role);

        $user->delete();

        return response()->json([
            'message' => 'Delete success'
        ]);
    }
}
