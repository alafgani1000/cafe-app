<div class="modal fade" id="modal-menu-edit" tabindex="-1" aria-labelledby="modalMenuEdit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('menu.update', $menu->id) }}" id="menuUpdate" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="ecategory" class="form-label">Category</label>
                        <select class="form-select" name="ecategory">
                            @foreach ($categories as $category)
                                <option value={{ $category->id }} {{ $menu->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="ename" class="form-label">Name</label>
                        <input type="text" class="form-control" name="ename" id="ename" value="{{ $menu->name }}">
                        <div id="helpEname" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="epriceInitial" class="form-label">Price Initial</label>
                        <input type="text" class="form-control" name="epriceInitial" id="epriceInitial" value="{{ $menu->price_initial }}">
                        <div id="helpEpriceInitial" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="ediscount" class="form-label">Discount</label>
                        <input type="text" class="form-control" name="ediscount" id="ediscount" value="{{ $menu->discount }}">
                        <div id="helpEdiscount" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="eprice" class="form-label">Price</label>
                        <input type="text" class="form-control" name="eprice" id="eprice" value="{{ $menu->price }}" readonly>
                        <div id="helpEprice" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="estatus" class="form-label">Status</label>
                        <select class="form-select" name="estatus" id="estatus">
                            <option value="1" {{ $menu->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="2" {{ $menu->status == 2 ? 'selected' : '' }}>In Actice</option>
                        </select>
                        <div id="helpEstatus" class="help-validate">
                        </div>
                    </div>
                     <div class="col-md-6">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="eimage" id="eimage">
                        <div id="helpImage" class="help-validate">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Close</button>
                <button id="save" type="submit" form="menuUpdate" class="btn btn-primary"><i class="fas fa-save me-1"></i>Update</button>
            </div>
        </div>
    </div>
</div>
<script>
    var menuUpdateModal = new bootstrap.Modal(document.getElementById('modal-menu-edit'), {});

      $('#ediscount').on('change', function (event) {
            let discount = event.target.value;
            let price = parseFloat($('#epriceInitial').val());
            let priceActual = price - (price * discount / 100);
            $('#eprice').val(priceActual);
        })


    $('#menuUpdate').on('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();
        let url = $(this).attr('action');
        let data = $(this).serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: data
        }).done(function(res){
            Toast.fire({
                icon: 'success',
                title: 'Update success'
            });
            menuUpdateModal.hide();
            dataMenu.ajax.reload();
        }).fail(function(res){
            let errors = res.responseJSON.errors;
            $('#helpEcategory').text(errors.ecategory);
            $('#helpEname').text(errors.ename);
            $('#helpEstatus').text(errors.estatus);
            $('#helpEprice').text(errors.eprice);
            $('#helpEpriceInitial').text(errors.epriceInitial)
            $('#helpEdiscount').text(errors.ediscount);
            Toast.fire({
                icon: 'error',
                title: 'Update failed'
            });
        });
    })
</script>
