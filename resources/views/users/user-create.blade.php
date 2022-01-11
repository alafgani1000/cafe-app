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
            let value = $(this).val();
            alert(value);
        })

        $('#userCreateForm').on('submit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            resetHelp();
            let url = $(this).attr('action');
            let data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: data
            }).done(function(res) {
                Toast.fire({
                    icon: 'success',
                    title: 'Success'
                });
                dataUser.ajax.reload();
                $('#modalCreate').modal('hide');
            }).fail(function(res) {
                let errors = res.responseJSON.errors;
                $('#helpName').text(errors.name);
                $('#helpUsername').text(errors.username);
                $('#helpEmail').text(errors.email);
                $('#helpPassword').text(errors.password);
                $('#helpRepassword').text(errors.re_password);
                $('#helpJabatan').text(errors.jabatan);
                $('#helpRole').text(errors.role);
            });
        });
    })
</script>
