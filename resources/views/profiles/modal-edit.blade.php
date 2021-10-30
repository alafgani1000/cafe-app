<div class="modal fade" id="modal-profile-edit" tabindex="-1" aria-labelledby="modalProfileEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('cafe.update', $cafe->id) }}" id="profileUpdate" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <label for="ename" class="form-label">Name</label>
                        <input type="text" class="form-control" name="ename" id="ename" value="{{ $cafe->nama }}">
                        <div id="helpEname" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="etagline" class="form-label">Tagline</label>
                        <input type="text" class="form-control" name="etagline" id="etagline" value="{{ $cafe->tagline }}">
                        <div id="helpEtagline" class="help-validate">
                        </div>
                    </div>
                    <div  class="col-md-12">
                        <label for="eaddress" class="form-label">Address</label>
                        <input type="text" class="form-control" name="eaddress" id="eaddress" value="{{ $cafe->alamat }}">
                        <div id="helpEaddress" class="help-validate">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Close</button>
                <button id="save" type="submit" form="profileUpdate" class="btn btn-primary"><i class="fas fa-save me-1"></i>Update</button>
            </div>
        </div>
    </div>
</div>
<script>
    var profileEditModal = new bootstrap.Modal(document.getElementById('modal-profile-edit'))

    $('#profileUpdate').on('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();
        let url = $(this).attr('action');
        let data = $(this).serialize();
        $.ajax({
            type: "PUT",
            url: url,
            data: data
        }).done(function(res) {
            profileEditModal.hide();
            dataProfile.ajax.reload();
            Toast.fire({
                icon: 'success',
                title: 'Update success'
            })
        }).fail(function(res) {
            let errors = res.responseJSON.errors;
            $('#helpEname').text(errors.ename);
            $('#helpEtagline').text(errors.etagline);
            $('#helpEaddress').text(errors.eaddress);
            Toast.fire({
                icon: 'error',
                title: 'Update failed'
            });
        });
    });
</script>
