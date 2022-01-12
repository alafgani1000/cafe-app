<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreate">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userCreateForm" type="post" action="{{ route('user.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <select class="form-control" name="name" id="name">
                                <option value="">Pilih pegawai...</option>
                            @foreach ($emps as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                            @endforeach
                        </select>
                        <div class="error-feedback" id="helpName">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="jokosantoso@test.com">
                        <div class="error-feedback" id="helpEmail">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <div class="error-feedback" id="helpPassword">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="re_password">Re Password</label>
                        <input type="password" class="form-control" name="re_password" id="re_password">
                        <div class="error-feedback" id="helpRepassword">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role">
                                <option value="">Pilih role...</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <div class="error-feedback" id="helpRole">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <button class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times mr-1"></i>Close</button>
                    <button type="submit" form="userCreateForm" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Save</button>
                </div>
            </div>
      </div>
    </div>
</div>
<script>
     var userCreateModal = new bootstrap.Modal(document.getElementById('modalCreate'),{});

    $(function() {
        function resetHelp() {
            $('.error-feedback').text('')
        }

        $('#name').on('change', function(event){
            let userId = $(this).val();
            let url = '{{ route("employee.byid", ":userId") }}';
            url = url.replace(':userId', userId);
            $.ajax({
                type: "GET",
                url: url,
                data: {},
                dataType: "JSON",
            }).done(function(res){
                $('#email').val(res.email);
            }).fail(function(res){

            });
        })

        $('#userCreateForm').on('submit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            resetHelp();
            let url = $(this).attr('action');
            const emp_id = $('#name :selected').val();
            const name = $('#name :selected').text();
            const email = $('#email').val();
            const password = $('#password').val();
            const re_password = $('#re_password').val();
            const role = $('#role :selected').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    emp_id:emp_id,
                    name:name,
                    email:email,
                    password:password,
                    re_password:re_password,
                    role:role
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function(res) {
                Toast.fire({
                    icon: 'success',
                    title: 'Success'
                });
                dataUser.ajax.reload();
                userCreateModal.hide();
            }).fail(function(res) {
                let errors = res.responseJSON.errors;
                $('#helpName').text(errors.name);
                $('#helpEmail').text(errors.email);
                $('#helpPassword').text(errors.password);
                $('#helpRepassword').text(errors.re_password);
                $('#helpRole').text(errors.role);
            });
        });
    })
</script>
