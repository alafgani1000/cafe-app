<div class="modal fade" id="modal-menu-create" tabindex="-1" aria-labelledby="modalMenuCreate">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input New Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('menu.store') }}" id="menuCreate" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category">
                            @foreach ($categories as $category)
                                <option value={{ $category->id }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="helpName" >
                        <div id="helpName" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" name="price" id="price" aria-describedby="helpPrice" >
                        <div id="helpPrice" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="priceInitial" class="form-label">Price Initial</label>
                        <input type="text" class="form-control" name="priceInitial" id="priceInitial" aria-describedby="helpPriceInitial" >
                        <div id="helpPriceInitial" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="1">Active</option>
                            <option value="2">In Actice</option>
                        </select>
                        <div id="helpStatus" class="help-validate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="discount" class="form-label">Discount</label>
                        <input type="text" class="form-control" name="discount" id="discount">
                        <div id="helpDiscount" class="help-validate">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Close</button>
                <button id="save" type="submit" form="menuCreate" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save</button>
            </div>
        </div>
    </div>
</div>
