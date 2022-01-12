@extends('layouts.app')

@section('content')
    <div class="row isi">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-color text-white">
                    <span class="header-data">Employee</span>
                    <div class="btn-group float-end">
                        <button class="btn btn-sm btn-light" id="btnCreate"><i class="fas fa-plus-square me-1"></i> Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" width="100%" id="data-user">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="modalContainer">
    </div>

    <script>
        $(function() {
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

            dataUser = $('#data-user').DataTable({
                'processing':true,
                'serverSide':true,
                'ajax': {
                    url: '{{ route("user.data") }}',
                    type: 'GET'
                },
                'columns': [
                    {data:'name', name:'name'},
                    {data:'email', name:'email'},
                    {data:'created_at', name:'created_at', render:function(data, type, meta, row){
                        return moment(data).format('DD-MM-YYYY');
                    }},
                    {data:'id', render:function(data, type, meta, row) {
                        return '<div class="btn-group"><button class="btn btn-warning btn-edit" userid="'+data+'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit text-white"></i></button><button class="btn btn-danger btn-delete" userid="'+data+'" title="Delete"><i class="fas fa-trash"></i></button></div>';
                    }}
                ],
            });

            $("#data-user_filter").addClass('float-end mb-2');
            $(".dt-buttons").css("margin-bottom","0 !important")
            $(".dt-buttons").addClass('float-start mb-0 pb-0');

            $('#btnCreate').on('click',function(event){
                $.ajax({
                    type: "GET",
                    url: "{{ route('user.create') }}",
                    data: {},
                    dataType: "html"
                }).done(function(res) {
                    $('#modalContainer').html(res);
                    userCreateModal.show();
                });
            });

            $('#data-user').on('click','.btn-edit', function() {
                let userId = $(this).attr('userid');
                let url = '{{ route("user.edit", ":userId") }}';
                url = url.replace(':userId', userId);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "html"
                }).done(function(res) {
                    $('#modalContainer').html(res);
                    $('#modalEdit').modal('show');
                }).fail(function(res) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error'
                    });
                });
            });

            $('#data-user').on('click','.btn-delete', function() {
                Swal.fire({
                    title: 'Are you sure delete this user?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    preConfirm: () => {
                        let userId = $(this).attr('userid');
                        let url = '{{ route("user.delete", ":userId") }}';
                        url = url.replace(':userId', userId);
                        $.ajax({
                            type: "delete",
                            url: url,
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        }).done(function (response) {
                            dataUser.ajax.reload();
                        }).fail(function (response) {
                            Toast.fire({
                                icon: 'error',
                                title: "Delete failed"
                            })
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfimed) {
                        Swal.fire(
                            'Deleted',
                            'User data has been deleted.',
                            'success'
                        )
                    }
                });
            });

        })
    </script>
@endsection
