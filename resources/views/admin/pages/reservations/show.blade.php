@extends('admin.layouts.master')
@section('title')
    Show Reservation
@endsection

@push('css')
    <style>
        /* Status badges */
        .bg-checked_in {
            background-color: #17a2b8 !important;
            /* Cyan for checked-in */
        }

        .bg-checked_out {
            background-color: #6c757d !important;
            /* Gray for checked-out */
        }

        .bg-no_show {
            background-color: #dc3545 !important;
            /* Red for no-show */
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-0 border">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Reservation Details #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}
                        </h4>
                        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Guest:</label>
                                    <p class="form-control-static">{{ $reservation->guest->full_name }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email:</label>
                                    <p class="form-control-static">{{ $reservation->guest->email }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone:</label>
                                    <p class="form-control-static">{{ $reservation->guest->phone }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Room:</label>
                                    <p class="form-control-static">
                                        {{ $reservation->room->room_number }} ({{ $reservation->room->type }})
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Check-in:</label>
                                    <p class="form-control-static">
                                        {{ \Carbon\Carbon::parse($reservation->check_in)->format('M d, Y') }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Check-out:</label>
                                    <p class="form-control-static">
                                        {{ \Carbon\Carbon::parse($reservation->check_out)->format('M d, Y') }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status:</label>
                                    <span
                                        class="badge bg-{{ [
                                            'confirmed' => 'success',
                                            'pending' => 'info',
                                            'cancelled' => 'warning',
                                            'completed' => 'secondary',
                                            'checked_in' => 'checked_in',
                                            'checked_out' => 'checked_out',
                                            'no_show' => 'no_show',
                                        ][$reservation->status] ?? 'secondary' }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Amount:</label>
                                    <p class="form-control-static">${{ number_format($reservation->amount, 2) }}</p>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Special Requests:</label>
                                <p class="form-control-static">{{ $reservation->special_requests ?? 'None' }}</p>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-3">
                                    <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                                        class="btn btn-primary me-2 shadow-0">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.reservations.destroy', $reservation->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger shadow-0"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>

                                    @if ($reservation->status === 'confirmed')
                                        <form action="{{ route('admin.reservations.check-in', $reservation->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success  shadow-0">
                                                <i class="fa fa-sign-in-alt"></i> Check In
                                            </button>
                                        </form>
                                    @endif

                                    @if ($reservation->isCheckedIn())
                                        <form action="{{ route('admin.reservations.check-out', $reservation->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-warning  shadow-0">
                                                <i class="fa fa-sign-out-alt"></i> Check Out
                                            </button>
                                        </form>
                                    @endif

                                    @if ($reservation->status === 'confirmed' && $reservation->check_in->isPast())
                                        <form action="{{ route('admin.reservations.no-show', $reservation->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger  shadow-0">
                                                <i class="fa fa-user-times"></i> Mark as No Show
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
