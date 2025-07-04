
 <div class="form-group mt-3">
     <label>Permissions</label>
     <div class="row mt-3">
         @php
             $permissions = [
                 'manage_rooms' => 'Manage Rooms',
                 'view_amenities' => 'View Amenities',
                 'create_amenities' => 'Create Amenities',
                 'update_amenities' => 'Update Amenities',
                 'delete_amenities' => 'Delete Amenities',
                 'view_room_details' => 'View Room Details',
                 'upload_room_images' => 'Upload Room Images',
                 'delete_room_images' => 'Delete Room Images',
                 'manage_reservations' => 'Manage Reservations',
                 'reservation_check_in' => 'Reservation Check-In',
                 'reservation_check_out' => 'Reservation Check-Out',
                 'reservation_no_show' => 'Mark Reservation as No-Show',
                 'manage_guests' => 'Manage Guests',
                 'search_guests' => 'Search Guests',
                 'view_notifications' => 'View Notifications',
                 'mark_notification_read' => 'Mark Notification as Read',
                 'mark_all_notifications_read' => 'Mark All Notifications as Read',
                 'create_feedback' => 'Submit Guest Feedback',
                 'view_feedback' => 'View Feedbacks',
                 'update_feedback' => 'Update Feedback Status',
                 'add_blacklist' => 'Add to Blacklist',
                 'update_blacklist_status' => 'Update Blacklist Status',
                 'manage_staff' => 'Manage Staff',
                 'update_staff_password' => 'Update Staff Password',
                 'view_roles' => 'View Roles',
                 'create_role' => 'Create Role',
                 'update_role' => 'Update Role',
                 'delete_role' => 'Delete Role',
                 'manage_departments' => 'Manage Departments',
                 'assign_tasks' => 'Assign Tasks',
                 'view_task' => 'View Task',
                 'update_task' => 'Update Task',
                 'delete_task' => 'Delete Task',
                 'view_inventory' => 'View Inventory Page',
                 'manage_inventory' => 'Manage Inventories',
                 'manage_housekeeping' => 'Manage Housekeeping Items',
                 'view_housekeeping_alerts' => 'View Housekeeping Alerts',
                 'update_housekeeping_reorder' => 'Update Housekeeping Reorder Point',
                 'manage_vendors' => 'Manage Vendors',
                 'manage_invoices' => 'Manage Invoices',
                 'download_invoice' => 'Download Invoice',
                 'print_invoice' => 'Print Invoice',
                 'mark_invoice_paid' => 'Mark Invoice as Paid',
                 'manage_payments' => 'Manage Payments',
                 'manage_expenses' => 'Manage Expenses',
                 'create_expense_category' => 'Create Expense Category',
                 'delete_expense_category' => 'Delete Expense Category',
                 'manage_taxes'=> 'Manage Taxes',
                 'view_reports' => 'View Reports',
             ];
         @endphp

         <div class="row">
             @foreach ($permissions as $key => $label)
                 <div class="col-md-6 mb-3">
                     <div class="form-check">
                         <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]"
                             value="{{ $key }}" id="perm_{{ $key }}"
                             @if (in_array($key, $selectedPermissions ?? [])) checked @endif>
                         <label class="form-check-label" for="perm_{{ $key }}">
                             <span class="permission-label">{{ $label }}</span>
                             @if (isset($permissionDescriptions[$key]))
                                 <small
                                     class="text-muted permission-description">{{ $permissionDescriptions[$key] }}</small>
                             @endif
                         </label>
                     </div>
                 </div>
             @endforeach
         </div>

         @if (count($permissions) > 10)
             <div class="permission-actions mt-3">
                 <button type="button" class="btn btn-sm btn-outline-secondary select-all-perms">Select All</button>
                 <button type="button" class="btn btn-sm btn-outline-secondary deselect-all-perms">Deselect
                     All</button>
             </div>
         @endif

         <!-- Add this JavaScript to handle the check/uncheck functionality -->
         <script>
             document.addEventListener('DOMContentLoaded', function() {
                 // Select all/deselect all functionality
                 document.querySelector('.select-all-perms')?.addEventListener('click', function() {
                     document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                         checkbox.checked = true;
                     });
                 });

                 document.querySelector('.deselect-all-perms')?.addEventListener('click', function() {
                     document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                         checkbox.checked = false;
                     });
                 });

                 // Group selection by category if permissions are grouped
                 // Example: If permission keys follow "category.permission" format
                 document.querySelectorAll('[data-permission-category]').forEach(categoryHeader => {
                     categoryHeader.addEventListener('click', function() {
                         const category = this.dataset.permissionCategory;
                         const checkboxes = document.querySelectorAll(
                             `.permission-checkbox[value^="${category}."]`);
                         const allChecked = Array.from(checkboxes).every(cb => cb.checked);

                         checkboxes.forEach(checkbox => {
                             checkbox.checked = !allChecked;
                         });
                     });
                 });
             });
         </script>
     </div>
 </div>
