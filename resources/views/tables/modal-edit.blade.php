<div class="modal fade" id="modal-room-edit" tabindex="-1" aria-labelledby="modalRoomEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Table or Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('table.update', $table->id) }}" id="roomUpdate" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <label for="eroom" class="form-label">Room or Table</label>
                        <input type="text" class="form-control" name="eroom" id="eroom" value="{{ $table->nomor_meja }}">
                        <div id="helpEroom" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="estatus" class="form-label">Tagline</label>
                        <select class="form-select" name="estatus" id="estatus">
                            <option value="1" {{ $table->status == 1 ? 'selected' : '' }}>Available</option>
                            <option value="2" {{ $table->status == 2 ? 'selected' : '' }}>Not Available</option>
                        </select>
                        <div id="helpEstatus" class="help-validate">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Close</button>
                <button id="save" type="submit" form="roomUpdate" class="btn btn-primary"><i class="fas fa-save me-1"></i>Update</button>
            </div>
        </div>
    </div>
</div>
<script>
    var roomModalEdit = new bootstrap.Modal(document.getElementById('modal-room-edit'), {})
    $('#roomUpdate').on('submit', function(event){
        event.preventDefault();
        event.stopPropagation();
        let url = $(this).attr('action');
        let data = $(this).serialize();
        $.ajax({
            type: "PUT",
            url: url,
            data: data
        }).done(function(res){
            Toast.fire({
                icon: 'success',
                title: 'Input success'
            });
            roomModalEdit.hide();
            dataRoom.ajax.reload();
        }).fail(function(res){
            let errors = res.responseJSON.errors;
            $('#helpEroom').text(errors.eroom);
            $('#helpEstatus').text(errors.estatus);
            Toast.fire({
                icon: 'error',
                title: 'Input failed'
            });
        });
    })
</script>
