@extends('admin/layouts/master')

@section('title')
    Staff Management
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush


@section('content')
    <section>
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="font-bold text-dark">Staff Management</h3>
            <!-- Add this button to the card header -->
            <button class="btn btn-light bg-white border float-right mr-2 shadow-0" data-mdb-toggle="modal"
                data-mdb-target="#departmentModal">
                <i class="fa fa-building"></i> |
                Departments
            </button>
        </div>

        <p class="text-secondary">Manage employees, roles, schedules, and tasks</p>
        <!-- Nav Tabs -->
        <ul class="nav nav-tabs border-bottom" id="managementTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="directory-tab" data-mdb-toggle="tab" data-mdb-target="#directory"
                    type="button" role="tab" aria-controls="directory" aria-selected="true">
                    Directory
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="roles-tab" data-mdb-toggle="tab" data-mdb-target="#roles" type="button"
                    role="tab" aria-controls="roles" aria-selected="false">
                    Roles
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="schedule-tab" data-mdb-toggle="tab" data-mdb-target="#schedule" type="button"
                    role="tab" aria-controls="schedule" aria-selected="false">
                    Schedule
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="performance-tab" data-mdb-toggle="tab" data-mdb-target="#performance"
                    type="button" role="tab" aria-controls="performance" aria-selected="false">
                    Performance
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tasks-tab" data-mdb-toggle="tab" data-mdb-target="#tasks" type="button"
                    role="tab" aria-controls="tasks" aria-selected="false">
                    Tasks
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="managementTabsContent" data-aos="fade-up" data-aos-delay="200">
            <div class="tab-pane fade show active" id="directory" role="tabpanel" aria-labelledby="directory-tab">
                <div class="card p-4 border shadow-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="text-dark font-bold">Employee Directory</h4>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary shadow-0" id="AddEmployeeBtn">
                            <i class="fa fa-plus"></i>
                            <i class="fa fa-users"></i>
                        </button>
                    </div>

                    <div class="table-responsive mt-3">
                        {{-- success message alert cloce --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-mdb-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- Validate --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-mdb-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <table class="table w-100" id="employeesDir">
                            <thead class="bg-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Contact</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staff as $employee)
                                    <tr>
                                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                        <td>{{ $employee->role->name }}</td>
                                        <td>{{ $employee->department->name }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $employee->status == 'active' ? 'success' : ($employee->status == 'on_leave' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($employee->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div>{{ $employee->email }}</div>
                                            <div>{{ $employee->phone }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div>
                                                <!-- View Button -->
                                                <a href="{{ route('admin.staff.show', $employee->id) }}"
                                                    class="btn btn-light border btn-sm" title="View Details"
                                                    data-toggle="tooltip">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <!-- Edit Button (triggers modal) -->
                                                <button class="btn btn-light border  btn-sm edit-staff"
                                                    data-id="{{ $employee->id }}"
                                                    data-first_name="{{ $employee->first_name }}"
                                                    data-last_name="{{ $employee->last_name }}"
                                                    data-email="{{ $employee->email }}"
                                                    data-phone="{{ $employee->phone }}"
                                                    data-department_id="{{ $employee->department_id }}"
                                                    data-role_id="{{ $employee->role_id }}"
                                                    data-hire_date="{{ $employee->hire_date->format('Y-m-d') }}"
                                                    data-status="{{ $employee->status }}" title="Edit"
                                                    data-toggle="tooltip">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <!-- Delete Button (triggers confirmation modal) -->
                                                <button class="btn btn-light border   btn-sm delete-staff"
                                                    data-id="{{ $employee->id }}" data-name="{{ $employee->full_name }}"
                                                    title="Delete" data-toggle="tooltip">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <!-- Task Assignment Button -->
                                                <button class="btn btn-light border btn-sm assign-task-btn"
                                                    data-staff-id="{{ $employee->id }}"
                                                    data-staff-name="{{ $employee->first_name }} {{ $employee->last_name }}"
                                                    title="Assign Task" data-toggle="tooltip">
                                                    <i class="fas fa-tasks"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="roles-tab">
                <div class="card p-4 border shadow-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="text-dark font-bold">Role-Based Access Control</h4>
                        <button class="btn btn-primary float-right shadow-0" data-mdb-toggle="modal"
                            data-mdb-target="#addRoleModal">
                            <i class="fa fa-add"></i>
                        </button>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table w-100" id="RolesTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>Role Name</th>
                                    <th>Access Level</th>
                                    <th>Permissions</th>
                                    <th>Members</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $role->access_level == 'admin' ? 'danger' : ($role->access_level == 'manager' ? 'warning' : 'primary') }}">
                                                {{ ucfirst($role->access_level) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($role->permissions)
                                                @foreach (json_decode($role->permissions) as $permission)
                                                    <span class="badge badge-info">{{ $permission }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No specific permissions</span>
                                            @endif
                                        </td>
                                        <td>{{ $role->staff_count() }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-light border edit-role"
                                                data-id="{{ $role->id }}" data-name="{{ $role->name }}"
                                                data-access-level="{{ $role->access_level }}"
                                                data-permissions="{{ $role->permissions }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.staff.destroyRole', $role->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light border">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                <div class="card shadow-0 p-4 border">
                    <h4 class="font-bold text-dark">Shift Schedule</h>
                        <div class="row mt-4">
                            <div class="col-md-6 ">
                                <div class="card shadow-0 border p-3">
                                    <div id="startDateCalendar" class="visible-calendar"></div>
                                    <input type="hidden" id="startDate" name="startDate">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-0 border p-4 h-100">
                                    <h4 class="text-dark font-bold">Today's Shifts</h4>
                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                        <div class="">
                                            <h6 class="text-dark font-bold">Morning Shift</h6>
                                            <h6 class="text-secondary">6:00 AM - 2:00 PM</h6>
                                        </div>
                                        <h6 class="btn-rounded p-2 bg-primary text-white px-3">3 staff</h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                        <div class="">
                                            <h6 class="text-dark font-bold">Afternoon Shift</h6>
                                            <h6 class="text-secondary">2:00 PM - 10:00 PM</h6>
                                        </div>
                                        <h6 class="btn-rounded p-2 bg-primary text-white px-3">3 staff</h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                        <div class="">
                                            <h6 class="text-dark font-bold">Night Shift</h6>
                                            <h6 class="text-secondary">10:00 PM - 6:00 AM</h6>
                                        </div>
                                        <h6 class="btn-rounded p-2 bg-primary text-white px-3">3 staff</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="tab-pane fade" id="performance" role="tabpanel" aria-labelledby="performance-tab">
                <div class="card shadow-0 border p-4">
                    <h4 class="text-dark font-bold">Performance Overview</h4>
                    <div class="mt-4">
                        <div class="chart-container" style="position: relative; height:300px; width:100%">
                            <canvas id="monthlyChart"></canvas>
                        </div>
                        <div class="mt-3 d-flex justify-content-center flex-wrap">
                            <div class="legend-item me-3"><span class="legend-color"
                                    style="background-color: #3e95cd"></span> Jan</div>
                            <div class="legend-item me-3"><span class="legend-color"
                                    style="background-color: #8e5ea2"></span> Feb</div>
                            <div class="legend-item me-3"><span class="legend-color"
                                    style="background-color: #3cba9f"></span> Mar</div>
                            <div class="legend-item"><span class="legend-color" style="background-color: #e8c3b9"></span>
                                Apr</div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
                <div class="card shadow-0 p-4 border">
                    <h4 class="text-dark font-bold">Task Assignments</h4>
                    @foreach ($tasks as $task)
                        <div class="task-item hover-primary d-flex align-items-center justify-content-between border p-3 rounded-3 mt-4"
                            data-task-id="{{ $task->id }}" data-task-name="{{ $task->name }}"
                            data-task-description="{{ $task->description }}" data-task-status="{{ $task->status }}"
                            data-task-priority="{{ $task->priority }}" data-task-due-date="{{ $task->due_date }}">
                            <div>
                                <h6 class="text-dark font-bold">{{ $task->name }}</h6>
                                <h6 class="text-secondary">Assigned to: {{ $task->staff->fullName }}</h6>

                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <span
                                    class="badge badge-{{ $task->status == 'completed'
                                        ? 'success'
                                        : ($task->status == 'in_progress'
                                            ? 'primary'
                                            : ($task->status == 'overdue'
                                                ? 'danger'
                                                : 'secondary')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                                <span
                                    class="badge badge-{{ $task->priority == 'high' ? 'danger' : ($task->priority == 'medium' ? 'warning' : 'info') }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                                <button class="btn btn-sm btn-light text-danger border delete-task-btn"
                                    data-task-id="{{ $task->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-sm btn-light text-info border">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-3">
                        {{$tasks->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
        {{-- includes --}}
        @include('admin.pages.staff.componets.add_employee_modal')
        @include('admin.pages.staff.componets.add_role_modal')
        @include('admin.pages.staff.componets.edit_role_modal')
        @include('admin.pages.staff.componets.manage_departments_modal')
        @include('admin.pages.staff.componets.edit_staff_modal')
        @include('admin.pages.staff.componets.delete_staff_modal')
        @include('admin.pages.staff.componets.task_modal')
        @include('admin.pages.staff.componets.delete_task_modal')
        @include('admin.pages.staff.componets.update_task_modal')
    </section>
@endsection
{{-- roles --}}
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('monthlyChart').getContext('2d');
            const monthlyChart = new Chart(ctx, {
                type: 'bar', // or 'line', 'pie', etc.
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr'],
                    datasets: [{
                            label: 'Jan',
                            data: [12, 19, 3, 5, 6],
                            backgroundColor: '#3e95cd',
                        },
                        {
                            label: 'Feb',
                            data: [8, 15, 7, 9],
                            backgroundColor: '#8e5ea2',
                        },
                        {
                            label: 'Mar',
                            data: [5, 10, 12, 6],
                            backgroundColor: '#3cba9f',
                        },
                        {
                            label: 'Apr',
                            data: [9, 7, 14, 10],
                            backgroundColor: '#e8c3b9',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // We're using custom legend
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    <script>
        $(function() {
            // Handle edit role button click
            $('.edit-role').click(function() {
                var roleId = $(this).data('id');
                var roleName = $(this).data('name');
                var accessLevel = $(this).data('access-level');
                var permissions = $(this).data('permissions');

                // Set form action
                $('#editRoleForm').attr('action', '/admin/staff/roles/' + roleId);

                // Set form values
                $('#edit_name').val(roleName);
                $('#edit_access_level').val(accessLevel);

                // Reset all checkboxes
                $('#editRoleForm input[type="checkbox"]').prop('checked', false);

                // Set checked permissions
                if (permissions) {
                    try {
                        var permArray = JSON.parse(permissions);
                        permArray.forEach(function(perm) {
                            $('#editRoleForm input[value="' + perm + '"]').prop('checked', true);
                        });
                    } catch (e) {
                        console.error('Error parsing permissions:', e);
                    }
                }

                // Show modal
                $('#editRoleModal').modal('show');
            });
        });
    </script>

    <script>
        $(function() {
            // Handle edit role button click
            $('.edit-staff').click(function() {

                $('#edit_id').val($(this).data('id'));
                $('#edit_first_name').val($(this).data('first_name'));
                $('#edit_last_name').val($(this).data('last_name'));
                $('#edit_email').val($(this).data('email'));
                $('#edit_phone').val($(this).data('phone'));
                $('#edit_department_id').val($(this).data('department_id')).trigger('change');
                $('#edit_role_id').val($(this).data('role_id')).trigger('change');
                $('#edit_hire_date').val($(this).data('hire_date'));
                $('#edit_status').val($(this).data('status'));


                $('#editStaffModal').modal('show');
            });
        });
    </script>

    <!-- JS before closing body tag -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };
    </script>

    <script>
        // Department Management
        $(function() {
            // Load departments table
            function loadDepartments() {
                $.ajax({
                    url: '/admin/departments',
                    type: 'GET',
                    success: function(response) {
                        var rows = '';
                        response.forEach(function(department) {
                            rows += `
                        <tr>
                            <td>${department.name}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-light border shadow-0 edit-department"
                                        data-id="${department.id}"
                                        data-name="${department.name}"
                                        data-description="${department.description}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light border shadow-0 delete-department"
                                        data-id="${department.id}">
                                        <i class="fa fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                        });
                        $('#departmentsTable tbody').html(rows);
                    }
                });
            }

            // Load departments when modal opens
            $('#departmentModal').on('show.bs.modal', function() {
                loadDepartments();
                $('#departmentForm')[0].reset();
                $('#department_id').val('');
                $('#saveDepartmentBtn').text('Save Department');
            });

            // Save department (create/update)
            $('#departmentForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var method = $('#department_id').val() ? 'PUT' : 'POST';
                var url = $('#department_id').val() ?
                    '/admin/departments/' + $('#department_id').val() :
                    '/admin/departments';

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        toastr.success(response.message);
                        loadDepartments();
                        $('#departmentForm')[0].reset();
                        $('#department_id').val('');
                        $('#saveDepartmentBtn').text('Save Department');

                        // Reload staff dropdowns if needed
                        if (typeof loadStaffFormDropdowns === 'function') {
                            loadStaffFormDropdowns();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error('An error occurred');
                        }
                    }
                });
            });

            // Edit department
            $(document).on('click', '.edit-department', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var description = $(this).data('description') || '';

                $('#department_id').val(id);
                $('#name').val(name);
                $('#description').val(description);
                $('#saveDepartmentBtn').text('Update Department');

                // Scroll to form
                $('.modal-body').animate({
                    scrollTop: 0
                }, 500);
            });

            // Delete department
            $(document).on('click', '.delete-department', function() {
                if (!confirm('Are you sure you want to delete this department?')) {
                    return;
                }

                var id = $(this).data('id');

                $.ajax({
                    url: '/admin/departments/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        loadDepartments();

                        // Reload staff dropdowns if needed
                        if (typeof loadStaffFormDropdowns === 'function') {
                            loadStaffFormDropdowns();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            toastr.error(xhr.responseJSON.message);
                        } else {
                            toastr.error('An error occurred');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $("#AddEmployeeBtn").click(function() {
            $("#AddEmployeeModal").modal('show');
        })
    </script>

    <script>
        new DataTable('#employeesDir');
        new DataTable('#RolesTable');
    </script>
@endpush
{{-- staff --}}
@push('js')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Handle edit button click
            $(document).on('click', '.edit-staff', function() {
                var staffId = $(this).data('id');
                var route = "{{ route('admin.staff.update', ':id') }}";
                route = route.replace(':id', staffId);

                // Set form action
                $('#editStaffForm').attr('action', route);

                // Populate form fields
                $('#edit_first_name').val($(this).data('first_name'));
                $('#edit_last_name').val($(this).data('last_name'));
                $('#edit_email').val($(this).data('email'));
                $('#edit_phone').val($(this).data('phone'));
                $('#edit_department_id').val($(this).data('department_id')).trigger('change');
                $('#edit_role_id').val($(this).data('role_id')).trigger('change');
                $('#edit_hire_date').val($(this).data('hire_date'));
                $('#edit_status').val($(this).data('status'));

                // Show modal
                $('#editStaffModal').modal('show');
            });

            // Handle delete button click
            $(document).on('click', '.delete-staff', function() {
                var staffId = $(this).data('id');
                var staffName = $(this).data('name');
                var route = "{{ route('admin.staff.destroy', ':id') }}";
                route = route.replace(':id', staffId);

                // Set form action and staff name
                $('#deleteStaffForm').attr('action', route);
                $('#deleteStaffName').text(staffName);

                // Show modal
                $('#deleteStaffModal').modal('show');
            });

            // Handle edit form submission
            $('#editStaffForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var submitButton = form.find('button[type="submit"]');
                var originalText = submitButton.html();

                // Show loading state
                submitButton.prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin mr-1"></i> Saving...');

                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        $('#editStaffModal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: response.success
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        submitButton.prop('disabled', false).html(originalText);

                        if (xhr.status === 422) {
                            // Validation errors
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = '';

                            $.each(errors, function(key, value) {
                                errorMessages += value[0] + '\n';
                            });

                            Toast.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: errorMessages
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred. Please try again.'
                            });
                        }
                    }
                });
            });

            // Handle delete form submission
            $('#deleteStaffForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var submitButton = form.find('button[type="submit"]');
                var originalText = submitButton.html();

                // Show loading state
                submitButton.prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin mr-1"></i> Deleting...');

                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        $('#deleteStaffModal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: response.success
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        submitButton.prop('disabled', false).html(originalText);

                        if (xhr.status === 422) {
                            Toast.fire({
                                icon: 'error',
                                title: 'Cannot Delete',
                                text: xhr.responseJSON.error
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred. Please try again.'
                            });
                        }
                    }
                });
            });

            // Initialize Toast notification
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        });
    </script>
@endpush
{{-- scadual --}}
@push('js')
    <!-- Include jQuery and jQuery UI for the datepicker -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            let startDate = null;
            let endDate = null;

            // Initialize start date calendar
            $("#startDateCalendar").datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                changeMonth: true,
                changeYear: true,
                onSelect: function(dateText, inst) {
                    startDate = new Date(dateText);
                    $("#startDate").val(dateText);

                    // Update end date calendar min date
                    if (endDate && startDate > endDate) {
                        endDate = null;
                        $("#endDate").val('');
                    }
                    $("#endDateCalendar").datepicker("option", "minDate", startDate);

                    highlightSelectedPeriod();
                },
                beforeShowDay: function(date) {
                    // Highlight days in the selected period
                    if (startDate && endDate) {
                        return [true, date >= startDate && date <= endDate ? "highlight-period" : ""];
                    }
                    return [true, ""];
                }
            });

            function highlightSelectedPeriod() {
                $("#startDateCalendar").datepicker("refresh");
            }
        });
    </script>
@endpush
{{-- tasks --}}
@push('js')
    <script>
        // In your main JavaScript file or in a script section
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Task Assignment Modal
            $(document).on('click', '.assign-task-btn, #assignTaskBtn', function() {
                const staffId = $(this).data('staff-id');
                const staffName = $(this).data('staff-name') || $('#staff_name').text();

                $('#task_staff_id').val(staffId);
                $('#taskAssignmentModalLabel').text(`Assign Task to ${staffName}`);
                $('#taskAssignmentModal').modal('show');
            });

            // Submit Task Assignment Form
            $('#taskAssignmentForm').submit(function(e) {
                e.preventDefault();

                const formData = $(this).serialize();
                const staffId = $('#task_staff_id').val();

                $.ajax({
                    url: `/admin/staff/${staffId}/tasks`,
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            $('#taskAssignmentModal').modal('hide');
                            $('#taskAssignmentForm')[0].reset();

                            // Reload the tasks table if on the tasks page
                            if (window.location.pathname.includes('/tasks')) {
                                loadTasks(staffId);
                            }
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message || 'Error assigning task');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // When a task is clicked (you'll need to adjust the selector based on your task listing)
            $(document).on('click', '.task-item', function() {
                const taskId = $(this).data('task-id');
                // Fetch task data
                $.get({
                    url: "{{ route('admin.tasks.show', '') }}/" + taskId,
                    success: function(response) {
                        // Populate the update form
                        $('#task_id').val(response.id);
                        $('#name').val(response.name);
                        $('#description').val(response.description);
                        $('#status').val(response.status);
                        $('#priority').val(response.priority);
                        $('#due_date').val(response.due_date);

                        // Show the modal
                        $('#updateTaskModal').modal('show');
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('Failed to fetch task details');
                    }
                });
            });

            // Update task
            $('#updateTaskBtn').click(function() {
                const taskId = $('#task_id').val();
                const formData = $('#updateTaskForm').serialize();

                $.ajax({
                    url: "{{ route('admin.tasks.update', '') }}/" + taskId,
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        $('#updateTaskModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('Failed to update task');
                    }
                });
            });

            // Delete task modal trigger
            $(document).on('click', '.delete-task-btn', function(e) {
                e.stopPropagation();
                const taskId = $(this).data('task-id');
                $('#delete_task_id').val(taskId);
                $('#deleteTaskModal').modal('show');
            });

            // Delete task
            $('#deleteTaskBtn').click(function() {
                const taskId = $('#delete_task_id').val();

                $.ajax({
                    url: "{{ route('admin.tasks.destroy', '') }}/" + taskId,
                    type: 'DELETE',
                    data: $('#deleteTaskForm').serialize(),
                    success: function(response) {
                        $('#deleteTaskModal').modal('hide');
                        // Remove the task from the UI or refresh the list
                        $(`[data-task-id="${taskId}"]`).remove();
                        // alert(response.message);
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('Failed to delete task');
                    }
                });
            });
        });
    </script>

    <script>
        AOS.init();
    </script>
@endpush
