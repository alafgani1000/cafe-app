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
                    <table class="table table-bordered" width="100%" id="dataCategory">
                        <thead>
                            <tr>
                                <th>Name</th>
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
    @include('categories.modal-create')

    <div id="catModalContainer">

    </div>
    {{-- end modal --}}
    <script>
        $(function(){
            catCreateModal = new bootstrap.Modal(document.getElementById('modal-category-create'),{});

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
                catCreateModal.show();
            });

            dataCategory = $('#dataCategory').DataTable({
                'processing':true,
                'serverSide':true,
                'ajax':'{{ route("category.data") }}',
                'dom':'Bfrtip',
                'buttons': [
                    'copy', 'csv', 'excel', 'pdf', 'print','pageLength'
                ],
                lengthMenu: [
                    [10, 25, 50, -1], [10, 25, 50, 'All']
                ],
                'columns':[
                    {'data':'name'},
                    {'data':'id', render:function(data){
                        return '<div class="btn-group"><button dataid="'+data+'" class="btn btn-warning btn-sm cat-btn-edit"><i class="fas fa-edit"></i></button ><button dataid="'+data+'" class="btn btn-danger btn-sm cat-btn-delete"><i class="fas fa-trash"></i></button></div>'
                    }}
                ]
            })

            $("#dataCategory_filter").addClass('float-end mb-2');
            $(".dt-buttons").css("margin-bottom","0 !important")
            $(".dt-buttons").addClass('float-start mb-0 pb-0');

            $('#categoryCreate').on('submit', function(event) {
                event.preventDefault();
                event.stopPropagation();
                let url = $(this).attr('action');
                let data = $(this).serialize();
                $.ajax({
                    type: 'post',
                    url: url,
                    data: data
                }).done(function(res){
                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    });
                    catCreateModal.hide();
                    dataCategory.ajax.reload();
                }).fail(function(res){
                    let errors = res.responseJSON.errors;
                    $('#helpName').text(errors.name);
                });
            });

            $('#dataCategory').on('click','.cat-btn-edit', function(event){
                let dataId = $(this).attr('dataid');
                let url = '{{ route("category.edit", ":dataId") }}';
                url = url.replace(':dataId', dataId);
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'html'
                }).done(function(res){
                    $('#catModalContainer').html(res);
                    catUpdateModal.show();
                });
            });

            $("#dataCategory").on("click",".cat-btn-delete", function (event) {
                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    preConfirm: () => {
                        let dataId = $(this).attr("dataid");
                        let url = '{{ route("category.delete", ":dataId") }}';
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
                            dataCategory.ajax.reload();
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
