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
                    {{-- @include('admin.pages.staff.componets.admin_roles') --}}

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Save Role</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
