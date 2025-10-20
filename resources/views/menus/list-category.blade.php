@extends('layouts.app')

@section('content')
    @php
        $no = 0;
    @endphp

    <div class="row isi">
        @role('pramuniaga|pramusaji')
            <div class="col" style="margin-top:10px;">
                <a href="{{ route('index-order') }}" class="btn btn-light position-relative float-end" style="box-shadow:1px 2px 3px 1px silver;" id="cartItem">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success" id="countOrder">
                        0
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>
            </div>
        @endrole
    </div>
    <div class="row isi">
    @foreach ($menus as $food)
        <div class="col-sm-3 padding-menu">
            @php
                $image = 'storage/'.$food->image_path;
            @endphp
            <div class="card">
                <div class="card-body" style="margin: 0 !important; padding: 0 !important;">
                    <img width="100%" height="100%" src="{{ url($image) }}" />
                </div>
                <div class="card-footer" style="text-align:center">
                    <span style="font-size: 14px; font-weight: bold">{{ $food->name }}</span><br/>
                    <span style="font-size: 14px; font-weight: bold">Rp. {{ number_format($food->price) }}</span>
                    <div class="input-group mb-2 mt-3">
                        <input type="number" class="form-control" class="qty">
                        <button dataId="{{ $food->id }}" class="btn btn-success btn-cart-add" type="button" id="button-addon2"><i class="fa fa-cart-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div id="modalContainer">

    </div>
        <script>
            $(function(){
                Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
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

                function getDataOrder() {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('data-order') }}",
                        data: {},
                        dataType: "html"
                    }).done(function(response) {
                        $('#modalContainer').html(response);
                        cartModal.show();
                    });
                }

                getOrder();

                $('#cartItem').on('click', function(){
                    getDataOrder();
                });

                $('.btn-cart-add').on('click', function() {
                    let id = $(this).attr('dataId');
                    let qty = $(this).prev().val();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('order') }}",
                        data: {
                            id:id,
                            qty:qty
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }).done(function(){
                        getOrder();
                        Toast.fire({
                            icon:'success',
                            title:'Order success'
                        })
                    });
                });
            })

        </script>
    </div>
@endsection
