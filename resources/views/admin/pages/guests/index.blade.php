@extends('admin.layouts.master')

@section('content')
    <section>
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="font-bold text-dark">Guest Management</h3>
            <a href="{{ route('admin.guests.create') }}" class="btn btn-primary shadow-0">
                <i class="fa fa-add"></i>
            </a>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs border-bottom" id="managementTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="directory-tab" data-mdb-toggle="tab" href="#directory"
                            role="tab">Directory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="loyalty-tab" data-mdb-toggle="tab" href="#loyalty" role="tab">Loyalty
                            Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="feedback-tab" data-mdb-toggle="tab" href="#feedback"
                            role="tab">Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="blacklist-tab" data-mdb-toggle="tab" href="#blacklist"
                            role="tab">Blacklist</a>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="managementTabsContent">
                    <!-- Directory Tab -->
                    <div class="tab-pane fade show active" id="directory" role="tabpanel">
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

                        <div class="table-responsive">
                            <table class="table w-100" id="guesttable1">
                                <thead class="bg-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Reservations</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guests as $guest)
                                        <tr>
                                            <td>{{ $guest->id }}</td>
                                            <td>{{ $guest->full_name }}</td>
                                            <td>{{ $guest->email }}</td>
                                            <td>{{ $guest->phone }}</td>
                                            <td>{{ $guest->reservations_count ?? $guest->reservations()->count() }}</td>
                                            <td>
                                                <a href="{{ route('admin.guests.show', $guest->id) }}"
                                                    class="btn btn-light border btn-sm shadow-0 me-1">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.guests.edit', $guest->id) }}"
                                                    class="btn btn-light border btn-sm shadow-0 me-1">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.guests.destroy', $guest->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light border btn-sm shadow-0"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                                <button class="btn btn-sm btn-danger shadow-0"
                                                    onclick="openBlacklistModal({{ $guest->id }})"
                                                    title="Add to Blacklist">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>

                    <!-- Loyalty Program Tab -->
                    <div class="tab-pane fade" id="loyalty" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 mt-1">
                                <div class="card shadow-1 border p-4 h-30 mt-3">
                                    <h5 class="text-dark font-bold">
                                        Bronze
                                    </h5>
                                    <p class="text-secondary">Points: 0-1000</p>
                                    <ul class="px-3">
                                        <li>Early check-in when available</li>
                                        <li>10% discount on dining</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mt-1">
                                <div class="card shadow-1 border p-4 h-30 mt-3">
                                    <h5 class="text-dark font-bold">
                                        Silver
                                    </h5>
                                    <p class="text-secondary">Points: 1001-2500</p>
                                    <ul class="px-3">
                                        <li>Room upgrades when available</li>
                                        <li>15% discount on dining</li>
                                        <li>Late check-out</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mt-1">
                                <div class="card shadow-1 border p-4 h-30 mt-3">
                                    <h5 class="text-dark font-bold">
                                        Gold
                                    </h5>
                                    <p class="text-secondary">Points: 2501+</p>
                                    <ul class="px-3">
                                        <li>Guaranteed room upgrades</li>
                                        <li>20% discount on dining</li>
                                        <li>Airport transfers</li>
                                        <li>Welcome amenities</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="card shadow-1 border p-4 mt-3">
                                    <h5 class="text-dark font-bold">
                                        How to Earn Points
                                    </h5>
                                    <div class="">
                                        <table class="table ">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Activity</th>
                                                    <th>Points</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="hover-primary">
                                                    <td>Room stay (per night)</td>
                                                    <td>100</td>
                                                </tr>
                                                <tr class="hover-primary">
                                                    <td>Restaurant dining (per $10 spent)</td>
                                                    <td>5</td>
                                                </tr>
                                                <tr class="hover-primary">
                                                    <td>Spa services (per $10 spent)</td>
                                                    <td>5</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Feedback Tab -->
                    <div class="tab-pane fade" id="feedback" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow-1 border p-4 mt-3">
                                    <h4 class="text-dark font-bold">
                                        Guest Feedback & Complaints
                                    </h4>
                                    <div class="table-responsive">
                                        <table class="table w-100" id="guesttable2">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Guest</th>
                                                    <th>Type</th>
                                                    <th>Description</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($feedbacks as $feedback)
                                                    <tr class="hover-primary">
                                                        <td>
                                                            <div class="d-flex align-items-center gap-3">
                                                                <button class="btn btn-secondary btn-sm btn-floating">
                                                                    {{ $feedback->guest->first_name[0] }}
                                                                </button>
                                                                <span>{{ $feedback->guest->getFullNameAttribute() }}</span>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge rounded-pill badge-secondary p-2">
                                                                {{ $feedback->type }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="text-secondary">
                                                                {{ Str::limit($feedback->message, 50) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            {{ $feedback->created_at->format('Y-m-d') }}
                                                        </td>
                                                        <td>
                                                            <span class="badge rounded-pill badge-primary p-2">
                                                                {{ $feedback->status }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <button class="btn btn-sm btn-primary shadow-0 me-1"
                                                                    data-mdb-toggle="modal"
                                                                    data-mdb-target="#feedbackModal{{ $feedback->id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                {{-- updateStatus --}}
                                                                <form id="statusForm-{{ $feedback->id }}"
                                                                    action="{{ route('admin.feedbacks.update', $feedback->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <select name="status"
                                                                        class="form-select form-select-sm status-selector"
                                                                        data-feedback-id="{{ $feedback->id }}">
                                                                        <!-- 'pending', 'acknowledged', 'resolved', 'rejected' options here -->
                                                                        <option value="pending"
                                                                            {{ $feedback->status == 'pending' ? 'selected' : '' }}>
                                                                            Pending</option>
                                                                        <option value="acknowledged"
                                                                            {{ $feedback->status == 'acknowledged' ? 'selected' : '' }}>
                                                                            Acknowledged</option>
                                                                        <option value="resolved"
                                                                            {{ $feedback->status == 'resolved' ? 'selected' : '' }}>
                                                                            Resolved</option>
                                                                        <option value="rejected"
                                                                            {{ $feedback->status == 'rejected' ? 'selected' : '' }}>
                                                                            Rejected</option>
                                                                </form>
                                                            </div>

                                                        </td>
                                                    </tr>

                                                    <div class="modal fade" id="feedbackModal{{ $feedback->id }}"
                                                        tabindex="-1">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Feedback Details</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-mdb-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <strong>Guest:</strong>
                                                                            {{ $feedback->guest->full_name }}<br>
                                                                            <strong>Email:</strong>
                                                                            {{ $feedback->guest->email }}
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>Reservation:</strong>
                                                                            {{ $feedback->reservation_id ? '#' . $feedback->reservation_id : 'N/A' }}<br>
                                                                            <strong>Submitted:</strong>
                                                                            {{ $feedback->created_at->format('M d, Y H:i') }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 p-3 bg-light rounded">
                                                                        <strong>Message:</strong>
                                                                        <p class="mt-2">{{ $feedback->message }}</p>
                                                                    </div>

                                                                    <form
                                                                        action="{{ route('admin.feedbacks.update', $feedback) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="row mb-3">
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Status</label>
                                                                                <select class="form-select" name="status"
                                                                                    required>
                                                                                    @foreach (['pending', 'acknowledged', 'resolved', 'rejected'] as $status)
                                                                                        <option
                                                                                            value="{{ $status }}"
                                                                                            {{ $feedback->status === $status ? 'selected' : '' }}>
                                                                                            {{ ucfirst($status) }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Category</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="{{ $feedback->category ?? 'N/A' }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Resolution
                                                                                Notes</label>
                                                                            <textarea class="form-control" name="resolution_notes" rows="3">{{ $feedback->resolution_notes }}</textarea>
                                                                        </div>

                                                                        <div class="d-flex justify-content-end gap-2">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-mdb-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Update
                                                                                Status</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Blacklist Tab -->
                    <div class="tab-pane fade" id="blacklist" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow-1 border p-4 mt-3">
                                    <h4 class="text-dark font-bold">
                                        Blacklisted Guests
                                    </h4>
                                    <div class="table-responsive">
                                        <table class="table w-100" id="guesttable3">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Reason</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Notes</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($blacklistedGuests as $blacklisted)
                                                    <tr class="hover-primary">
                                                        <td>
                                                            <div class="d-flex align-items-center gap-3">
                                                                <span>{{ $blacklisted->guest->getFullNameAttribute() }}</span>
                                                            </div>
                                                        </td>
                                                        <td><span
                                                                class="badge rounded-pill badge-secondary p-2">{{ $blacklisted->reason }}</span>
                                                        </td>
                                                        <td>{{ $blacklisted->created_at->format('Y-m-d') }}</td>
                                                        <td>
                                                            <span
                                                                class="badge rounded-pill badge-{{ $blacklisted->is_active ? 'success' : 'danger' }} p-2">
                                                                {{ $blacklisted->is_active ? 'Active' : 'Inactive' }}
                                                            </span>
                                                        </td>
                                                        <td>{{ Str::limit($blacklisted->notes, 50) }}</td>
                                                        <td>
                                                            <form
                                                                action="{{ route('admin.blacklist.update-status', $blacklisted) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="guest_id"
                                                                    value="{{ $blacklisted->guest_id }}">
                                                                <select name="is_active"
                                                                    class="form-select form-select-sm status-selector"
                                                                    onchange="this.form.submit()">
                                                                    <option value="1"
                                                                        {{ $blacklisted->is_active ? 'selected' : '' }}>
                                                                        Active</option>
                                                                    <option value="0"
                                                                        {{ !$blacklisted->is_active ? 'selected' : '' }}>
                                                                        Inactive</option>
                                                                </select>

                                                            </form>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Blacklist Modal -->
                <div class="modal fade" id="blacklistModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Guest to Blacklist</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="blacklistForm" action="{{ route('admin.blacklist.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="guest_id" id="blacklistGuestId">

                                    <div class="mb-3">
                                        <label class="form-label">Reason</label>
                                        <select class="form-select" name="reason" required>
                                            <option value="">Select Reason</option>
                                            <option value="Payment Issues">Payment Issues</option>
                                            <option value="Property Damage">Property Damage</option>
                                            <option value="Disruptive Behavior">Disruptive Behavior</option>
                                            <option value="Policy Violation">Policy Violation</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Blacklisted Until (leave blank for permanent)</label>
                                        <input type="date" class="form-control" name="blacklisted_until"
                                            min="{{ now()->format('Y-m-d') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Notes</label>
                                        <textarea class="form-control" name="notes" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="hidden" name="is_active" value="0">
                                        <!-- This ensures a value is always sent -->
                                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active"
                                            value="1" checked>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-mdb-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger shadow-0">Add to Blacklist</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        // Function to open modal and set guest ID
        function openBlacklistModal(guestId) {
            document.getElementById('blacklistGuestId').value = guestId;
            $('#blacklistModal').modal('show');
        }

        // Optional: Form submission handling
        document.getElementById('blacklistForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // You can add AJAX submission here if needed
            this.submit();
        });
    </script>

    <script>
        document.querySelectorAll('.status-selector').forEach(select => {
            select.addEventListener('change', function() {
                const formId = 'statusForm-' + this.dataset.feedbackId;
                document.getElementById(formId).submit();
            });
        });
    </script>

    <script>
        new DataTable("#guesttable1")
        new DataTable("#guesttable2")
        new DataTable("#guesttable3")
    </script>
@endpush
