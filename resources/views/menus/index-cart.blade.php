@extends('layouts.app')

@section('content')
    @php
        $no = 0;
    @endphp

    <div class="row isi">

    </div>
    <div class="row isi" id="dataCart">
        <script>
            function getDataOrder() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('data-order') }}",
                    data: {},
                    dataType: "html"
                }).done(function(response) {
                    $('#dataCart').html(response);
                });
            }

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

                getDataOrder();

            })
        </script>
    </div>
@endsection
