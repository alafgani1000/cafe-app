@extends('layouts.app')

@section('content')
    <div class="row isi">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-color text-white">
                    <span class="header-data">Orders</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" width="100%" id="dataOrders">
                        <thead>
                            <tr>
                                <th>TNumber</th>
                                <th>Total Price</th>
                                <th>Date</th>
                                <th>Menu</th>
                                <th width="15%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->tnumber }}</td>
                                    <td>{{ $item->total_price }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <ol>
                                            @foreach ($item->detail as $detail)
                                                <li>{{ $detail->menu }}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a title="Detail" href="{{ route('order.detail', $item->id) }}" class="btn btn-primary text-white"><i class="fas fa-clipboard-list"></i></a>
                                            <button dataId="{{ $item->id }}" class="btn btn-danger btn-cancel-order"><i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- end modal --}}
    <script>
        $(function(){
            Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            $('body').on('click','.btn-cancel-order', function(){
                let dataId = $(this).attr('dataid');
                let url = '{{ route("cancel.order", ":dataId") }}';
                url = url.replace(':dataId', dataId);
                Swal.fire({
                    title: 'Cancel Order ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Submit',
                    preConfirm: () => {
                        $.ajax({
                            type: "PUT",
                            url: url,
                            data: {

                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        }).done(function(response){

                        }).fail(function(response){
                            Toast.fire({
                                title:'error',
                                message:'error'
                            });
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Success',
                            text: "Cancel order success",
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });

                    }
                })
            });
        });
    </script>
@endsection
