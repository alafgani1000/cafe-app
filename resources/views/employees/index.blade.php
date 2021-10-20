@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-color text-white">
                    Employee
                    <div class="btn-group float-end">
                        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#emp-modal-create"><i class="fas fa-plus-square me-1"></i> Add</button>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="emp-modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Input New Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="empName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="empName" id="empName">
                    </div>
                    <div class="col-md-6">
                      <label for="empEmail" class="form-label">Email</label>
                      <input type="email" class="form-control" name="empEmail" id="empEmail">
                    </div>
                    <div class="col-md-6">
                      <label for="empPassword" class="form-label">Password</label>
                      <input type="password" class="form-control" name="empPassword" id="empPassword">
                    </div>
                    <div class="col-md-6">
                        <label for="empRePassword" class="form-label">Re Password</label>
                        <input type="password" class="form-control" name="empRePassword" id="empRePassword">
                    </div>
                    <div class="col-md-12">
                        <label for="empAlamat" class="form-label">Address</label>
                        <input type="text" class="form-control" name="empAlamat" id="empAlamat">
                    </div>
                    <div class="col-md-6">
                        <label for="empTmpLahir" class="form-label">Place of birth</label>
                        <input type="text" class="form-control" name="empTmpLahir" id="empTmpLahir">
                    </div>
                    <div class="col-md-6">
                        <label for="empTglLahir" class="form-label">Date of birth</label>
                        <input type="date" class="form-control" name="empTglLahir" id="empTglLahir">
                    </div>
                    <div class="col-md-6">
                        <label for="empJnsKelamin" class="form-label">Gender</label>
                        <select class="form-select" name="empJenisKelamin" id="empJenisKelamin">
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="empStatus" class="form-label">Status</label>
                        <select class="form-select" name ="empStatus" id="empStatus">
                            <option value="1">On</option>
                            <option value="2">Off</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-trash me-1"></i>Close</button>
            <button type="button" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save</button>
            </div>
        </div>
        </div>
    </div>
@endsection
