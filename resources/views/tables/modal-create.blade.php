<div class="modal fade" id="modal-room-create" tabindex="-1" aria-labelledby="modalRoomCreate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input New Table or Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('table.store') }}" id="roomCreate" class="row g-3">
                    @csrf
                    <div class="col-md-12">
                        <label for="room" class="form-label">Room or Table</label>
                        <input type="text" class="form-control" name="room" id="room">
                        <div id="helpRoom" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="status" class="form-label">Tagline</label>
                        <select class="form-select" name="status" id="status">
                            <option value="1">Available</option>
                            <option value="2">Not Available</option>
                        </select>
                        <div id="helpStatus" class="help-validate">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Close</button>
                <button id="save" type="submit" form="roomCreate" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save</button>
            </div>
        </div>
    </div>
</div>
