@extends('admin/layouts/master')

@section('title')
    Inventory Management
@endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@endpush

@section('content')
    <section>
        <h3 class="font-bold text-dark">Inventory Management</h3>
        <p class="text-secondary">Manage all hotel inventory items and supplies </p>
        <div class="row mt-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs border-bottom" id="managementTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="food-tab" data-mdb-toggle="tab" data-mdb-target="#food"
                            type="button" role="tab" aria-controls="food" aria-selected="true">Food &
                            Beverage</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="housekeeping-tab" data-mdb-toggle="tab" data-mdb-target="#housekeeping"
                            type="button" role="tab" aria-controls="housekeeping"
                            aria-selected="false">Housekeeping</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="alerts-tab" data-mdb-toggle="tab" data-mdb-target="#alerts"
                            type="button" role="tab" aria-controls="alerts" aria-selected="false">Reorder
                            Alerts</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vendor-tab" data-mdb-toggle="tab" data-mdb-target="#vendor"
                            type="button" role="tab" aria-controls="vendor" aria-selected="false">Vendor
                            Management</button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="managementTabsContent" data-aos="fade-up" data-aos-delay="200">
                    <div class="tab-pane fade show active" id="food" role="tabpanel" aria-labelledby="food-tab">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card shadow-1 p-3 border">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="text-dark font-bold">Total Items</h6>
                                        <button class="btn btn-outline-white btn-lg btn-floating">
                                            <i class="fa fa-box text-secondary"></i>
                                        </button>
                                    </div>
                                    <h3 class="text-dark font-bold" id="totalItemsCount"></h3>
                                </div>
                            </div>

                            <div class="table-responsive mt-3">
                                <div class="d-flex align-items-center justify-content-end">
                                    <button class="btn btn-primary shadow-0 btn-sm" data-mdb-toggle="modal"
                                        data-mdb-target="#addInventoryModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <table class="table table-hover" id="inventoryTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="housekeeping" role="tabpanel" aria-labelledby="housekeeping-tab">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card shadow-1 p-3 border">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="text-dark font-bold">Total Supplies</h6>
                                        <button class="btn btn-outline-white btn-lg btn-floating">
                                            <i class="fa fa-box text-secondary"></i>
                                        </button>
                                    </div>
                                    <h3 class="text-dark font-bold" id="totalHouseItems"></h3>
                                </div>
                            </div>

                            <div class="table-responsive mt-3">
                                <div class="d-flex align-items-center justify-content-end">
                                    <button class="btn btn-primary shadow-0 btn-sm" data-mdb-toggle="modal"
                                        data-mdb-target="#addItemModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <table class="table table-hover" id="itemsTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="alerts" role="tabpanel" aria-labelledby="alerts-tab">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card shadow-1 p-3 border">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="text-dark font-bold">Active Alerts</h6>
                                        <button class="btn btn-outline-white btn-lg btn-floating">
                                            <i class="fa fa-warning text-warning"></i>
                                        </button>
                                    </div>
                                    <h3 class="text-dark font-bold" id="activeAlertsCount">0</h3>
                                </div>
                            </div>
                            <div class="row mt-3" id="alertsContainer">
                                <!-- Alerts will be loaded here via AJAX -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="vendor" role="tabpanel" aria-labelledby="vendor-tab">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card shadow-1 p-3 border">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="text-dark font-bold">Total Vendors</h6>
                                        <button class="btn btn-outline-white btn-lg btn-floating">
                                            <i class="fa fa-house text-secondary"></i>
                                        </button>
                                    </div>
                                    <h3 class="text-dark font-bold">12</h3>
                                </div>
                            </div>

                            <div class="table-responsive mt-3">
                                <div class="d-flex align-items-center justify-content-end">
                                    <button class="btn btn-primary shadow-0 btn-sm" data-mdb-toggle="modal"
                                        data-mdb-target="#addVendorModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <table class="table table-hover" id="vendorTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Vendor Name</th>
                                            <th>Category</th>
                                            <th>Items Supplied</th>
                                            <th>Last Order</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

    @include('admin.pages.inventories.feedAndDrinkModals.add')
    @include('admin.pages.inventories.feedAndDrinkModals.edit')
    @include('admin.pages.inventories.feedAndDrinkModals.delete')

    @include('admin.pages.inventories.houseKeepingModals.add')
    @include('admin.pages.inventories.houseKeepingModals.edit')
    @include('admin.pages.inventories.houseKeepingModals.delete')

    @include('admin.pages.inventories.reorderAlertsModals.edit')

    @include('admin.pages.inventories.vendorManagementModals.add')
    @include('admin.pages.inventories.vendorManagementModals.edit')
    @include('admin.pages.inventories.vendorManagementModals.delete')
@endsection

{{-- Food And Drink --}}
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    <script>
        $(document).ready(function() {
            // Set up CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Load inventory data on page load
            loadInventoryData();

            // Add new inventory item
            $('#addInventoryForm').submit(function(e) {
                e.preventDefault();
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    url: "{{ route('admin.inventories.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addInventoryModal').modal('hide');
                        $('#addInventoryForm')[0].reset();
                        loadInventoryData();
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (var field in errors) {
                                $('#' + field).addClass('is-invalid');
                                $('#' + field + 'Error').text(errors[field][0]);
                            }
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                    }
                });
            });

            // Edit inventory item - show modal
            $(document).on('click', '.edit-food-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "/admin/inventories/" + id,
                    type: "GET",
                    success: function(response) {
                        $('#edit_id').val(response.id);
                        $('#edit_name').val(response.name);
                        $('#edit_category').val(response.category);
                        $('#edit_quantity').val(response.quantity);
                        $('#edit_unit').val(response.unit);
                        $('#editInventoryModal').modal('show');
                    },
                    error: function() {
                        toastr.error('Failed to load inventory item data.');
                    }
                });
            });

            // Update inventory item
            $('#editInventoryForm').submit(function(e) {
                e.preventDefault();
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');

                var id = $('#edit_id').val();
                $.ajax({
                    url: "/admin/inventories/" + id,
                    type: "PUT",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editInventoryModal').modal('hide');
                        loadInventoryData();
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (var field in errors) {
                                $('#edit_' + field).addClass('is-invalid');
                                $('#edit_' + field + 'Error').text(errors[field][0]);
                            }
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                    }
                });
            });

            // Delete inventory item - show confirmation modal
            $(document).on('click', '.delete-food-btn', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
                $('#deleteInventoryModal').modal('show');
            });

            // Confirm delete
            $('#confirmDelete').click(function() {
                var id = $('#delete_id').val();
                $.ajax({
                    url: "/admin/inventories/" + id,
                    type: "DELETE",
                    success: function(response) {
                        $('#deleteInventoryModal').modal('hide');
                        loadInventoryData();
                        toastr.success(response.message);
                    },
                    error: function() {
                        toastr.error('Failed to delete inventory item.');
                    }
                });
            });

            // Function to load inventory data
            function loadInventoryData() {
                $.ajax({
                    url: "{{ route('admin.inventories.index') }}",
                    type: "GET",
                    success: function(response) {
                        $('#totalItemsCount').text(response.totalItems);

                        var tableBody = $('#inventoryTable tbody');
                        tableBody.empty();

                        if (response.inventories.length > 0) {
                            // display total count in the card
                            $.each(response.inventories, function(index, item) {
                                var statusClass = '';
                                if (item.status === 'In Stock') {
                                    statusClass = 'bg-success';
                                } else if (item.status === 'Low Stock') {
                                    statusClass = 'bg-warning';
                                } else {
                                    statusClass = 'bg-danger';
                                }

                                var row = '<tr>' +
                                    '<td>' + item.name + '</td>' +
                                    '<td>' + item.category + '</td>' +
                                    '<td>' + item.quantity + '</td>' +
                                    '<td>' + item.unit + '</td>' +
                                    '<td><span class="badge rounded-pill text-white p-1 px-2 ' +
                                    statusClass + '">' + item.status + '</span></td>' +
                                    '<td>' +
                                    '<button class="btn btn-sm btn-light border edit-food-btn me-2" data-id="' +
                                    item.id + '"><i class="fas fa-edit"></i></button>' +
                                    '<button class="btn btn-sm btn-light border delete-food-btn" data-id="' +
                                    item.id + '"><i class="fas fa-trash"></i></button>' +
                                    '</td>' +
                                    '</tr>';

                                tableBody.append(row);
                            });
                        } else {
                            tableBody.append(
                                '<tr><td colspan="6" class="text-center">No inventory items found</td></tr>'
                            );
                        }
                    },
                    error: function() {
                        toastr.error('Failed to load inventory data.');
                    }
                });
            }
        });
    </script>
@endpush

{{-- Housekeeping --}}
@push('js')
    <script>
        $(document).ready(function() {
            // Set up CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Load housekeeping items on page load
            loadHousekeepingItems();

            // Add new item
            $('#addItemForm').submit(function(e) {
                e.preventDefault();
                clearValidationErrors();

                $.ajax({
                    url: "{{ route('admin.housekeeping-items.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addItemModal').modal('hide');
                        $('#addItemForm')[0].reset();
                        loadHousekeepingItems();
                        toastr.success(response.message);
                    },
                    error: handleAjaxError
                });
            });

            // Edit item - show modal
            $(document).on('click', '.edit-house-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "/admin/housekeeping-items/" + id,
                    type: "GET",
                    success: function(response) {
                        $('#edit_h_id').val(response.id);
                        $('#edit_h_name').val(response.name);
                        $('#edit_h_category').val(response.category);
                        $('#edit_h_quantity').val(response.quantity);
                        $('#edit_h_unit').val(response.unit);
                        $('#edit_h_notes').val(response.notes);
                        $('#editItemModal').modal('show');
                    },
                    error: function() {
                        toastr.error('Failed to load item data.');
                    }
                });
            });

            // Update item
            $('#editItemForm').submit(function(e) {
                e.preventDefault();
                clearValidationErrors();

                var id = $('#edit_h_id').val();
                $.ajax({
                    url: "/admin/housekeeping-items/" + id,
                    type: "PUT",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editItemModal').modal('hide');
                        loadHousekeepingItems();
                        toastr.success(response.message);
                    },
                    error: handleAjaxError
                });
            });

            // Delete item - show confirmation modal
            $(document).on('click', '.delete-house-btn', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
                $('#deleteItemModal').modal('show');
            });

            // Confirm delete
            $('#confirmDeleteHouse').click(function() {
                var id = $('#delete_id').val();
                $.ajax({
                    url: "/admin/housekeeping-items/" + id,
                    type: "DELETE",
                    success: function(response) {
                        $('#deleteItemModal').modal('hide');
                        loadHousekeepingItems();
                        toastr.success(response.message);
                    },
                    error: function() {
                        toastr.error('Failed to delete item.');
                    }
                });
            });

            // Function to load housekeeping items
            function loadHousekeepingItems() {
                $.ajax({
                    url: "{{ route('admin.housekeeping-items.index') }}",
                    type: "GET",
                    success: function(response) {
                        $('#totalHouseItems').text(response.totalItems);

                        var tableBody = $('#itemsTable tbody');
                        tableBody.empty();

                        if (response.items.length > 0) {
                            $.each(response.items, function(index, item) {
                                var statusClass = getStatusClass(item.status);

                                var row = '<tr>' +
                                    '<td>' + item.name + '</td>' +
                                    '<td>' + item.category + '</td>' +
                                    '<td>' + item.quantity + '</td>' +
                                    '<td>' + item.unit + '</td>' +
                                    '<td><span class="badge badge-warning rounded-pill text-white ' +
                                    statusClass + '">' + item.status + '</span></td>' +
                                    '<td>' +
                                    '<button class="btn btn-sm btn-light border  edit-house-btn me-2" data-id="' +
                                    item.id + '"><i class="fas fa-edit"></i></button>' +
                                    '<button class="btn btn-sm btn-light border  delete-house-btn" data-id="' +
                                    item.id + '"><i class="fas fa-trash"></i></button>' +
                                    '</td>' +
                                    '</tr>';

                                tableBody.append(row);
                            });
                        } else {
                            tableBody.append(
                                '<tr><td colspan="6" class="text-center">No housekeeping items found yet.. </td></tr>'
                            );
                        }
                    },
                    error: function() {
                        toastr.error('Failed to load housekeeping items.');
                    }
                });
            }

            // Helper function to get status class
            function getStatusClass(status) {
                switch (status) {
                    case 'In Stock':
                        return 'bg-success';
                    case 'Low Stock':
                        return 'bg-warning';
                    case 'Critical Stock':
                        return 'bg-danger';
                    default:
                        return 'bg-secondary';
                }
            }

            // Helper function to clear validation errors
            function clearValidationErrors() {
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');
            }

            // Helper function to handle AJAX errors
            function handleAjaxError(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    for (var field in errors) {
                        if (field.startsWith('edit_')) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + 'Error').text(errors[field][0]);
                        } else {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + 'Error').text(errors[field][0]);
                        }
                    }
                } else {
                    toastr.error('An error occurred. Please try again.');
                }
            }
        });
    </script>
@endpush

{{-- Reorder Alerts --}}
@push('js')
    <script>
        // Load alerts data
        // Function to load housekeeping items
        function loadHousekeepingItems() {
            $.ajax({
                url: "{{ route('admin.housekeeping-items.index') }}",
                type: "GET",
                success: function(response) {
                    $('#totalHouseItems').text(response.totalItems);

                    var tableBody = $('#itemsTable tbody');
                    tableBody.empty();

                    if (response.items.length > 0) {
                        $.each(response.items, function(index, item) {
                            var statusClass = getStatusClass(item.status);

                            var row = '<tr>' +
                                '<td>' + item.name + '</td>' +
                                '<td>' + item.category + '</td>' +
                                '<td>' + item.quantity + '</td>' +
                                '<td>' + item.unit + '</td>' +
                                '<td><span class="badge badge-warning rounded-pill text-white ' +
                                statusClass + '">' + item.status + '</span></td>' +
                                '<td>' +
                                '<button class="btn btn-sm btn-light border  edit-house-btn me-2" data-id="' +
                                item.id + '"><i class="fas fa-edit"></i></button>' +
                                '<button class="btn btn-sm btn-light border  delete-house-btn" data-id="' +
                                item.id + '"><i class="fas fa-trash"></i></button>' +
                                '</td>' +
                                '</tr>';

                            tableBody.append(row);
                        });
                    } else {
                        tableBody.append(
                            '<tr><td colspan="6" class="text-center">No housekeeping items found yet.. </td></tr>'
                        );
                    }
                },
                error: function() {
                    toastr.error('Failed to load housekeeping items.');
                }
            });
        }

        // Helper function to handle AJAX errors
        function handleAjaxError(xhr) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                for (var field in errors) {
                    if (field.startsWith('edit_')) {
                        $('#' + field).addClass('is-invalid');
                        $('#' + field + 'Error').text(errors[field][0]);
                    } else {
                        $('#' + field).addClass('is-invalid');
                        $('#' + field + 'Error').text(errors[field][0]);
                    }
                }
            } else {
                toastr.error('An error occurred. Please try again.');
            }
        }
        // Helper function to clear validation errors
        function clearValidationErrors() {
            $('.invalid-feedback').text('');
            $('.form-control').removeClass('is-invalid');
        }

        // Helper function to get status class
        function getStatusClass(status) {
            switch (status) {
                case 'In Stock':
                    return 'bg-success';
                case 'Low Stock':
                    return 'bg-warning';
                case 'Critical Stock':
                    return 'bg-danger';
                default:
                    return 'bg-secondary';
            }
        }

        function loadAlerts() {
            $.ajax({
                url: "{{ route('admin.housekeeping-items.alerts') }}",
                type: "GET",
                success: function(response) {
                    $('#activeAlertsCount').text(response.activeAlerts);

                    var alertsContainer = $('#alertsContainer');
                    alertsContainer.empty();

                    if (response.alertItems.length > 0) {
                        $.each(response.alertItems, function(index, item) {
                            var priorityClass = '';
                            switch (item.priority) {
                                case 'High':
                                    priorityClass = 'bg-danger';
                                    break;
                                case 'Medium':
                                    priorityClass = 'bg-warning';
                                    break;
                                case 'Low':
                                    priorityClass = 'bg-info';
                                    break;
                                default:
                                    priorityClass = 'bg-secondary';
                            }

                            var alertCard = `
                                <div class="col-md-4 mt-3">
                                    <div class="card shadow-1 border hover-shadow transition-all">
                                        <div class="d-flex align-items-center justify-content-between card-header">
                                            <div class="d-flex align-items-center gap-3">
                                                <button class="btn btn-sm btn-light border edit-reorder-btn" 
                                                        data-id="${item.id}" 
                                                        data-reorder="${item.reorder_point}"
                                                        data-bs-toggle="tooltip" 
                                                        data-bs-placement="top" 
                                                        title="Edit reorder point">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <h5 class="text-dark font-bold mb-0 d-flex align-items-center gap-2">
                                                    <span class="material-icons-outlined">inventory_2</span>
                                                    ${item.name}
                                                </h5>
                                            </div>
                                            <div>
                                                <small class="badge rounded-pill text-white p-1 px-2 ${priorityClass} me-2 shadow-sm">
                                                    <i class="fas fa-${item.priority === 'High' ? 'exclamation-triangle' : item.priority === 'Medium' ? 'exclamation-circle' : 'info-circle'} me-1"></i>
                                                    ${item.priority} Priority
                                                </small>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <!-- Stock Level Indicator -->
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span class="text-muted small">Stock Level</span>
                                                    <span class="text-dark small fw-bold">${item.quantity}/${item.reorder_point} ${item.unit}</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar ${item.quantity <= item.reorder_point ? 'bg-danger' : 'bg-success'}" 
                                                        role="progressbar" 
                                                        style="width: ${Math.min(100, (item.quantity / item.reorder_point) * 100)}%" 
                                                        aria-valuenow="${item.quantity}" 
                                                        aria-valuemin="0" 
                                                        aria-valuemax="${item.reorder_point}">
                                                    </div>
                                                </div>
                                                ${item.quantity <= item.reorder_point ? 
                                                    '<small class="text-danger mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i>Stock is below reorder point</small>' : 
                                                    '<small class="text-success mt-1 d-block"><i class="fas fa-check-circle me-1"></i>Stock level is good</small>'}
                                            </div>
                                            
                                            <!-- Compact Info Grid -->
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <div class="p-2 border rounded bg-light-hover">
                                                        <p class="text-muted small mb-1"><i class="fas fa-tag me-1"></i>Category</p>
                                                        <p class="text-dark mb-0 fw-bold">${item.category}</p>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="p-2 border rounded bg-light-hover">
                                                        <p class="text-muted small mb-1"><i class="fas fa-boxes me-1"></i>Current Stock</p>
                                                        <p class="text-dark mb-0 fw-bold">${item.quantity} ${item.unit}</p>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="p-2 border rounded bg-light-hover">
                                                        <p class="text-muted small mb-1"><i class="fas fa-bell me-1"></i>Reorder Point</p>
                                                        <p class="text-dark mb-0 fw-bold">${item.reorder_point} ${item.unit}</p>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="p-2 border rounded bg-light-hover">
                                                        <p class="text-muted small mb-1"><i class="fas fa-info-circle me-1"></i>Status</p>
                                                        <p class="mb-0">
                                                            <span class="badge rounded-pill text-white p-1 ${getStatusClass(item.status)}">
                                                                ${item.status}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;



                            alertsContainer.append(alertCard);
                        });
                    } else {
                        alertsContainer.append(`
                <div class="col-md-12 text-center py-4">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <h5 class="text-muted">No active reorder alerts</h5>
                    <p class="text-secondary">All items are well stocked</p>
                </div>`);
                    }
                },
                error: function() {
                    toastr.error('Failed to load reorder alerts.');
                }
            });
        }

        // Edit reorder point
        $(document).on('click', '.edit-reorder-btn', function() {
            var id = $(this).data('id');
            var reorderPoint = $(this).data('reorder');

            $('#reorder_item_id').val(id);
            $('#reorder_point').val(reorderPoint);
            $('#editReorderModal').modal('show');
        });

        // Update reorder point
        $('#editReorderForm').submit(function(e) {
            e.preventDefault();
            clearValidationErrors();

            var id = $('#reorder_item_id').val();
            $.ajax({
                url: `/admin/housekeeping-items/${id}/update-reorder`,
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#editReorderModal').modal('hide');
                    loadHousekeepingItems(); // Refresh main table
                    loadAlerts(); // Refresh alerts
                    toastr.success(response.message);
                },
                error: handleAjaxError
            });
        });

        // Refresh alerts button
        $('#refreshAlerts').click(function() {
            loadAlerts();
        });

        // Call loadAlerts() at the end of your $(document).ready()
        loadAlerts();
    </script>
@endpush

{{-- Vendor Management --}}
@push('js')
    <script>
        $(document).ready(function() {
            // Set up CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Load vendor data on page load
            loadVendorData();

            // Add new vendor
            $('#addVendorForm').submit(function(e) {
                e.preventDefault();
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    url: "/admin/vendors", // or "{{ route('admin.vendors.store') }}" if named route exists
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addVendorModal').modal('hide');
                        $('#addVendorForm')[0].reset();
                        loadVendorData();
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Debugging line
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (var field in errors) {
                                var fieldId = field.replace('.', '_');
                                $('#' + fieldId).addClass('is-invalid');
                                $('#' + fieldId + 'Error').text(errors[field][0]);
                            }
                        } else {
                            toastr.error('Server error: ' + xhr.status);
                        }
                    }
                });
            });

            // Edit vendor - show modal
            $(document).on('click', '.edit-vendor-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "/admin/vendors/" + id,
                    type: "GET",
                    success: function(response) {
                        $('#edit_vendor_id').val(response.id);
                        $('#edit_vendor_name').val(response.name);
                        $('#edit_vendor_category').val(response.category);
                        $('#edit_items_supplied').val(response.items_supplied);
                        $('#edit_last_order').val(response.last_order);
                        $('#edit_contact_info').val(response.contact_info);
                        $('#editVendorModal').modal('show');
                    },
                    error: function() {
                        toastr.error('Failed to load vendor data.');
                    }
                });
            });

            // Update vendor
            $('#editVendorForm').submit(function(e) {
                e.preventDefault();
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');

                var id = $('#edit_vendor_id').val();
                $.ajax({
                    url: "/admin/vendors/" + id,
                    type: "PUT",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editVendorModal').modal('hide');
                        loadVendorData();
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (var field in errors) {
                                $('#edit_' + field).addClass('is-invalid');
                                $('#edit_' + field + 'Error').text(errors[field][0]);
                            }
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                    }
                });
            });

            // Delete vendor - show confirmation modal
            $(document).on('click', '.delete-vendor-btn', function() {
                var id = $(this).data('id');
                $('#delete_vendor_id').val(id);
                $('#deleteVendorModal').modal('show');
            });

            // Confirm vendor delete
            $('#confirmVendorDelete').click(function() {
                var id = $('#delete_vendor_id').val();
                $.ajax({
                    url: "/admin/vendors/" + id,
                    type: "DELETE",
                    success: function(response) {
                        $('#deleteVendorModal').modal('hide');
                        loadVendorData();
                        toastr.success(response.message);
                    },
                    error: function() {
                        toastr.error('Failed to delete vendor.');
                    }
                });
            });

            // Function to load vendor data
            function loadVendorData() {
                $.ajax({
                    url: "{{ route('admin.vendors.index') }}",
                    type: "GET",
                    success: function(response) {
                        $('#totalVendors').text(response.totalVendors);

                        var tableBody = $('#vendorTable tbody');
                        tableBody.empty();

                        if (response.vendors.length > 0) {
                            $.each(response.vendors, function(index, vendor) {
                                var statusClass = '';
                                if (vendor.status === 'Active') {
                                    statusClass = 'bg-success';
                                } else if (vendor.status === 'Inactive') {
                                    statusClass = 'bg-warning';
                                } else {
                                    statusClass = 'bg-danger';
                                }

                                var row = '<tr>' +
                                    '<td>' + vendor.name + '</td>' +
                                    '<td>' + vendor.category + '</td>' +
                                    '<td>' + vendor.items_supplied + '</td>' +
                                    '<td>' + vendor.last_order + '</td>' +
                                    '<td><span class="badge rounded-pill text-white p-1 px-2 ' +
                                    statusClass + '">' + vendor.status + '</span></td>' +
                                    '<td>' +
                                    '<button class="btn btn-sm btn-light border edit-vendor-btn me-2" data-id="' +
                                    vendor.id + '"><i class="fas fa-edit"></i></button>' +
                                    '<button class="btn btn-sm btn-light border delete-vendor-btn" data-id="' +
                                    vendor.id + '"><i class="fas fa-trash"></i></button>' +
                                    '</td>' +
                                    '</tr>';

                                tableBody.append(row);
                            });
                        } else {
                            tableBody.append(
                                '<tr><td colspan="6" class="text-center">No vendors found</td></tr>'
                            );
                        }
                    },
                    error: function() {
                        toastr.error('Failed to load vendor data.');
                    }
                });
            }
        });
    </script>

    <script>
        AOS.init();
    </script>
@endpush
