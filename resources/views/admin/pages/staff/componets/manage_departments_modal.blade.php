 <!-- Add this modal at the bottom of the file -->
 <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Manage Departments</h5>
                 <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                     aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row mb-3">
                     <div class="col-md-6">
                         <div class="card shadow-0 p-3 border h-35vh">
                             <h5>Add New Department</h5>
                             <form id="departmentForm">
                                 @csrf
                                 <input type="hidden" id="department_id" name="id">
                                 <div class="form-group">
                                     <label for="name">Department Name</label>
                                     <input type="text" class="form-control" id="name" name="name" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="description">Description</label>
                                     <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                                 </div>
                                 <button type="submit" class="btn btn-primary shadow-0 mt-3 w-100 p-3"
                                     id="saveDepartmentBtn">Save
                                     Department</button>
                             </form>
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="card shadow-0 p-3 border h-35vh overflow-scroll">
                             <table class="table" id="departmentsTable">
                                 <thead class="bg-light">
                                     <tr>
                                         <th>Name</th>
                                         <th>Actions</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <!-- Departments will be loaded via AJAX -->
                                 </tbody>
                             </table>

                         </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
