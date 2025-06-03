@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-0 border">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Guest Details - {{ $guest->full_name }}</h4>
                    <a href="{{ route('admin.guests.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name:</label>
                                <p class="form-control-static">{{ $guest->first_name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name:</label>
                                <p class="form-control-static">{{ $guest->last_name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <p class="form-control-static">{{ $guest->email }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone:</label>
                                <p class="form-control-static">{{ $guest->phone }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Address:</label>
                                <p class="form-control-static">{{ $guest->address ?? 'N/A' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">City:</label>
                                <p class="form-control-static">{{ $guest->city ?? 'N/A' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Country:</label>
                                <p class="form-control-static">{{ $guest->country ?? 'N/A' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Total Reservations:</label>
                                <p class="form-control-static">{{ $guest->reservations->count() }}</p>
                            </div>
                        </div>
                    </div>

                    @if($guest->reservations->count() > 0)
                    <hr>
                    <h5 class="mb-3">Reservation History</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                                <tr>
                                    <th>Reservation ID</th>
                                    <th>Room</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guest->reservations as $reservation)
                                <tr>
                                    <td>#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $reservation->room->room_number }} ({{ $reservation->room->type }})</td>
                                    <td>{{ $reservation->check_in->format('M d, Y') }}</td>
                                    <td>{{ $reservation->check_out->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ [
                                            'confirmed' => 'success',
                                            'pending' => 'info',
                                            'cancelled' => 'warning',
                                            'completed' => 'secondary'
                                        ][$reservation->status] ?? 'secondary' }}">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($reservation->amount, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('admin.guests.edit', $guest->id) }}" class="btn btn-primary me-2">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.guests.destroy', $guest->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
