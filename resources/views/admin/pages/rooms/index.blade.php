@extends('admin/layouts/master')

@section('title')
    Rooms
@endsection

@push('css')
    <style>
        .badge {
            font-size: 0.85em;
            font-weight: 500;
            padding: 0.35em 0.65em;
        }

        .hover-primary tr:hover {
            background-color: rgba(13, 110, 253, 0.1) !important;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            padding: 0.375rem 0.75rem;
            min-height: calc(1.5em + 0.75rem + 2px);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 0 0.5em;
        }

        /* Amenities badges */
        .badge.bg-light {
            margin-right: 0.3rem;
            margin-bottom: 0.3rem;
            display: inline-flex;
            align-items: center;
        }

        /* Amenities table */
        #amenitiesTable {
            font-size: 0.9rem;
        }

        #amenitiesTable td {
            vertical-align: middle;
        }

        /* Modal footer buttons */
        .modal-footer .btn {
            min-width: 100px;
        }

        /* Style for search container */
        .btn-group.border {
            border-radius: 0.375rem;
            overflow: hidden;
        }

        /* Style for search input */
        #roomSearch {
            min-width: 300px;
            transition: all 0.3s ease;
        }

        #roomSearch:focus {
            min-width: 350px;
            outline: none;
        }

        /* Style for clear button */
        #clearSearch {
            display: none;
        }

        #roomSearch:not(:placeholder-shown)+#clearSearch {
            display: block;
        }

        /* Ensure Select2 dropdown is visible in modal */
        .select2-container--open {
            z-index: 9999 !important;
        }

        /* Style for selected amenities */
        .select2-selection__choice {
            background-color: #f8f9fa !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 0.25rem !important;
            padding: 0 0.5em !important;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="font-bold text-dark" data-aos="fade-up-right" data-aos-delay="100">Room Management</h3>
            <div class="d-flex flex-md-row flex-column gap-3" data-aos="fade-up-right" data-aos-delay="200">
                {{-- <button class="btn shadow-0 btn-secondary"><i class="fas fa-home mx-1"></i>Housekeeping</button>
                <button class="btn shadow-0 btn-secondary"> <i class="fas fa-tools mx-1"></i>
                    Maintenance</button> --}}
                <button class="btn btn-secondary btn-sm" data-mdb-toggle="modal" data-mdb-target="#amenitiesModal">
                    <i class="fa fa-list"></i> Amenities
                </button>
                <button class="btn btn-primary btn-sm shadow-0" data-mdb-toggle="modal" data-mdb-target="#addRoomModal">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </section>
    <section>
        <div class="row mt-4">
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card p-2 shadow-2 border-start border-success border-3">
                    <div class="d-flex flex-row align-items-center gap-3">
                        <span class="badge rounded-circle p-3 badge-success">
                            <i class="fa fa-bed"></i>
                        </span>
                        <div class="">
                            <small class="text-secondary">Total Rooms</small>
                            <h3 class="text-dark font-bold">
                                {{ App\Models\Room::count() }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card p-2 shadow-2 border-start border-success border-3">
                    <div class="d-flex flex-row align-items-center gap-3">
                        <span class="badge rounded-circle p-3 badge-success">
                            <i class="fa fa-bed"></i>
                        </span>
                        <div class="">
                            <small class="text-secondary">Available</small>
                            <h3 class="text-dark font-bold">
                                {{ App\Models\Room::where('status', 'Available')->count() }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card p-2 shadow-2 border-start border-primary border-3 ">
                    <div class="d-flex flex-row align-items-center gap-3">
                        <span class="badge rounded-circle p-3 badge-primary">
                            <i class="fa fa-bed"></i>
                        </span>
                        <div class="">
                            <small class="text-secondary">Occupied</small>
                            <h3 class="text-dark font-bold">
                                {{ App\Models\Room::where('status', 'Occupied')->count() }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card p-2 shadow-2 border-start border-warning border-3">
                    <div class="d-flex flex-row align-items-center gap-3">
                        <span class="badge rounded-circle p-3 badge-warning">
                            <i class="fa fa-warning"></i>
                        </span>
                        <div class="">
                            <small class="text-secondary">Maintenance</small>
                            <h3 class="text-dark font-bold">
                                {{ App\Models\Room::where('status', 'Maintenance')->count() }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row mt-2" data-aos="fade-up" data-aos-delay="300">
            <div class="col-md-12">
                <div class="card shadow-2 p-3">

                    <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                        <h5 class="text-dark font-bold">Room Inventory</h5>
                    </div>
                    <div class="col-12">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs" id="roomStatusTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="all-tab" data-mdb-toggle="tab" data-mdb-target="#all"
                                    type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="available-tab" data-mdb-toggle="tab"
                                    data-mdb-target="#available" type="button" role="tab" aria-controls="available"
                                    aria-selected="false">Available</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="occupied-tab" data-mdb-toggle="tab" data-mdb-target="#occupied"
                                    type="button" role="tab" aria-controls="occupied"
                                    aria-selected="false">Occupied</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="maintenance-tab" data-mdb-toggle="tab"
                                    data-mdb-target="#maintenance" type="button" role="tab" aria-controls="maintenance"
                                    aria-selected="false">Maintenance</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="cleaning-tab" data-mdb-toggle="tab"
                                    data-mdb-target="#cleaning" type="button" role="tab" aria-controls="cleaning"
                                    aria-selected="false">Cleaning</button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content mt-4" id="roomStatusTabsContent">
                            <div class="tab-pane fade show active" id="all" role="tabpanel"
                                aria-labelledby="all-tab">
                                <div class="table-responsive">
                                    <table class="table w-100" id="roomstable1">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Room #</th>
                                                <th>Type</th>
                                                <th>Floor</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                                <th>capacity</th>
                                                <th>Amenities</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rooms as $room)
                                                <tr class="hover-primary">
                                                    <td>{{ $room->room_number }}</td>
                                                    <td>{{ $room->type }}</td>
                                                    <td>{{ $room->floor }}</td>
                                                    <td>
                                                        @php
                                                            $statusClasses = [
                                                                'available' => 'bg-success',
                                                                'occupied' => 'bg-info',
                                                                'maintenance' => 'bg-warning',
                                                            ];
                                                        @endphp
                                                        <span
                                                            class="badge {{ $statusClasses[$room->status] ?? 'bg-secondary' }}">
                                                            {{ ucfirst($room->status) }}
                                                        </span>
                                                    </td>
                                                    <td>${{ number_format($room->price, 2) }}</td>
                                                    <td>{{ $room->capacity }}</td>
                                                    <td>
                                                        @foreach ($room->amenities as $amenity)
                                                            <span class="badge bg-light text-dark">
                                                                @if ($amenity->icon)
                                                                    <i class="fa {{ $amenity->icon }} me-1"></i>
                                                                @endif
                                                                {{ $amenity->name }}
                                                            </span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.rooms.show', $room->id) }}"
                                                            class="btn btn-light border btn-sm shadow-0 me-1">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <button class="btn btn-light border btn-sm shadow-0 edit-room-btn"
                                                            data-room="{{ json_encode($room) }}"
                                                            data-amenities="{{ json_encode($room->amenities->pluck('id')->toArray()) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button
                                                            class="btn btn-light border btn-sm shadow-0 delete-room-btn"
                                                            data-id="{{ $room->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- paginate --}}
                                </div>

                            </div>
                            <div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="available-tab">
                                <div class="table-responsive">
                                    <table class="table w-100" id="roomstable2">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Room #</th>
                                                <th>Type</th>
                                                <th>Floor</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                                <th>capacity</th>
                                                <th>Amenities</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($availableRooms as $room)
                                                <tr class="hover-primary">
                                                    <td>{{ $room->room_number }}</td>
                                                    <td>{{ $room->type }}</td>
                                                    <td>{{ $room->floor }}</td>
                                                    <td>
                                                        @php
                                                            $statusClasses = [
                                                                'available' => 'bg-success',
                                                                'occupied' => 'bg-info',
                                                                'maintenance' => 'bg-warning',
                                                            ];
                                                        @endphp
                                                        <span
                                                            class="badge {{ $statusClasses[$room->status] ?? 'bg-secondary' }}">
                                                            {{ ucfirst($room->status) }}
                                                        </span>
                                                    </td>
                                                    <td>${{ number_format($room->price, 2) }}</td>
                                                    <td>{{ $room->capacity }}</td>
                                                    <td>
                                                        @foreach ($room->amenities as $amenity)
                                                            <span class="badge bg-light text-dark">
                                                                @if ($amenity->icon)
                                                                    <i class="fa {{ $amenity->icon }} me-1"></i>
                                                                @endif
                                                                {{ $amenity->name }}
                                                            </span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.rooms.show', $room->id) }}"
                                                                class="btn btn-light border btn-sm shadow-0 me-1">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <button
                                                                class="btn btn-light border btn-sm shadow-0 edit-room-btn"
                                                                data-room="{{ json_encode($room) }}"
                                                                data-amenities="{{ json_encode($room->amenities->pluck('id')->toArray()) }}">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button
                                                                class="btn btn-light border btn-sm shadow-0 delete-room-btn"
                                                                data-id="{{ $room->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- paginate --}}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="occupied" role="tabpanel" aria-labelledby="occupied-tab">
                                <div class="table-responsive">
                                    <table class="table w-100" id="roomstable3">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Room #</th>
                                                <th>Type</th>
                                                <th>Floor</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                                <th>capacity</th>
                                                <th>Amenities</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($occupiedRooms as $room)
                                                <tr class="hover-primary">
                                                    <td>{{ $room->room_number }}</td>
                                                    <td>{{ $room->type }}</td>
                                                    <td>{{ $room->floor }}</td>
                                                    <td>
                                                        @php
                                                            $statusClasses = [
                                                                'available' => 'bg-success',
                                                                'occupied' => 'bg-info',
                                                                'maintenance' => 'bg-warning',
                                                            ];
                                                        @endphp
                                                        <span
                                                            class="badge {{ $statusClasses[$room->status] ?? 'bg-secondary' }}">
                                                            {{ ucfirst($room->status) }}
                                                        </span>
                                                    </td>
                                                    <td>${{ number_format($room->price, 2) }}</td>
                                                    <td>{{ $room->capacity }}</td>
                                                    <td>
                                                        @foreach ($room->amenities as $amenity)
                                                            <span class="badge bg-light text-dark">
                                                                @if ($amenity->icon)
                                                                    <i class="fa {{ $amenity->icon }} me-1"></i>
                                                                @endif
                                                                {{ $amenity->name }}
                                                            </span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.rooms.show', $room->id) }}"
                                                                class="btn btn-light border btn-sm shadow-0 me-1">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <button
                                                                class="btn btn-light border btn-sm shadow-0 edit-room-btn"
                                                                data-room="{{ json_encode($room) }}"
                                                                data-amenities="{{ json_encode($room->amenities->pluck('id')->toArray()) }}">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button
                                                                class="btn btn-light border btn-sm shadow-0 delete-room-btn"
                                                                data-id="{{ $room->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- paginate --}}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="maintenance" role="tabpanel"
                                aria-labelledby="maintenance-tab">
                                <div class="table-responsive">
                                    <table class="table w-100" id="roomstable4">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Room #</th>
                                                <th>Type</th>
                                                <th>Floor</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                                <th>capacity</th>
                                                <th>Amenities</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($maintenanceRooms as $room)
                                                <tr class="hover-primary">
                                                    <td>{{ $room->room_number }}</td>
                                                    <td>{{ $room->type }}</td>
                                                    <td>{{ $room->floor }}</td>
                                                    <td>
                                                        @php
                                                            $statusClasses = [
                                                                'available' => 'bg-success',
                                                                'occupied' => 'bg-info',
                                                                'maintenance' => 'bg-warning',
                                                            ];
                                                        @endphp
                                                        <span
                                                            class="badge {{ $statusClasses[$room->status] ?? 'bg-secondary' }}">
                                                            {{ ucfirst($room->status) }}
                                                        </span>
                                                    </td>
                                                    <td>${{ number_format($room->price, 2) }}</td>
                                                    <td>{{ $room->capacity }}</td>
                                                    <td>
                                                        @foreach ($room->amenities as $amenity)
                                                            <span class="badge bg-light text-dark">
                                                                @if ($amenity->icon)
                                                                    <i class="fa {{ $amenity->icon }} me-1"></i>
                                                                @endif
                                                                {{ $amenity->name }}
                                                            </span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.rooms.show', $room->id) }}"
                                                                class="btn btn-light border btn-sm shadow-0 me-1">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <button
                                                                class="btn btn-light border btn-sm shadow-0 edit-room-btn"
                                                                data-room="{{ json_encode($room) }}"
                                                                data-amenities="{{ json_encode($room->amenities->pluck('id')->toArray()) }}">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button
                                                                class="btn btn-light border btn-sm shadow-0 delete-room-btn"
                                                                data-id="{{ $room->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- paginate --}}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="cleaning" role="tabpanel" aria-labelledby="cleaning-tab">
                                <div class="table-responsive">
                                    <table class="table w-100" id="roomstable5">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Room #</th>
                                                <th>Type</th>
                                                <th>Floor</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                                <th>capacity</th>
                                                <th>Amenities</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cleaningRooms as $room)
                                                <tr class="hover-primary">
                                                    <td>{{ $room->room_number }}</td>
                                                    <td>{{ $room->type }}</td>
                                                    <td>{{ $room->floor }}</td>
                                                    <td>
                                                        @php
                                                            $statusClasses = [
                                                                'available' => 'bg-success',
                                                                'occupied' => 'bg-info',
                                                                'maintenance' => 'bg-warning',
                                                            ];
                                                        @endphp
                                                        <span
                                                            class="badge {{ $statusClasses[$room->status] ?? 'bg-secondary' }}">
                                                            {{ ucfirst($room->status) }}
                                                        </span>
                                                    </td>
                                                    <td>${{ number_format($room->price, 2) }}</td>
                                                    <td>{{ $room->capacity }}</td>
                                                    <td>
                                                        @foreach ($room->amenities as $amenity)
                                                            <span class="badge bg-light text-dark">
                                                                @if ($amenity->icon)
                                                                    <i class="fa {{ $amenity->icon }} me-1"></i>
                                                                @endif
                                                                {{ $amenity->name }}
                                                            </span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.rooms.show', $room->id) }}"
                                                                class="btn btn-light border btn-sm shadow-0 me-1">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <button
                                                                class="btn btn-light border btn-sm shadow-0 edit-room-btn"
                                                                data-room="{{ json_encode($room) }}"
                                                                data-amenities="{{ json_encode($room->amenities->pluck('id')->toArray()) }}">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button
                                                                class="btn btn-light border btn-sm shadow-0 delete-room-btn"
                                                                data-id="{{ $room->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- paginate --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="text-secondary">A list of all hotel rooms and their current status.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.pages.rooms.partials.add-room-modal')
    @include('admin.pages.rooms.partials.edit-room-modal')
    @include('admin.pages.rooms.partials.amenities-modal')
@endsection

@push('js')
    <script>
        // Handle add room form submission
        $('#addRoomForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#addRoomModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessages = '';

                    for (const field in errors) {
                        errorMessages += errors[field][0] + '\n';
                    }

                    alert(errorMessages);
                }
            });
        });

        // Handle edit room form submission
        $('#editRoomForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#editRoomModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessages = '';

                    for (const field in errors) {
                        errorMessages += errors[field][0] + '\n';
                    }

                    alert(errorMessages);
                }
            });
        });

        // Initialize select2 for amenities
        $('.select2').select2({
            placeholder: "Select amenities",
            allowClear: true,
            width: '100%'
        });
    </script>
    <script>
        $(document).ready(function() {
            // Handle edit button click
            $('.edit-room-btn').click(function() {
                // Get the room data (already parsed by jQuery)
                const room = $(this).data('room');
                const amenities = $(this).data('amenities');

                // Populate the form
                $('#editRoomModal input[name="room_number"]').val(room.room_number);
                $('#editRoomModal select[name="type"]').val(room.type);
                $('#editRoomModal select[name="floor"]').val(room.floor);
                $('#editRoomModal select[name="status"]').val(room.status);
                $('#editRoomModal input[name="price"]').val(room.price);
                $('#editRoomModal input[name="capacity"]').val(room.capacity);
                $('#editRoomModal textarea[name="description"]').val(room.description);

                // Initialize Select2 with selected amenities
                const $amenitiesSelect = $('#edit_amenities');
                $amenitiesSelect.val(amenities).trigger('change');

                // Reinitialize Select2 if needed
                if (!$amenitiesSelect.hasClass("select2-hidden-accessible")) {
                    $amenitiesSelect.select2({
                        placeholder: "Select amenities",
                        allowClear: true,
                        width: '100%'
                    });
                }

                // Update form action
                $('#editRoomModal form').attr('action', `/admin/rooms/${room.id}`);

                // Show modal
                $('#editRoomModal').modal('show');
            });

            // Handle delete button click
            $('.delete-room-btn').click(function() {
                if (confirm('Are you sure you want to delete this room?')) {
                    const roomId = $(this).data('id');
                    $.ajax({
                        url: `/admin/rooms/${roomId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
    <script>
        // Amenities Management
        function loadAmenities() {
            $.get('{{ route('admin.amenities.index') }}', function(data) {
                const tbody = $('#amenitiesTable tbody');
                tbody.empty();

                data.forEach(amenity => {
                    tbody.append(`
                <tr>
                    <td>${amenity.name}</td>
                    <td>${amenity.icon ? `<i class="fa ${amenity.icon}"></i>` : '-'}</td>
                    <td>
                        <button class="btn btn-sm btn-light border edit-amenity-btn" data-id="${amenity.id}" data-name="${amenity.name}" data-icon="${amenity.icon || ''}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-light border delete-amenity-btn" data-id="${amenity.id}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
                });

                // Update select2 options
                const selectOptions = data.map(a => `<option value="${a.id}">${a.name}</option>`).join('');
                $('.select2').html(selectOptions).trigger('change');
            });
        }

        // Handle amenity form submission
        $('#amenityForm').on('submit', function(e) {
            e.preventDefault();

            const formData = $(this).serialize();
            const method = $('#amenityId').val() ? 'PUT' : 'POST';
            const url = $('#amenityId').val() ?
                `/admin/amenities/${$('#amenityId').val()}` :
                '/admin/amenities';

            $.ajax({
                url: url,
                type: method,
                data: formData,
                success: function() {
                    loadAmenities();
                    $('#amenityForm')[0].reset();
                    $('#amenityId').val('');
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessages = '';

                    for (const field in errors) {
                        errorMessages += errors[field][0] + '\n';
                    }

                    alert(errorMessages);
                }
            });
        });

        // Edit amenity button
        $(document).on('click', '.edit-amenity-btn', function() {
            $('#amenityId').val($(this).data('id'));
            $('#amenityName').val($(this).data('name'));
            $('#amenityIcon').val($(this).data('icon'));
            $('#amenitiesModal').modal('show');
        });

        // Delete amenity button
        $(document).on('click', '.delete-amenity-btn', function() {
            if (confirm('Are you sure you want to delete this amenity?')) {
                $.ajax({
                    url: `/admin/amenities/${$(this).data('id')}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        loadAmenities();
                    }
                });
            }
        });

        // Load amenities when modal is shown
        $('#amenitiesModal').on('shown.bs.modal', function() {
            loadAmenities();
        });

        // Clear form when modal is hidden
        $('#amenitiesModal').on('hidden.bs.modal', function() {
            $('#amenityForm')[0].reset();
            $('#amenityId').val('');
        });
    </script>
    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchButton, #roomSearch').on('input click', function() {
                filterRooms();
            });

            // Clear search functionality
            $('#clearSearch').click(function() {
                $('#roomSearch').val('');
                filterRooms();
            });

            function filterRooms() {
                const searchValue = $('#roomSearch').val().toLowerCase();

                $('table tbody tr').each(function() {
                    const roomNumber = $(this).find('td:first').text().toLowerCase();
                    if (roomNumber.includes(searchValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Allow pressing Enter to search
            $('#roomSearch').keypress(function(e) {
                if (e.which === 13) {
                    filterRooms();
                }
            });
        });
    </script>

    <script>
        new DataTable("#roomstable1");
        new DataTable("#roomstable2");
        new DataTable("#roomstable3");
        new DataTable("#roomstable4");
        new DataTable("#roomstable5");
    </script>

    <script>
        AOS.init()
    </script>
@endpush
