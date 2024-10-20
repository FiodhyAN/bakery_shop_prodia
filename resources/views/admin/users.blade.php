@extends('layouts.app', ['title' => 'User Management'])
@section('content')
    <div class="main-content">
        <div class="modal fade" id="addUserModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                        <h5 class="modal-title">Add New User</h5>
                        <a href="javascript:;" class="primaery-menu-close add-form-close-btn" data-bs-dismiss="modal">
                            <i class="material-icons-outlined">close</i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <form class="row g-3" id="formAddUser">
                                @csrf
                                <div class="col-md-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name"
                                        name="name" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email"
                                        name="email" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0" id="inputChoosePassword"
                                            placeholder="Enter Password" name="password">
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class="bi bi-eye-slash-fill"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="user_role" class="form-label">Role</label>
                                    <select id="user_role" class="form-select" name="user_role">
                                        <option selected="" disabled>Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="finance">Finance</option>
                                        <option value="operation">Operation</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-grd-danger px-4" id="addUserBtn">Add</button>
                                        <button type="button" class="btn btn-grd-info px-4 add-form-close-btn"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editUserModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                        <h5 class="modal-title">Edit User</h5>
                        <a href="javascript:;" class="primaery-menu-close edit-form-close-btn" data-bs-dismiss="modal">
                            <i class="material-icons-outlined">close</i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <form class="row g-3" id="formEditUser">
                                @csrf
                                <input type="hidden" id="user_id_edit" name="id">
                                <div class="col-md-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name_edit" placeholder="Name"
                                        name="name" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email_edit" placeholder="Email"
                                        name="email" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group" id="show_hide_password_edit">
                                        <input type="password" class="form-control border-end-0"
                                            id="inputChoosePasswordEdit" placeholder="Enter Password" name="password">
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class="bi bi-eye-slash-fill"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="user_role" class="form-label">Role</label>
                                    <select id="user_role_edit" class="form-select" name="user_role">
                                        <option selected="" disabled>Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="finance">Finance</option>
                                        <option value="operation">Operation</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-grd-danger px-4"
                                            id="editUserBtn">Save</button>
                                        <button type="button" class="btn btn-grd-info px-4 edit-form-close-btn"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Management</div>
            <div class="ms-auto">
                <button type="button" class="btn btn-grd-primary px-4 raised d-flex gap-2" data-bs-toggle="modal"
                    data-bs-target="#addUserModal"><i class="material-icons-outlined">person_add</i>Add New User</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="users-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
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
@endsection
@section('scripts')
    <script>
        const addUserUrl = "{{ route('users.store') }}";
        const deleteUserUrl = "{{ route('users.delete') }}";
        const editUserUrl = "{{ route('users.edit') }}";
        const updateUserUrl = "{{ route('users.update') }}";
    </script>
    <script src="assets/js/users.js"></script>
@endsection
