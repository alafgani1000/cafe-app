@extends('layouts.app')

@section('content')
    <div class="row isi">
        <div class="col-sm-12">
            <div>
                <div class="card">
                    <div class="card-header card-header-color text-white">
                        <span class="header-data">Table or Room</span>
                        <div class="btn-group float-end">
                            <button class="btn btn-sm btn-light" id="addBtn"><i class="fas fa-plus-square me-1"></i> Add</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" width="100%" id="dataRoom">
                            <thead>
                                <tr>
                                    <th>Table Number or Room</th>
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
    </div>

    {{-- modal --}}
    @include('tables.modal-create')

    <div id="roomModalContainer"></div>

    <script>
        $(function() {
            var roomModalCreate = new bootstrap.Modal(document.getElementById('modal-room-create'), {});

            function resetHelp() {
                $('#helpRoom').text('');
                $('#helpStatus').text('');
            }

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

            dataRoom = $('#dataRoom').DataTable({
                'processing':true,
                'serverSide':true,
                'ajax': '{{ route('table.data') }}',
                'dom':'Bfrtip',
                'buttons':[
                    'copy', 'csv', 'excel', 'pdf', 'print','pageLength'
                ],
                lengthMenu: [
                    [10, 25, 50, -1], [10, 25, 50, 'All']
                ],
                'columns':[
                    {'data':'nomor_meja'},
                    {'data':'status', render:function(data) {
                        if(data === '1'){
                            return '<span class="badge bg-success">Available</span>';
                        }else if(data === '2'){
                            return '<span class="badge bg-secondary">Not Available</span>';
                        }
                    }},
                    {'data':'id', render:function(data){
                        return '<div class="btn-group"><button dataid="'+data+'" class="btn btn-warning btn-sm room-btn-edit"><i class="fas fa-edit"></i></button ><button dataid="'+data+'" class="btn btn-danger btn-sm room-btn-delete"><i class="fas fa-trash"></i></button></div>'
                    }}
                ]
            });

            $("#dataRoom_filter").addClass('float-end mb-2');
            $(".dt-buttons").css("margin-bottom","0 !important")
            $(".dt-buttons").addClass('float-start mb-0 pb-0');

            $('#addBtn').on('click', function(){
                roomModalCreate.show();
                resetHelp();
            });

            $('#roomCreate').on('submit', function(event) {
                event.preventDefault();
                event.stopPropagation();
                url = $(this).attr('action');
                data = $(this).serialize();
                $.ajax({
                    type: "post",
                    url: url,
                    data: data
                }).done(function(res){
                    roomModalCreate.hide();
                    Toast.fire({
                        icon: 'success',
                        title: 'Success'
                    })
                    dataRoom.ajax.reload();
                }).fail(function(res){
                    let errors = res.responseJSON.errors;
                    $('#helpRoom').text(errors.room);
                    $('#helpStatus').text(errors.status);
                    Toast.fire({
                        icon: 'error',
                        title: 'Input failed'
                    });
                });
            });

            $('#dataRoom').on('click','.room-btn-edit', function() {
                let dataId = $(this).attr('dataid');
                let url = '{{ route("table.edit", ":dataId") }}';
                url = url.replace(':dataId', dataId);
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {},
                    dataType: "html",
                }).done(function(res){
                    $('#roomModalContainer').html(res);
                    roomModalEdit.show();
                });
            });

            $('#dataRoom').on('click', '.room-btn-delete', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    preConfirm: () => {
                        let dataId = $(this).attr("dataid");
                        let url = '{{ route("table.delete", ":dataId") }}';
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
                            dataRoom.ajax.reload();
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
                        'Table data has been deleted.',
                        'success'
                        )
                    }
                })
            })
        });
    </script>
@endsection
