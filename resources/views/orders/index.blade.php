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
                                <th>Id</th>
                                <th>Total Price</th>
                                <th>Date</th>
                                <th>Menu</th>
                                <th width="15%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
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
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        })
    </script>
@endsection
