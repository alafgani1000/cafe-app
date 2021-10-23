<div class="modal fade" id="emp-modal-edit" tabindex="-1" aria-labelledby="emp-modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('employee.store') }}" id="empFormEdit" class="row g-3" novalidate>
                    @csrf
                    <div class="col-md-12">
                        <label for="empNikEdit" class="form-label">Nik</label>
                        <input type="text" class="form-control" name="empNikEdit" id="empNikEdit" aria-describedby="helpEmpNikEdit" >
                        <div id="helpEmpNikEdit" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empNameEdit" class="form-label">Name</label>
                        <input type="text" class="form-control" name="empNameEdit" id="empNameEdit">
                        <div id="helpEmpNameEdit" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empEmailEdit" class="form-label">Email</label>
                        <input type="email" class="form-control" name="empEmailEdit" id="empEmailEdit">
                        <div id="helpEmpEmailEdit" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="empAlamatEdit" class="form-label">Address</label>
                        <input type="text" class="form-control" name="empAlamatEdit" id="empAlamatEdit">
                        <div id="helpEmpAlamatEdit" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empTmpLahirEdit" class="form-label">Place of birth</label>
                        <input type="text" class="form-control" name="empTmpLahirEdit" id="empTmpLahirEdit">
                        <div id="helpEmpTmpLahirEdit" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empTglLahirEdit" class="form-label">Date of birth</label>
                        <input type="date" class="form-control" name="empTglLahirEdit" id="empTglLahirEdit">
                        <div id="helpEmpTglLahirEdit" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empJnsKelaminEdit" class="form-label">Gender</label>
                        <select class="form-select" name="empJnsKelaminEdit" id="empJnsKelaminEdit">
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                        <div id="helpEmpJnsKelaminEdit" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="empStatusEdit" class="form-label">Status</label>
                        <select class="form-select" name ="empStatusEdit" id="empStatusEdit">
                            <option value="1">On</option>
                            <option value="2">Off</option>
                        </select>
                        <div id="helpEmpStatusEdit" class="help-validate">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Close</button>
                <button id="save" type="submit" form="empFormEdit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Update</button>
            </div>
        </div>
    </div>
</div>
