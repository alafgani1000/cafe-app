    <div class="card">
        <div class="card-header">
            <h6 class="modal-title">Ordered food and drink list</h6>
        </div>
        <div class="card-body">
            @if (!empty($orders))
                <div class="form-group" height="200px" style="overflow-y:scroll;">
                    <label for="formFileSm" class="form-label">Select Table or Room</label>
                    <form method="POST" action="{{ route('save-order') }}" id="formSaveOrder">
                        @csrf
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th>Table or Room</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tables as $item)
                                        <tr>
                                            <td><input type="checkbox" name="room[]" value="{{ $item->id }}"> {{ $item->nomor_meja }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </form>
                </div>
                <table class="table mt-2">
                    <thead>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                            $total_bayar = 0;
                        @endphp
                        @foreach ($orders as $order)
                            @php
                                $no = $no + 1;
                                $total_bayar = $total_bayar + ($order['qty'] * $order['price']);
                            @endphp
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $order['name'] }}</td>
                                <td><input type="text" id="qty{{ $order['menuId'] }}" value="{{ $order['qty'] }}"></td>
                                <td>Rp. {{ number_format($order['price']) }}</td>
                                <td>Rp. {{ number_format($order['qty'] * $order['price']) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button dataId="{{ $order['menuId'] }}" class="btn btn-sm btn-warning text-white btn-edit"><i class="fas fa-save"></i></button>
                                        <button dataId="{{ $order['menuId'] }}" class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="4" class="text-end">Total: </td>
                                <td>Rp. {{ number_format($total_bayar) }}</td>
                                <td>&nbsp;</td>
                            </tr>
                    </tbody>
                </table>
                <button id="save" type="submit" class="btn btn-primary float-end" form="formSaveOrder" ><i class="fas fa-cart-plus me-1"></i>Order</button>
            @else
                <table class="table" width="100%">
                    <tr>
                        <td style="text-align: center;">
                            <h5>Order not found</h5>
                        </td>
                    </tr>
                </table>
            @endif

        </div>
    </div>

<script>
    $(function() {
        Toast1 = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        function getOrder() {
            $.ajax({
                type: "GET",
                url: "{{ route('count-order') }}",
                data: {},
                dataType: "json"
            }).done(function(res){
                $("#countOrder").text(res.count);
            });
        }

        $('.btn-delete').on('click', function(e) {
            let id = $(this).attr('dataId');
            let qty = $('#qty'+id).val();
            $.ajax({
                type: "POST",
                url: "{{ route('delete-order') }}",
                data: {
                    id:id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){
                }
            }).done(function(response) {
                Toast1.fire({
                    icon: 'success',
                    title: 'Delete order success'
                });
                getDataOrder();
            }).fail(function(){
                Toast1.fire({
                    icon: 'error',
                    title: 'Error'
                })
            });
        });

        $('.btn-edit').on('click', function(e) {
            let id = $(this).attr('dataId');
            let qty = $('#qty'+id).val();
            $.ajax({
                type: "POST",
                url: "{{ route('update-order') }}",
                data: {
                    id:id,
                    qty:qty
                },
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){
                }
            }).done(function(res){
                Toast1.fire({
                    icon: 'success',
                    title: 'order edit success'
                });
                getDataOrder();
            }).fail(function(res){
                Toast1.fire({
                    icon: 'error',
                    title: 'Error'
                });
            });
        });

        $('#formSaveOrder').on('submit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            let data = $(this).serialize();
            let url = $(this).attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: data
            }).done(function(){
                Toast1.fire({
                    icon: 'success',
                    title: 'Save order success'
                });
                getDataOrder();
            }).fail(function(){
                Toast1.fire({
                    icon: 'error',
                    title: 'Order Fail'
                });
            });
        });
    });
</script>
