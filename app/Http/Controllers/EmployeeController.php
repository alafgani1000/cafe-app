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

    public function createEmployeeId($id)
    {
        $jumlahCode = 8;
        $codeNol = "00000000";
        $countId = strlen($id);
        $start = 0;
        $end = $jumlahCode - $countId;
        $codeCut = substr($codeNol, $start, $end);
        $code = $codeCut.$id;
        return $code;
    }

    public function store(Request $request)
    {
        $request->validate([
            'empJenisKelamin' => 'required'
        ]);

        $employee = Employee::create([
            'name' => $request->empName,
            'jenis_kelamin' => $request->empJnsKelamin,
            'tempat_lahir' => $request->empTmpLahir,
            'tanggal_lahir' => $request->empTglLahir,
            'alamat' => $request->empAlamat,
            'status' => $request->empStatus,
            'nik' => $request->empNik,
            'email' => $request->empEmail
        ]);
    }

}
