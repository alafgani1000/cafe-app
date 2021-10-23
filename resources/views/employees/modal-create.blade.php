<div class="modal fade" id="emp-modal-create" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('employee.store') }}" id="empFormCreate" class="row g-3" novalidate>
                    @csrf
                    <div class="col-md-12">
                        <label for="empNik" class="form-label">Nik</label>
                        <input type="text" class="form-control" name="empNik" id="empNik" aria-describedby="helpEmpNik" >
                        <div id="helpEmpNik" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="empName" id="empName">
                        <div id="helpEmpName" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="empEmail" id="empEmail">
                        <div id="helpEmpEmail" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="empAlamat" class="form-label">Address</label>
                        <input type="text" class="form-control" name="empAlamat" id="empAlamat">
                        <div id="helpEmpAlamat" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empTmpLahir" class="form-label">Place of birth</label>
                        <input type="text" class="form-control" name="empTmpLahir" id="empTmpLahir">
                        <div id="helpEmpTmpLahir" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empTglLahir" class="form-label">Date of birth</label>
                        <input type="date" class="form-control" name="empTglLahir" id="empTglLahir">
                        <div id="helpEmpTglLahir" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empJnsKelamin" class="form-label">Gender</label>
                        <select class="form-select" name="empJnsKelamin" id="empJnsKelamin">
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                        <div id="helpEmpJnsKelamin" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empStatus" class="form-label">Status</label>
                        <select class="form-select" name ="empStatus" id="empStatus">
                            <option value="1">On</option>
                            <option value="2">Off</option>
                        </select>
                        <div id="helpEmpStatus" class="help-validate">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Close</button>
                <button id="save" type="submit" form="empFormCreate" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save</button>
            </div>
        </div>
    </div>
</div>
