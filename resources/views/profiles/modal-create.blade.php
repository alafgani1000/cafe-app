<div class="modal fade" id="modal-profile-create" tabindex="-1" aria-labelledby="modalProfileCreate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input New Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('cafe.store') }}" id="profileCreate" class="row g-3">
                    @csrf
                    <div class="col-md-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <div id="helpName" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="tagline" class="form-label">Tagline</label>
                        <input type="text" class="form-control" name="tagline" id="tagline">
                        <div id="helpTagline" class="help-validate">
                        </div>
                    </div>
                    <div  class="col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address">
                        <div id="helpAddress" class="help-validate">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Close</button>
                <button id="save" type="submit" form="profileCreate" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save</button>
            </div>
        </div>
    </div>
</div>
