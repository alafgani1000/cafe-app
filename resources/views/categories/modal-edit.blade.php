<div class="modal fade" id="modal-category-edit" tabindex="-1" aria-labelledby="modalCategoryEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('category.update', $category->id) }}" id="categoryUpdate" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <label for="ename" class="form-label">Name</label>
                        <input type="text" class="form-control" name="ename" id="ename" value="{{ $category->name }}">
                        <div id="helpEname" class="help-validate">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Close</button>
                <button id="save" type="submit" form="categoryUpdate" class="btn btn-primary"><i class="fas fa-save me-1"></i>Update</button>
            </div>
        </div>
    </div>
</div>
<script>
    var catUpdateModal = new bootstrap.Modal(document.getElementById('modal-category-edit'),{});

    $('#categoryUpdate').on('submit', function(event) {
        event.preventDefault();
        event.stopPropagation();
        let url = $(this).attr('action');
        let data = $(this).serialize();
        $.ajax({
            type: "PUT",
            url: url,
            data: data
        }).done(function(res) {
            Toast.fire({
                icon: 'success',
                title: res.message
            });
            catUpdateModal.hide();
            dataCategory.ajax.reload();
        }).fail(function(res) {
            Toast.fire({
                icon: 'error',
                title: 'Update failed'
            })
            let errors = res.responseJSON.errors;
            $('#helpEname').text(errors.ename);
        });
    });
</script>
