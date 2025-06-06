 <div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Add New Role</h5>
                 <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                     aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.staff.storeRole') }}" method="POST">
                 @csrf
                 <div class="modal-body">
                     <div class="form-group">
                         <label for="name">Role Name</label>
                         <input type="text" class="form-control" id="name" name="name" required>
                     </div>
                     <div class="form-group">
                         <label for="access_level">Access Level</label>
                         <select class="form-control" id="access_level" name="access_level" required>
                             <option value="admin">Admin</option>
                             <option value="manager">Manager</option>
                             <option value="staff">Staff</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <label>Permissions</label>
                         <div class="row mt-3">
                             <div class="col-md-6">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_staff" id="perm_manage_staff">
                                     <label class="form-check-label" for="perm_manage_staff">Manage Staff</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_shifts" id="perm_manage_shifts">
                                     <label class="form-check-label" for="perm_manage_shifts">Manage Shifts</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="booking" id="booking">
                                     <label class="form-check-label" for="booking">Manage booking</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="guests" id="guests">
                                     <label class="form-check-label" for="guests">Manage guests</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="Billing" id="Billing">
                                     <label class="form-check-label" for="Billing">Manage Billing</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="Billing" id="Billing">
                                     <label class="form-check-label" for="Billing">Manage Billing</label>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_tasks" id="perm_manage_tasks">
                                     <label class="form-check-label" for="perm_manage_tasks">Manage Tasks</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="view_reports" id="perm_view_reports">
                                     <label class="form-check-label" for="perm_view_reports">View Reports</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="rooms" id="rooms">
                                     <label class="form-check-label" for="rooms">View rooms</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="inventory" id="inventory">
                                     <label class="form-check-label" for="inventory">View inventory</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="Reports" id="Reports">
                                     <label class="form-check-label" for="Reports">View Reports</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="Settings" id="Settings">
                                     <label class="form-check-label" for="Settings">View Settings</label>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Save Role</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
