<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index');
    }

    public function create(Request $request)
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $employee = Employee::create([
            'employee_id' => $request->id
        ]);
    }

}
