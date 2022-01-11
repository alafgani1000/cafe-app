<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DataTables;

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
        $request->validate(
            [
                'empJnsKelamin' => 'required',
                'empTglLahir' => 'required',
                'empTmpLahir' => 'required',
                'empAlamat' => 'required',
                'empStatus' => 'required',
                'empNik' => 'required',
                'empEmail' => 'required',
                'empName' => 'required'
            ],
            [
                'empJnsKelamin.required' => 'The gender field is required',
                'empTglLahir.required' => 'The date of birth field is required',
                'empTmpLahir.required' => 'The place of birth lahir field is required',
                'empAlamat.required' => 'The address field is required',
                'empStatus.required' => 'The status field is required',
                'empNik.required' => 'The nik field is required',
                'empEmail.required' => 'The email field is required',
                'empName.required' => 'The name field is required'
            ]
        );

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

        $emp = Employee::where('nik',$request->empNik)->first();
        $empId = $this->createEmployeeId($emp->id);
        $emp->employee_id = $empId;
        $emp->save();

        return response()->json([
            "message" => "success"
        ], 200);

    }

    public function data()
    {
        $model = Employee::query();
        return DataTables::of($model)->toJson();
    }

    public function edit(Request $request, $id)
    {
        $employee = Employee::find($id);
        return view('employees.modal-edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'empJnsKelaminEdit' => 'required',
                'empTglLahirEdit' => 'required',
                'empTmpLahirEdit' => 'required',
                'empAlamatEdit' => 'required',
                'empStatusEdit' => 'required',
                'empNikEdit' => 'required',
                'empEmailEdit' => 'required',
                'empNameEdit' => 'required'
            ],
            [
                'empJnsKelaminEdit.required' => 'The gender field is required',
                'empTglLahirEdit.required' => 'The date of birth field is required',
                'empTmpLahirEdit.required' => 'The place of birth lahir field is required',
                'empAlamatEdit.required' => 'The address field is required',
                'empStatusEdit.required' => 'The status field is required',
                'empNikEdit.required' => 'The nik field is required',
                'empEmailEdit.required' => 'The email field is required',
                'empNameEdit.required' => 'The name field is required'
            ]
        );

        $employee = Employee::where('id',$id)->update([
            'name' => $request->empNameEdit,
            'jenis_kelamin' => $request->empJnsKelaminEdit,
            'tempat_lahir' => $request->empTmpLahirEdit,
            'tanggal_lahir' => $request->empTglLahirEdit,
            'alamat' => $request->empAlamatEdit,
            'status' => $request->empStatusEdit,
            'nik' => $request->empNikEdit,
            'email' => $request->empEmailEdit
        ]);

        return response()->json([
            "message" => "success"
        ], 200);
    }

    public function delete(Request $request, $id)
    {
        $delete = Employee::find($id);
        $delete->delete();
        return response()->json([
            "message" => "Delete success"
        ], 200);
    }

    public function getById($id)
    {
        $emp = Employee::find($id);
        return response()->json([
            'email' => $emp->email
        ]);
    }

}
