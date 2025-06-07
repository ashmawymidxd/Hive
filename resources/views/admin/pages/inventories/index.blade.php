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
                        <button class="nav-link" id="amenities-tab" data-mdb-toggle="tab" data-mdb-target="#amenities"
                            type="button" role="tab" aria-controls="amenities" aria-selected="false">Room
                            Amenities</button>
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

                <div class="tab-content mt-3" id="managementTabsContent">
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
                                    <h3 class="text-dark font-bold">154</h3>
                                </div>
                            </div>

                            <div class="table-responsive mt-3">
                                <table class="table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="hover-primary">
                                            <td>Towels</td>
                                            <td>Linens</td>
                                            <td>200 </td>
                                            <td>pieces</td>
                                            <td><span class="rounded-pill text-white p-1 px-2 bg-success">In
                                                    Stock</span></td>
                                        </tr>
                                        <tr class="hover-primary">
                                            <td>Cleaning Solution</td>
                                            <td>Cleaning</td>
                                            <td>10</td>
                                            <td>gallons</td>
                                            <td><span class="rounded-pill text-white p-1 px-2 bg-danger">
                                                    Low Stock</span></td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="amenities" role="tabpanel" aria-labelledby="amenities-tab">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card shadow-1 p-3 border">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="text-dark font-bold">Total Amenities</h6>
                                        <button class="btn btn-outline-white btn-lg btn-floating">
                                            <i class="fa fa-bed text-secondary"></i>
                                        </button>
                                    </div>
                                    <h3 class="text-dark font-bold">89</h3>
                                </div>
                            </div>

                            <div class="table-responsive mt-3">
                                <table class="table ">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>In Stock</th>
                                            <th>Allocated</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="hover-primary">
                                            <td>Hair Dryer</td>
                                            <td>Electronics</td>
                                            <td>45 </td>
                                            <td>40</td>
                                            <td><span class="rounded-pill text-white p-1 px-2 bg-success">In
                                                    Stock</span></td>
                                        </tr>
                                        <tr class="hover-primary">
                                            <td>Coffee Maker</td>
                                            <td>Appliances</td>
                                            <td>5</td>
                                            <td>35</td>
                                            <td><span class="rounded-pill text-white p-1 px-2 bg-danger">
                                                    Low Stock</span></td>
                                        </tr>

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
                                    <h3 class="text-dark font-bold">8</h3>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="card shadow-0 border p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="text-dark font-bold">Coffee Maker</h5>
                                        <small class="rounded-pill text-white p-1 px-2 bg-warning">
                                            High Priority</small>
                                    </div>
                                    <div class="mt-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="text-secondary">Category:</p>
                                            <p class="text-dark">Room Amenities</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="text-secondary">Current Stock:</p>
                                            <p class="text-dark">5</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="text-secondary">Reorder Point:</p>
                                            <p class="text-dark">10</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="card shadow-0 border p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="text-dark font-bold">Cleaning Solution</h5>
                                        <small class="rounded-pill text-white p-1 px-2 bg-success">
                                            Medium Priority</small>
                                    </div>
                                    <div class="mt-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="text-secondary">Category:</p>
                                            <p class="text-dark">Housekeeping</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="text-secondary">Current Stock:</p>
                                            <p class="text-dark">10</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="text-secondary">Reorder Point:</p>
                                            <p class="text-dark">15</p>
                                        </div>
                                    </div>
                                </div>
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
                                <table class="table ">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Vendor Name</th>
                                            <th>Category</th>
                                            <th>Items Supplied</th>
                                            <th>Last Order</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="hover-primary">
                                            <td>Hair Dryer</td>
                                            <td>Electronics</td>
                                            <td>45 </td>
                                            <td>2024-04-15</td>
                                            <td><span class="rounded-pill text-white p-1 px-2 bg-warning">In
                                                    Stock</span></td>
                                        </tr>
                                        <tr class="hover-primary">
                                            <td>Coffee Maker</td>
                                            <td>Appliances</td>
                                            <td>5</td>
                                            <td>2024-04-10</td>
                                            <td><span class="rounded-pill text-white p-1 px-2 bg-danger">
                                                    Low Stock</span></td>
                                        </tr>
    
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

    @include('admin.pages.inventories.modals.add')
    @include('admin.pages.inventories.modals.edit')
    @include('admin.pages.inventories.modals.delete')
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
            $(document).on('click', '.edit-btn', function() {
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
            $(document).on('click', '.delete-btn', function() {
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
                        $('#totalItems').text(response.totalItems);

                        var tableBody = $('#inventoryTable tbody');
                        tableBody.empty();

                        if (response.inventories.length > 0) {
                            // display total count in the card
                            $('#totalItemsCount').text(response.inventories.length);
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
                                    '<td><span class="rounded-pill text-white p-1 px-2 ' +
                                    statusClass + '">' + item.status + '</span></td>' +
                                    '<td>' +
                                    '<button class="btn btn-sm btn-light border edit-btn me-2" data-id="' +
                                    item.id + '"><i class="fas fa-edit"></i></button>' +
                                    '<button class="btn btn-sm btn-light border delete-btn" data-id="' +
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
