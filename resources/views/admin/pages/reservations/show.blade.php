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
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border">
                    <div class="card-header d-flex justify-content-between align-items-center bg-light">
                        <div>
                            <h4 class="card-title mb-0">
                                <i class="fas fa-calendar-check me-2 text-primary"></i>
                                Reservation #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}
                            </h4>
                            <small class="text-muted">Last updated: {{ $reservation->updated_at->diffForHumans() }}</small>
                        </div>
                        <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Back to List
                        </a>
                    </div>

                    <div class="card-body">
                        <!-- Status Alert -->
                        <div
                            class="alert alert-{{ [
                                'confirmed' => 'success',
                                'pending' => 'info',
                                'cancelled' => 'warning',
                                'completed' => 'secondary',
                                'checked_in' => 'primary',
                                'checked_out' => 'secondary',
                                'no_show' => 'danger',
                            ][$reservation->status] ?? 'secondary' }} alert-dismissible fade show mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>
                                    <strong class="me-2">Current Status:</strong>
                                    <span
                                        class="badge bg-white text-{{ [
                                            'confirmed' => 'success',
                                            'pending' => 'info',
                                            'cancelled' => 'warning',
                                            'completed' => 'secondary',
                                            'checked_in' => 'primary',
                                            'checked_out' => 'secondary',
                                            'no_show' => 'danger',
                                        ][$reservation->status] ?? 'secondary' }} text-uppercase fs-6">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                    @if ($reservation->isCheckedIn())
                                        <span class="ms-3">
                                            <i class="fas fa-clock me-1"></i>
                                            Stay duration: {{ $reservation->check_in->diffInDays(now()) }} day(s)
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Guest Information -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border shadow-0">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">
                                            <i class="fas fa-user me-2"></i>Guest Information
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label text-muted small mb-1">Full Name</label>
                                            <p class="form-control-plaintext fw-bold">{{ $reservation->guest->full_name }}
                                            </p>
                                        </div>
                                        {{-- Gmail --}}
                                        <div class="mb-3">
                                            <label class="form-label text-muted small mb-1">
                                                <i class="fas fa-envelope me-1"></i> |
                                                Email</label>
                                            <p class="form-control-plaintext">
                                                <a
                                                    href="mailto:{{ $reservation->guest->email }}">{{ $reservation->guest->email }}</a>
                                            </p>
                                        </div>
                                        {{-- Phone --}}
                                        <div class="mb-3">
                                            <label class="form-label text-muted small mb-1">
                                                <i class="fas fa-phone-alt me-1"></i> |
                                                Phone</label>
                                            <p class="form-control-plaintext">
                                                <a
                                                    href="tel:{{ $reservation->guest->phone }}">{{ $reservation->guest->phone }}</a>
                                                @if ($reservation->guest->phone_verified_at)
                                                    <span class="badge bg-success ms-2">Verified</span>
                                                @endif
                                            </p>
                                        </div>
                                        {{-- Whats app --}}
                                        <div class="mb-3">
                                            <label class="form-label text-muted small mb-1">
                                                <i class="fab fa-whatsapp"></i> |
                                                Whats app</label>
                                            <p class="form-control-plaintext">
                                                <a target="__blank"
                                                    href="https://wa.me/+2{{ $reservation->guest->phone }}">{{ $reservation->guest->phone }}</a>
                                                @if ($reservation->guest->phone_verified_at)
                                                    <span class="badge bg-success ms-2">Verified</span>
                                                @endif
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Reservation Details -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border shadow-0">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">
                                            <i class="fas fa-info-circle me-2"></i>Reservation Details
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label text-muted small mb-1">Room</label>
                                            <p class="form-control-plaintext fw-bold">
                                                {{ $reservation->room->room_number }}
                                                <span class="text-muted">({{ $reservation->room->type }})</span>
                                                <a href="{{ route('admin.rooms.show', $reservation->room->id) }}"
                                                    class="btn btn-sm btn-outline-primary ms-2" title="View room details">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small mb-1">Check-in</label>
                                            <p class="form-control-plaintext">
                                                <i class="far fa-calendar-alt me-1 text-primary"></i>
                                                {{ \Carbon\Carbon::parse($reservation->check_in)->format('M d, Y') }}
                                                <span class="text-muted ms-2">
                                                    ({{ \Carbon\Carbon::parse($reservation->check_in)->diffForHumans() }})
                                                </span>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small mb-1">Check-out</label>
                                            <p class="form-control-plaintext">
                                                <i class="far fa-calendar-alt me-1 text-primary"></i>
                                                {{ \Carbon\Carbon::parse($reservation->check_out)->format('M d, Y') }}
                                                <span class="text-muted ms-2">
                                                    ({{ \Carbon\Carbon::parse($reservation->check_out)->diffForHumans() }})
                                                </span>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small mb-1">Total Amount</label>
                                            <p class="form-control-plaintext fw-bold text-success">
                                                ${{ number_format($reservation->amount, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Special Requests -->
                            <div class="col-12 mb-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">
                                            <i class="fas fa-comment-dots me-2"></i>Special Requests
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="bg-light p-3 rounded">
                                            @if ($reservation->special_requests)
                                                <p class="mb-0">{{ $reservation->special_requests }}</p>
                                            @else
                                                <p class="mb-0 text-muted">No special requests</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex flex-wrap justify-content-between align-items-center border-top pt-4 mt-3">
                            <div class="mb-3">
                                <button class="btn btn-outline-secondary me-2" onclick="window.print()">
                                    <i class="fas fa-print me-1"></i> Print
                                </button>
                                <button class="btn btn-outline-secondary" data-mdb-toggle="modal"
                                    data-mdb-target="#emailModal">
                                    <i class="fas fa-envelope me-1"></i> Email Guest
                                </button>
                            </div>

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                                    class="btn btn-primary me-2 shadow-sm">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>

                                <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger shadow-sm confirm-action"
                                        data-title="Delete Reservation"
                                        data-text="Are you sure you want to delete this reservation? This action cannot be undone.">
                                        <i class="fas fa-trash me-1"></i> Delete e
                                    </button>
                                </form>

                                @if ($reservation->status === 'confirmed')
                                    <form action="{{ route('admin.reservations.check-in', $reservation->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success shadow-sm">
                                            <i class="fas fa-sign-in-alt me-1"></i> Check In
                                        </button>
                                    </form>
                                @endif

                                @if ($reservation->isCheckedIn())
                                    <form action="{{ route('admin.reservations.check-out', $reservation->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning shadow-sm">
                                            <i class="fas fa-sign-out-alt me-1"></i> Check Out
                                        </button>
                                    </form>
                                @endif

                                @if ($reservation->status === 'confirmed' && $reservation->check_in->isPast())
                                    <form action="{{ route('admin.reservations.no-show', $reservation->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger shadow-sm confirm-action"
                                            data-title="Mark as No Show"
                                            data-text="Are you sure you want to mark this reservation as No Show?">
                                            <i class="fas fa-user-times me-1"></i> No Show
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Email Modal (placeholder) -->
                <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="emailModalLabel">Email Guest</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Subject</label>
                                        <input type="text" class="form-control" placeholder="Email subject">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Message</label>
                                        <textarea class="form-control" rows="5" placeholder="Your message to the guest"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary">Send Email</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<!-- Confirmation Dialog Script -->
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.confirm-action').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const title = this.dataset.title;
                    const text = this.dataset.text;

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, proceed'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
