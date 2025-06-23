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
                                <div class="mb-4 card card-body border-0 shadow-0 bg-light h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <h5 class="mb-0">Personal Information</h5>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small text-muted d-flex align-items-center">
                                            <i class="fas fa-signature me-2 text-secondary"></i>Full Name
                                        </label>
                                        <p class="form-control-plaintext fw-bold ps-4">
                                            {{ $guest->first_name }} {{ $guest->last_name }}
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small text-muted d-flex align-items-center">
                                            <i class="fas fa-envelope me-2 text-secondary"></i>Email
                                        </label>
                                        <p class="form-control-plaintext ps-4">
                                            <a href="mailto:{{ $guest->email }}" class="text-decoration-none link-primary">
                                                {{ $guest->email }}
                                            </a>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small text-muted d-flex align-items-center">
                                            <i class="fas fa-phone me-2 text-secondary"></i>Phone
                                        </label>
                                        <p class="form-control-plaintext ps-4">
                                            <a href="tel:{{ $guest->phone }}" class="text-decoration-none link-primary">
                                                {{ $guest->phone }}
                                                <i class="fas fa-external-link-alt ms-2 fs-8 text-muted"></i>
                                            </a>
                                        </p>
                                    </div>
                                    {{-- whats app --}}
                                    <div class="mb-3">
                                        <label class="form-label small text-muted d-flex align-items-center">
                                            <i class="fab fa-whatsapp me-2 text-success"></i>WhatsApp
                                        </label>
                                        <p class="form-control-plaintext ps-4">
                                            @if ($guest->phone)
                                                <a href="https://wa.me/+2{{ $guest->phone }}" class="text-decoration-none link-success" target="_blank">
                                                    <i class="fab fa-whatsapp me-2 fs-8 text-muted "></i>| 
                                                    {{ $guest->phone }} 
                                                </a>
                                            @else
                                                <span class="text-muted fst-italic">Not provided</span>
                                            @endif
                                        </p>    
                                    </div>
                                    {{-- age --}}
                                    <div class="mb-3">
                                        <label class="form-label small text-muted d-flex align-items-center">
                                            <i class="fas fa-birthday-cake me-2 text-secondary"></i>Age
                                        </label>
                                        <p class="form-control-plaintext ps-4">
                                            {{ $guest->age ?? 'Not provided' }}
                                        </p>
                                    </div>
                                    {{-- purpose_of_stay --}}
                                    <div class="mb-3">
                                        <label class="form-label small text-muted d-flex align-items-center">
                                            <i class="fas fa-briefcase me-2 text-secondary"></i>Purpose of Stay
                                        </label>
                                        <p class="form-control-plaintext ps-4">
                                            {{ $guest->purpose_of_stay ?? 'Not provided' }}
                                        </p>
                                    </div>
                                  
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4 card card-body border-0 shadow-0 bg-light h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                            <i class="fas fa-map-marker-alt text-success"></i>
                                        </div>
                                        <h5 class="mb-0">Location & Activity</h5>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small text-muted d-flex align-items-center">
                                            <i class="fas fa-map-marked-alt me-2 text-secondary"></i>Address
                                        </label>
                                        <p class="form-control-plaintext ps-4">
                                            {{ $guest->address ?? '<span class="text-muted fst-italic">Not provided</span>' }}
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small text-muted d-flex align-items-center">
                                            <i class="fas fa-city me-2 text-secondary"></i>City
                                        </label>
                                        <p class="form-control-plaintext ps-4">
                                           @if ($guest->city)
                                                {{ $guest->city }}
                                            @else
                                                <span class="text-muted fst-italic">Not provided</span>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small text-muted d-flex align-items-center">
                                            <i class="fas fa-globe me-2 text-secondary"></i>Country
                                        </label>
                                        <p class="form-control-plaintext ps-4">
                                            @if ($guest->country)
                                                <span class="fi fi-{{ strtolower($guest->country) }} me-2"></span>
                                                {{ $guest->country }}
                                            @else
                                                <span class="text-muted fst-italic">Not provided</span>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small text-muted d-flex align-items-center">
                                            <i class="fas fa-calendar-check me-2 text-secondary"></i>Reservations
                                        </label>
                                        <p class="form-control-plaintext ps-4">
                                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                                <i class="fas fa-hotel me-1"></i>
                                                {{ $guest->reservations->count() }}
                                            </span>
                                            @if ($guest->reservations->count() > 0)
                                                <a href="{{ route('admin.reservations.index', ['guest_id' => $guest->id]) }}"
                                                    class="ms-3 btn btn-sm btn-outline-primary">
                                                    View History <i class="fas fa-chevron-right ms-1"></i>
                                                </a>
                                            @endif
                                        </p>
                                    </div>
                                      {{-- is_loyalty_member --}}
                                    <div class="mb-3">
                                        <label class="form-label small text-muted d-flex align-items-center">
                                            <i class="fas fa-star me-2 text-secondary"></i>Loyalty Member
                                        </label>
                                        <p class="form-control-plaintext ps-4">
                                            {{ $guest->is_loyalty_member ? 'Yes' : 'No' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($guest->reservations->count() > 0)
                            <hr>
                            <h5 class="mb-3">Reservation History</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
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
                                        @foreach ($guest->reservations as $reservation)
                                            <tr>
                                                <td>#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $reservation->room->room_number }} ({{ $reservation->room->type }})
                                                </td>
                                                <td>{{ $reservation->check_in->format('M d, Y') }}</td>
                                                <td>{{ $reservation->check_out->format('M d, Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ [
                                                            'confirmed' => 'success',
                                                            'pending' => 'info',
                                                            'cancelled' => 'warning',
                                                            'completed' => 'secondary',
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
                            <a href="{{ route('admin.guests.edit', $guest->id) }}" class="btn btn-light border btn-sm me-2">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.guests.destroy', $guest->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-sm border" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
