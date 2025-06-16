<!-- Edit Staff Modal -->
<div class="modal fade" id="editStaffModal" tabindex="-1" role="dialog" aria-labelledby="editStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStaffModalLabel">Edit Staff Member</h5>
               <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="editStaffForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="edit_first_name" class="font-weight-bold">First Name</label>
                                <input type="text" class="form-control" id="edit_first_name" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="edit_last_name" class="font-weight-bold">Last Name</label>
                                <input type="text" class="form-control" id="edit_last_name" name="last_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_email" class="font-weight-bold">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                                <small class="form-text text-muted">Must be unique</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_phone" class="font-weight-bold">Phone</label>
                                <input type="text" class="form-control" id="edit_phone" name="phone" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_department_id" class="font-weight-bold">Department</label>
                                <select class="form-control select2" id="edit_department_id" name="department_id" required style="width: 100%;">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_role_id" class="font-weight-bold">Role</label>
                                <select class="form-control select2" id="edit_role_id" name="role_id" required style="width: 100%;">
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_hire_date" class="font-weight-bold">Hire Date</label>
                                <input type="date" class="form-control" id="edit_hire_date" name="hire_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_status" class="font-weight-bold">Status</label>
                                <select class="form-control" id="edit_status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="on_leave">On Leave</option>
                                    <option value="terminated">Terminated</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
