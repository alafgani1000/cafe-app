@extends('layouts.app')

@section('content')
    <div class="row isi">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-color text-white">
                    <span class="header-data">Category</span>
                    <div class="btn-group float-end">
                        <button class="btn btn-sm btn-light" id="addBtn"><i class="fas fa-plus-square me-1"></i> Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" width="100%" id="dataMenu">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Initial</th>
                                <th>Discount</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    @include('menus.modal-create')

    <div id="menuModalContainer">

    </div>
    {{-- end modal --}}
    <script>
        $(function(){
            menuCreateModal = new bootstrap.Modal(document.getElementById('modal-menu-create'),{});

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

            $('#addBtn').on('click', function(event){
                menuCreateModal.show();
            });

            dataMenu = $('#dataMenu').DataTable({
                'processing':true,
                'serverSide':true,
                'ajax':'{{ route("menu.data") }}',
                'dom':'Bfrtip',
                'buttons': [
                    'copy', 'csv', 'excel', 'pdf', 'print','pageLength'
                ],
                lengthMenu: [
                    [10, 25, 50, -1], [10, 25, 50, 'All']
                ],
                'columns':[
                    {'data':'name'},
                    {'data':'category.name'},
                    {'data':'price'},
                    {'data':'price_initial'},
                    {'data':'discount'},
                    {'data':nul, render:function(data){
                        return '<a href="{{ url('image_path') }}" >'+data.image+'</a>';
                    }},
                    {'data':'status', render:function(data){
                        if(data.id === 1) {
                            return '<span class="badge bg-success">'+ data.name +'</span>';
                        }else if(data.id === 2) {
                            return '<span class="badge bg-danger">'+ data.name +'</span>';
                        }
                    }},
                    {'data':'id', render:function(data){
                        return '<div class="btn-group"><button dataid="'+data+'" class="btn btn-warning btn-sm menu-btn-edit"><i class="fas fa-edit"></i></button ><button dataid="'+data+'" class="btn btn-danger btn-sm menu-btn-delete"><i class="fas fa-trash"></i></button></div>'
                    }}
                ]
            })

            $("#dataMenu_filter").addClass('float-end mb-2');
            $(".dt-buttons").css("margin-bottom","0 !important")
            $(".dt-buttons").addClass('float-start mb-0 pb-0');

            $('#menuCreate').on('submit', function(event) {
                event.preventDefault();
                event.stopPropagation();
                let url = $(this).attr('action');
                // let data = $(this).serialize();
                let data = new FormData($('#menuCreate')[0]);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    processData: false,
                    contentType: false,
                }).done(function(res){
                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    });
                    menuCreateModal.hide();
                    dataMenu.ajax.reload();
                }).fail(function(res){
                    let errors = res.responseJSON.errors;
                    Toast.fire({
                        icon: 'error',
                        title: 'Input Failed'
                    })
                    $('#helpName').text(errors.name);
                    $('#helpPrice').text(errors.price);
                    $('#helpPriceInitial').text(errors.priceInitial);
                    $('#helpStatus').text(errors.status);
                    $('#helpDiscount').text(errors.discount);
                });
            });

            $('#dataMenu').on('click','.menu-btn-edit', function(event){
                let dataId = $(this).attr('dataid');
                let url = '{{ route("menu.edit", ":dataId") }}';
                url = url.replace(':dataId', dataId);
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'html'
                }).done(function(res){
                    $('#menuModalContainer').html(res);
                    menuUpdateModal.show();
                });
            });

            $("#dataMenu").on("click",".menu-btn-delete", function (event) {
                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    preConfirm: () => {
                        let dataId = $(this).attr("dataid");
                        let url = '{{ route("menu.delete", ":dataId") }}';
                        url = url.replace(':dataId', dataId);
                        $.ajax({
                            type: "delete",
                            url: url,
                            data: "data",
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        }).done(function (response) {
                            dataMenu.ajax.reload();
                        }).fail(function (response) {
                            Toast.fire({
                                icon: 'error',
                                title: "Delete failed"
                            })
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Deleted!',
                        'Category data has been deleted.',
                        'success'
                        )
                    }
                })

            });
        })
    </script>
@endsection
