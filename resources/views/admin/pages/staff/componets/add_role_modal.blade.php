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
                                         value="manage_rooms" id="perm_manage_rooms">
                                     <label class="form-check-label" for="perm_manage_rooms">Manage Rooms</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_amenities" id="perm_manage_amenities">
                                     <label class="form-check-label" for="perm_manage_amenities">Manage
                                         Amenities</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_reservations" id="perm_manage_reservations">
                                     <label class="form-check-label" for="perm_manage_reservations">Manage
                                         Reservations</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_guests" id="perm_manage_guests">
                                     <label class="form-check-label" for="perm_manage_guests">Manage Guests</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_inventories" id="perm_manage_inventories">
                                     <label class="form-check-label" for="perm_manage_inventories">Manage
                                         Inventories</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_housekeeping" id="perm_manage_housekeeping">
                                     <label class="form-check-label" for="perm_manage_housekeeping">Manage
                                         Housekeeping</label>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_vendors" id="perm_manage_vendors">
                                     <label class="form-check-label" for="perm_manage_vendors">Manage Vendors</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_invoices" id="perm_manage_invoices">
                                     <label class="form-check-label" for="perm_manage_invoices">Manage
                                         Invoices</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_payments" id="perm_manage_payments">
                                     <label class="form-check-label" for="perm_manage_payments">Manage
                                         Payments</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_departments" id="perm_manage_departments">
                                     <label class="form-check-label" for="perm_manage_departments">Manage
                                         Departments</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_tasks" id="perm_manage_tasks">
                                     <label class="form-check-label" for="perm_manage_tasks">Manage Tasks</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_feedback" id="perm_manage_feedback">
                                     <label class="form-check-label" for="perm_manage_feedback">Manage
                                         Feedback</label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" name="permissions[]"
                                         value="manage_blacklist" id="perm_manage_blacklist">
                                     <label class="form-check-label" for="perm_manage_blacklist">Manage
                                         Blacklist</label>
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
