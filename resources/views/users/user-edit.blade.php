<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userEditForm" type="post" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="ename">Name</label>
                        <input type="text" class="form-control" name="ename" id="ename" value="{{ $user->name }}">
                        <div class="error-feedback" id="ehelpName">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="eusername">Username</label>
                        <input type="text" class="form-control" name="eusername" id="eusername" value="{{ $user->username }}">
                        <div class="error-feedback" id="ehelpUsername">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="eemail" id="eemail" value="{{ $user->email }}">
                        <div class="error-feedback" id="ehelpEmail">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="epassword" id="epassword">
                        <div class="error-feedback" id="ehelpPassword">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="re_password">Re Password</label>
                        <input type="password" class="form-control" name="ere_password" id="ere_password">
                        <div class="error-feedback" id="ehelpRepassword">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="erole" id="erole">
                                <option value="">Pilih role...</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->name }}" {{ ($item->name == $role) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <div class="error-feedback" id="ehelpRole">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Position</label>
                        <input type="text" class="form-control" name="ejabatan" id="ejabatan" value="{{ $user->jabatan }}">
                        <div class="error-feedback" id="ehelpJabatan">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Close</button>
                    <button type="submit" form="userEditForm" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Update</button>
                </div>
            </div>
      </div>
    </div>
</div>
<script>
    $(function() {
        function resetHelp() {
            $('.error-feedback').text('')
        }
        $('#userEditForm').on('submit', function(event) {
            event.preventDefault();
            event.stopPropagation();
            resetHelp();
            let url = $(this).attr('action');
            let data = $(this).serialize();
            $.ajax({
                type: "PUT",
                url: url,
                data: data
            }).done(function(res) {
                Toast.fire({
                    icon: 'success',
                    title: 'Success'
                });
                dataUser.ajax.reload();
                $('#modalEdit').modal('hide');
            }).fail(function(res) {
                let errors = res.responseJSON.errors;
                $('#ehelpName').text(errors.ename);
                $('#ehelpUsername').text(errors.eusername);
                $('#ehelpEmail').text(errors.eemail);
                $('#ehelpPassword').text(errors.epassword);
                $('#ehelpRepassword').text(errors.ere_password);
                $('#ehelpJabatan').text(errors.ejabatan);
                $('#ehelpRole').text(errors.erole);
            });
        });
    })
</script>
