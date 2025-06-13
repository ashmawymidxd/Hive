  <!-- Modal -->
  <div class="modal fade" id="AddEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                  <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                      aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('admin.staff.store') }}" method="POST">
                      @csrf

                      <div class="row mt-2">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="first_name">First Name</label>
                                  <input type="text" class="form-control" id="first_name" name="first_name" required>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="last_name">Last Name</label>
                                  <input type="text" class="form-control" id="last_name" name="last_name" required>
                              </div>
                          </div>
                      </div>

                      <div class="row mt-2">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="email" class="form-control" id="email" name="email" required>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="phone">Phone</label>
                                  <input type="text" class="form-control" id="phone" name="phone" required>
                              </div>
                          </div>
                      </div>

                      <div class="row mt-2">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="department_id">Department</label>
                                  <select class="form-control" id="department_id" name="department_id" required>
                                      <option value="">Select Department</option>
                                      @foreach ($departments as $department)
                                          <option value="{{ $department->id }}">{{ $department->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="role_id">Role</label>
                                  <select class="form-control" id="role_id" name="role_id" required>
                                      <option value="">Select Role</option>
                                      @foreach ($roles as $role)
                                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>

                      <div class="row mt-2">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="hire_date">Hire Date</label>
                                  <input type="date" class="form-control" id="hire_date" name="hire_date" required>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="status">Status</label>
                                  <select class="form-control" id="status" name="status" required>
                                      <option value="active">Active</option>
                                      <option value="on_leave">On Leave</option>
                                      <option value="terminated">Terminated</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="mt-3">
                          <button type="submit" class="btn btn-primary">Save Staff Member</button>
                          <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">Cancel</a>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-mdb-ripple-init
                      data-mdb-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
