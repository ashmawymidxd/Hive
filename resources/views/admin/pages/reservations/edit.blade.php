@extends('admin.layouts.master')

@section('title')
    Edit Reservation
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-0 border">
                    <div class="card-header">
                        <h4 class="card-title">Edit Reservation #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</h4>
                        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="guest_id" class="form-label">Guest</label>
                                    <select class="form-select" id="guest_id" name="guest_id" required>
                                        @foreach ($guests as $guest)
                                            <option value="{{ $guest->id }}"
                                                {{ $reservation->guest_id == $guest->id ? 'selected' : '' }}>
                                                {{ $guest->full_name }} ({{ $guest->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="room_id" class="form-label">Room</label>
                                    <select class="form-select" id="room_id" name="room_id" required>
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}" data-price="{{ $room->price }}"
                                                {{ $reservation->room_id == $room->id ? 'selected' : '' }}>
                                                {{ $room->room_number }} ({{ $room->type }}) -
                                                ${{ number_format($room->price, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="check_in" class="form-label">Check-in Date</label>
                                    <input type="date" class="form-control" id="check_in" name="check_in"
                                        value="{{ \Carbon\Carbon::parse($reservation->check_in)->format('M d, Y') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="check_out" class="form-label">Check-out Date</label>
                                    <input type="date" class="form-control" id="check_out" name="check_out"
                                        value="{{ \Carbon\Carbon::parse($reservation->check_out)->format('M d, Y') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="confirmed"
                                            {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled"
                                            {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="completed"
                                            {{ $reservation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                        value="{{ $reservation->amount }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="special_requests" class="form-label">Special Requests</label>
                                    <textarea class="form-control" id="special_requests" name="special_requests" rows="3">{{ $reservation->special_requests }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Reservation</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
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
