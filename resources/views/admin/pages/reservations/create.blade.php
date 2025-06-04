@extends('admin/layouts/master')

@section('title')
    Create Reservation
@endsection

@push('css')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery (required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        /* Customize Select2 container */
        .select2-container--default .select2-selection--single {
            height: 42px;
            padding: 5px 10px;
            font-size: 1rem;
            box-shadow: none;
            transition: border-color 0.3s;
        }

        /* On focus */
        .select2-container--default .select2-selection--single:focus {
            border-color: #86b7fe;
            outline: 0;
        }

        /* Dropdown arrow icon */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
            right: 10px;
        }

        /* Text inside the selected field */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #495057;
            line-height: 36px;
        }

        /* Dropdown menu style */
        .select2-container--default .select2-results>.select2-results__options {
            max-height: 300px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.5rem;
        }

        /* Hover on options */
        .select2-results__option--highlighted {
            background-color: #0d6efd;
            color: white;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-0 border">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Create New Reservation</h4>
                        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-mdb-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.reservations.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="room_id" class="form-label">Guest</label>
                                    <select class="form-select select2" id="guest_id" name="guest_id" required>
                                        <option value="">Select Guest</option>
                                        @foreach ($guests as $guest)
                                            <option value="{{ $guest->id }}"
                                                {{ old('guest_id') == $guest->id ? 'selected' : '' }}>
                                                {{ $guest->full_name }} ({{ $guest->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="room_id" class="form-label">Room</label>
                                    <select class="form-select" id="room_id" name="room_id" required>
                                        <option value="">Select Room</option>
                                        @foreach (App\Models\Room::where('status', 'available')->get() as $room)
                                            <option value="{{ $room->id }}" data-price="{{ $room->price }}"
                                                {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                                {{ $room->room_number }} ({{ $room->type }}) -
                                                ${{ number_format($room->price, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="check_in" class="form-label">Check-in Date</label>
                                    <input type="date" class="form-control" id="check_in" name="check_in" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="check_out" class="form-label">Check-out Date</label>
                                    <input type="date" class="form-control" id="check_out" name="check_out" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="pending">Pending</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                        required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="special_requests" class="form-label">Special Requests</label>
                                    <textarea class="form-control" id="special_requests" name="special_requests" rows="3"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary shadow-0">Create Reservation</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#guest_id').select2({
                placeholder: "Select a guest",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Set minimum dates for date pickers
            const today = new Date().toISOString().split('T')[0];
            $('#check_in').attr('min', today);

            // Update check_out min date when check_in changes
            $('#check_in').change(function() {
                $('#check_out').attr('min', $(this).val());
            });

            // Prevent selecting check_out before check_in
            $('#check_out').change(function() {
                if (new Date($(this).val()) <= new Date($('#check_in').val())) {
                    alert('Check-out date must be after check-in date');
                    $(this).val('');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Calculate amount based on room price and stay duration
            $('#room_id, #check_in, #check_out').change(function() {
                const roomId = $('#room_id').val();
                const checkIn = $('#check_in').val();
                const checkOut = $('#check_out').val();

                if (roomId && checkIn && checkOut) {
                    const roomPrice = parseFloat($('#room_id option:selected').data('price'));
                    const days = Math.ceil((new Date(checkOut) - new Date(checkIn)) / (1000 * 60 * 60 *
                        24));
                    const totalAmount = roomPrice * days;

                    $('#amount').val(totalAmount.toFixed(2));
                }
            });
        });
    </script>
@endpush
