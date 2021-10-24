@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-color text-white">
                    <span class="header-data">Employee</span>
                    <div class="btn-group float-end">
                        {{-- <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#emp-modal-create"><i class="fas fa-plus-square me-1"></i> Add</button> --}}
                        <button class="btn btn-sm btn-light" id="addBtn"><i class="fas fa-plus-square me-1"></i> Add</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" width="100%" id="dataEmployee">
                        <thead>
                            <tr>
                                <th>Employee Id</th>
                                <th>Nik</th>
                                <th>Name</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('employees.modal-create')

    <div id="containerModalUpdate">
    </div>
    @push('scripts')
    <script>
        $(function() {
            dataEmp = $("#dataEmployee").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('employee.data') }}",
                "dom": 'Bfrtip',
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print','pageLength'
                ],
                lengthMenu: [
                    [10, 25, 50, -1], [10, 25, 50, 'All']
                ],
                "columns": [
                    { "data": "employee_id" },
                    { "data": "nik" },
                    { "data": "name" },
                    { "data": "alamat" },
                    { "data": "email"},
                    { "data": "jenis_kelamin" },
                    { "data": "tempat_lahir" },
                    { "data": "tanggal_lahir" },
                    { "data": "id", render:function(data, type, row, meta) {
                        return '<div class="btn-group"><button empid="'+data+'" class="btn btn-warning btn-sm emp-btn-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit text-white"></i></button><button class="btn btn-danger btn-sm emp-btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" empid="'+data+'"><i class="fas fa-trash text-white"></i></button></div>';
                    }}
                ]
            });

            $("#dataEmployee_filter").addClass('float-end mb-2');
            $(".dt-buttons").css("margin-bottom","0 !important")
            $(".dt-buttons").addClass('float-start mb-0 pb-0');

            var empCreateModal = new bootstrap.Modal(document.getElementById('emp-modal-create'), {});

            $("#dataEmployee").on("click",".emp-btn-edit", function (event) {
                let empId = $(this).attr("empid");
                let url = '{{ route("employee.edit", ":empId") }}';
                url = url.replace(':empId', empId);
                $.ajax({
                    type: "get",
                    url:url,
                    dataType:'html'
                }).done(function (response) {
                    $("#containerModalUpdate").html(response);
                    empUpdateModal.show();
                }).fail(function (response) {

                });
            });

            $("#dataEmployee").on("click",".emp-btn-delete", function (event) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    preConfirm: () => {
                        let empId = $(this).attr("empid");
                        let url = '{{ route("employee.delete", ":empId") }}';
                        url = url.replace(':empId', empId);
                        $.ajax({
                            type: "delete",
                            url: url,
                            data: "data",
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        }).done(function (response) {
                            dataEmp.ajax.reload();
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
                        'Employee data has been deleted.',
                        'success'
                        )
                    }
                })

            });

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

            $("#addBtn").on("click", function(event) {
                empCreateModal.show();
            });

            $("#empFormCreate").on("submit", function(event) {
                event.preventDefault();
                let data = $(this).serialize();
                let url = $(this).attr("action");
                $.ajax({
                    type: "post",
                    url: url,
                    data: data,
                }).done(function(response){
                    empCreateModal.hide();
                    dataEmp.ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })
                }).fail(function(response){
                    let errors = response.responseJSON.errors;
                    $("#helpEmpNik").text(errors.empNik);
                    $("#helpEmpName").text(errors.empName);
                    $("#helpEmpEmail").text(errors.empEmail);
                    $("#helpEmpAlamat").text(errors.empAlamat);
                    $("#helpEmpTmpLahir").text(errors.empTmpLahir);
                    $("#helpEmpTglLahir").text(errors.empTglLahir);
                    $("#empJnsKelamin").text(errors.empJnsKelamin);
                    $("#empStatus").text(errors.empStatus);
                })
            });
        })
    </script>
    @endpush
@endsection
