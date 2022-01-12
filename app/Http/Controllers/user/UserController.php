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
            'employee_id' => $request->emp_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user = User::where('employee_id', $request->emp_id)->first();
        $user->assignRole($request->role);

        return response()->json([
            'message' => 'Success'
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $users = User::all();
        $roles = Role::all();
        $role = isset($user->roles) ? $user->roles()->first()->name : '';
        return view('users.user-edit', compact('user','roles','role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'erole' => 'required',
        ],[
            'erole.required' => 'The role field is required'
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
                'password' => Hash::make($request->epassword),
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
        if(empty($roles)) {
            $role = $roles->first();
            $user->removeRole($role);
        }
        $user->delete();
        return response()->json([
            'message' => 'Delete success'
        ]);
    }
}
