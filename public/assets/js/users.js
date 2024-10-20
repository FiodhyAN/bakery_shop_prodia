$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bi-eye-slash-fill");
            $('#show_hide_password i').removeClass("bi-eye-fill");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bi-eye-slash-fill");
            $('#show_hide_password i').addClass("bi-eye-fill");
        }
    });
    $('#show_hide_password_edit a').on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password_edit input').attr("type") == "text") {
            $('#show_hide_password_edit input').attr('type', 'password');
            $('#show_hide_password_edit i').addClass("bi-eye-slash-fill");
            $('#show_hide_password_edit i').removeClass("bi-eye-fill");
        } else if ($('#show_hide_password_edit input').attr("type") == "password") {
            $('#show_hide_password_edit input').attr('type', 'text');
            $('#show_hide_password_edit i').removeClass("bi-eye-slash-fill");
            $('#show_hide_password_edit i').addClass("bi-eye-fill");
        }
    });
    const table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/users/get',
            type: 'GET'
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'user_role', name: 'user_role' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $('.add-form-close-btn').on('click', function() {
        resetForm();
    });
    $('.edit-form-close-btn').on('click', function() {
        resetEditForm();
    });

    $('#formAddUser').validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            user_role: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter name"
            },
            email: {
                required: "Please enter email",
                email: "Please enter valid email"
            },
            password: {
                required: "Please enter password",
                minlength: "Password must be at least 8 characters long"
            },
            user_role: {
                required: "Please select role"
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "password") {
                error.insertAfter("#show_hide_password");
            } else {
                error.insertAfter(element);
            }
        },
        success: function(label, element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            $('#addUserModal').modal('hide');
            Swal.fire({
                title: 'Creating User',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            var formData = new FormData(form)
            
            $.ajax({
                type: "POST",
                url: addUserUrl,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'User Created',
                        showConfirmButton: true,
                        timer: 1500
                    })
                    table.ajax.reload();
                    resetForm();
                },
                error: function(response) {
                    Swal.close();
                    $('#addUserModal').modal('show');
                    var errors = response.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function(key, value) {
                            var element = $('[name="' + key + '"]');
                            element.addClass('is-invalid');
                            element.next('label.error').remove();
                            element.after('<label class="error" for="' + key + '">' + value[0] + '</label>');
                        });
                    }
                }
            })
        },
        invalidHandler: function(event, validator) {
            $('#addUserBtn').attr('disabled', false);
        }
    });
    $('#addUserBtn').attr('disabled', true);
    $('#formAddUser input').on('input', function() {
        if ($('#formAddUser').valid()) {
            $('#addUserBtn').attr('disabled', false);
        } else {
            $('#addUserBtn').attr('disabled', true);
        }
    });
    $('#formAddUser select').on('change', function() {
        if ($('#formAddUser').valid()) {
            $('#addUserBtn').attr('disabled', false);
        } else {
            $('#addUserBtn').attr('disabled', true);
        }
    });

    table.on('click', '.delete-btn', function() {
        var id = $(this).data('user_id');
        
        Swal.fire({
            title: 'Delete User',
            text: "Are you sure you want to delete this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            cancelButtonText: 'Cancel',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    url: deleteUserUrl,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'User Deleted',
                            showConfirmButton: true,
                            timer: 1500
                        })
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to delete user',
                            showConfirmButton: true
                        })
                    }
                });
            }
        });
    });

    table.on('click', '.edit-btn', function() {
        var id = $(this).data('user_id');
        $.ajax({
            url: editUserUrl,
            type: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                $('#editUserModal').modal('show');
                $('#editUserModal #user_id_edit').val(response.id);
                $('#editUserModal #name_edit').val(response.name);
                $('#editUserModal #email_edit').val(response.email);
                $('#editUserModal #user_role_edit').val(response.user_role);
            }
        });
    });

    $('#formEditUser ').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Updating User',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });
    
        var formData = new FormData(this);
    
        $.ajax({
            type: "POST",
            url: updateUserUrl,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'User  Updated',
                    showConfirmButton: true,
                    timer: 1500
                });
                table.ajax.reload();
                $('#editUserModal').modal('hide');
                resetEditForm();
            },
            error: function(response) {
                Swal.close();
                $('#editUserModal').modal('show');
                var errors = response.responseJSON.errors;
                if (errors) {
                    $.each(errors, function(key, value) {
                        var element = $('[name="' + key + '"]');
                        if (key == 'password') {
                            element = $('#show_hide_password_edit');
                        }
                        element.addClass('is-invalid');
                        element.next('label.error').remove();
                        element.after('<label class="error" for="' + key + '">' + value[0] + '</label>');
                    });
                }
            }
        });
    });
});

function resetForm() {
    $('#formAddUser')[0].reset();
    $('#formAddUser input').removeClass('is-valid');
    $('#formAddUser select').removeClass('is-valid');
    $('#formAddUser input').removeClass('is-invalid');
    $('#formAddUser select').removeClass('is-invalid');
    $('#formAddUser').validate().resetForm();
}

function resetEditForm() {
    $('#formEditUser')[0].reset();
    $('#formEditUser input').removeClass('is-valid');
    $('#formEditUser select').removeClass('is-valid');
    $('#formEditUser input').removeClass('is-invalid');
    $('#formEditUser select').removeClass('is-invalid');
    $('#formEditUser label.error').remove();
}