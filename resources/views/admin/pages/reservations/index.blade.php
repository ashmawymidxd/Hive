@extends('admin/layouts/master')

@section('title')
    all Reservations
@endsection

@push('css')
    <style>
        /* Status badges */
        .bg-checked_in {
            background-color: #17a3b846 !important;
            color: blue;
            padding: 5px
                /* Cyan for checked-in */
        }

        .bg-checked_out {
            background-color: #6c757d4b !important;
            color: blue;
            padding: 5px
                /* Gray for checked-out */
        }

        .bg-no_show {
            background-color: #dc35467c !important;
            color: blue;
            padding: 5px
                /* Red for no-show */
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="font-bold text-dark">Reservations</h3>
            <a class="btn btn-primary shadow-0" href="{{ route('admin.reservations.create') }}">
                <i class="fa fa-add"></i>
            </a>
        </div>
        <p class="text-secondary">Manage all hotel reservations and bookings</p>


        <!-- Bootstrap Tabs -->
        <ul class="nav nav-tabs mb-4 border-bottom" id="reservationTabs" role="tablist">
            <li class="nav-item bg-white" role="presentation">
                <button class="nav-link active" id="all-tab" data-mdb-toggle="tab" data-mdb-target="#all" type="button"
                    role="tab" aria-controls="all" aria-selected="true">
                    All Reservations
                </button>
            </li>
            <li class="nav-item bg-white" role="presentation">
                <button class="nav-link" id="upcoming-tab" data-mdb-toggle="tab" data-mdb-target="#upcoming" type="button"
                    role="tab" aria-controls="upcoming" aria-selected="false">
                    Upcoming
                </button>
            </li>
            <li class="nav-item bg-white" role="presentation">
                <button class="nav-link" id="checkin-tab" data-mdb-toggle="tab" data-mdb-target="#checkin" type="button"
                    role="tab" aria-controls="checkin" aria-selected="false">
                    Check-in Today
                </button>
            </li>
            <li class="nav-item bg-white" role="presentation">
                <button class="nav-link" id="checkout-tab" data-mdb-toggle="tab" data-mdb-target="#checkout" type="button"
                    role="tab" aria-controls="checkout" aria-selected="false">
                    Check-out Today
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="reservationTabsContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <!-- Content for All Reservations -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show border-start border-success border-4"
                                role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-mdb-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show border-start border-danger border-4"
                                role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-mdb-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show border-start border-danger border-4"
                                role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-mdb-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card shadow-1 p-4 border">
                            <h4 class="text-dark">All Reservations</h4>
                            <p class="text-secondary">
                                {{ \App\Models\Reservation::count() }}
                                total reservations</p>
                            <div class="table-responsive">
                                <table class="table w-100" id="reservations">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Reservation ID</th>
                                            <th>Guest</th>
                                            <th>Room</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reservations as $reservation)
                                            <tr>
                                                <td>#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $reservation->guest->full_name }}</td>
                                                <td>{{ $reservation->room->room_number }} ({{ $reservation->room->type }})
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('M d, Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('M d, Y') }}
                                                </td>

                                                <td>
                                                    @php
                                                        $statusClasses = [
                                                            'confirmed' => 'badge-success',
                                                            'pending' => 'badge-info',
                                                            'cancelled' => 'badge-warning',
                                                            'checked_in' => 'bg-checked_in',
                                                            'checked_out' => 'bg-checked_out',
                                                            'no_show' => 'bg-no_show',
                                                        ];
                                                    @endphp
                                                    <span
                                                        class="badge {{ $statusClasses[$reservation->status] ?? 'badge-secondary' }}">
                                                        {{ ucfirst($reservation->status) }}
                                                    </span>
                                                </td>
                                                <td>${{ number_format($reservation->amount, 2) }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('admin.reservations.show', $reservation->id) }}"
                                                            class="btn btn-light border btn-sm shadow-0 me-1">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                                                            class="btn btn-light border btn-sm shadow-0 me-1">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('admin.reservations.destroy', $reservation->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-light border btn-sm shadow-0"
                                                                onclick="return confirm('Are you sure?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>

                                                        @if ($reservation->status === 'confirmed')
                                                            <form
                                                                action="{{ route('admin.reservations.check-in', $reservation->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-success btn-sm shadow-0"
                                                                    title="Check In">
                                                                    <i class="fa fa-sign-in-alt"></i>
                                                                </button>
                                                            </form>
                                                        @endif

                                                        @if ($reservation->isCheckedIn())
                                                            <form
                                                                action="{{ route('admin.reservations.check-out', $reservation->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-warning btn-sm shadow-0"
                                                                    title="Check Out">
                                                                    <i class="fa fa-sign-out-alt"></i>
                                                                </button>
                                                            </form>
                                                        @endif

                                                        @if ($reservation->status === 'confirmed' && $reservation->check_in->isPast())
                                                            <form
                                                                action="{{ route('admin.reservations.no-show', $reservation->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm shadow-0"
                                                                    title="Mark as No Show">
                                                                    <i class="fa fa-user-times"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>

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

            <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                <!-- Content for Upcoming Reservations -->
                <div class="card shadow-1 p-4 border">
                    <h5 class="card-title">Upcoming Reservations</h5>
                    <p class="text-secondary">
                        {{ \App\Models\Reservation::where('status', 'pending')->count() }}
                        total upcoming reservations
                    </p>
                    <div class="table-responsive">
                        <table class="table w-100" id="PendingReservations">
                            <thead class="bg-light">
                                <tr>
                                    <th>Reservation ID</th>
                                    <th>Guest</th>
                                    <th>Room</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\Reservation::where('status', 'pending')->get() as $reservation)
                                    <tr>
                                        <td>#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $reservation->guest->full_name }}</td>
                                        <td>{{ $reservation->room->room_number }} ({{ $reservation->room->type }})
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('M d, Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('M d, Y') }}
                                        </td>

                                        <td>
                                            @php
                                                $statusClasses = [
                                                    'confirmed' => 'bg-success',
                                                    'pending' => 'bg-info',
                                                    'cancelled' => 'bg-warning',
                                                    'checked_in' => 'bg-checked_in',
                                                    'checked_out' => 'bg-checked_out',
                                                    'no_show' => 'bg-no_show',
                                                ];
                                            @endphp
                                            <span
                                                class="badge {{ $statusClasses[$reservation->status] ?? 'bg-secondary' }}">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        </td>
                                        <td>${{ number_format($reservation->amount, 2) }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.reservations.show', $reservation->id) }}"
                                                    class="btn btn-light border btn-sm shadow-0 me-1">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                                                    class="btn btn-light border btn-sm shadow-0 me-1">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.reservations.destroy', $reservation->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light border btn-sm shadow-0"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                                @if ($reservation->status === 'confirmed')
                                                    <form
                                                        action="{{ route('admin.reservations.check-in', $reservation->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm shadow-0"
                                                            title="Check In">
                                                            <i class="fa fa-sign-in-alt"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                @if ($reservation->isCheckedIn())
                                                    <form
                                                        action="{{ route('admin.reservations.check-out', $reservation->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning btn-sm shadow-0"
                                                            title="Check Out">
                                                            <i class="fa fa-sign-out-alt"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                @if ($reservation->status === 'confirmed' && $reservation->check_in->isPast())
                                                    <form
                                                        action="{{ route('admin.reservations.no-show', $reservation->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm shadow-0"
                                                            title="Mark as No Show">
                                                            <i class="fa fa-user-times"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="checkin" role="tabpanel" aria-labelledby="checkin-tab">
                <!-- Content for Today's Check-ins -->
                <div class="card shadow-1 border">
                    <div class="card-body">
                        <h5 class="card-title">Today's Check-ins</h5>
                        <p class="text-secondary">
                            {{ \App\Models\Reservation::where('status', 'checked_in')->count() }}
                            Of total reservations
                        </p>
                        <div class="table-responsive">
                            <table class="table w-100" id="checked_in_reservations">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Reservation ID</th>
                                        <th>Guest</th>
                                        <th>Room</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Reservation::where('status', 'checked_in')->get() as $reservation)
                                        <tr>
                                            <td>#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $reservation->guest->full_name }}</td>
                                            <td>{{ $reservation->room->room_number }} ({{ $reservation->room->type }})
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('M d, Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('M d, Y') }}
                                            </td>

                                            <td>
                                                @php
                                                    $statusClasses = [
                                                        'confirmed' => 'bg-success',
                                                        'pending' => 'bg-info',
                                                        'cancelled' => 'bg-warning',
                                                        'checked_in' => 'bg-checked_in',
                                                        'checked_out' => 'bg-checked_out',
                                                        'no_show' => 'bg-no_show',
                                                    ];
                                                @endphp
                                                <span
                                                    class="badge {{ $statusClasses[$reservation->status] ?? 'bg-secondary' }}">
                                                    {{ ucfirst($reservation->status) }}
                                                </span>
                                            </td>
                                            <td>${{ number_format($reservation->amount, 2) }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.reservations.show', $reservation->id) }}"
                                                        class="btn btn-light border btn-sm shadow-0 me-1">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                                                        class="btn btn-light border btn-sm shadow-0 me-1">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.reservations.destroy', $reservation->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-light border btn-sm shadow-0"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>

                                                    @if ($reservation->status === 'confirmed')
                                                        <form
                                                            action="{{ route('admin.reservations.check-in', $reservation->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm shadow-0"
                                                                title="Check In">
                                                                <i class="fa fa-sign-in-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @if ($reservation->isCheckedIn())
                                                        <form
                                                            action="{{ route('admin.reservations.check-out', $reservation->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-sm shadow-0"
                                                                title="Check Out">
                                                                <i class="fa fa-sign-out-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @if ($reservation->status === 'confirmed' && $reservation->check_in->isPast())
                                                        <form
                                                            action="{{ route('admin.reservations.no-show', $reservation->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm shadow-0"
                                                                title="Mark as No Show">
                                                                <i class="fa fa-user-times"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="checkout" role="tabpanel" aria-labelledby="checkout-tab">
                <!-- Content for Today's Check-outs -->
                <div class="card shadow-1 border">
                    <div class="card-body">
                        <h5 class="card-title">Today's Check-outs</h5>
                        <p class="text-secondary">
                            {{ \App\Models\Reservation::where('status', 'checked_out')->count() }}
                            Of total reservations
                        </p>
                        <div class="table-responsive">
                            <table class="table  w-100" id="checked_out_reservations">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Reservation ID</th>
                                        <th>Guest</th>
                                        <th>Room</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Reservation::where('status', 'checked_out')->get() as $reservation)
                                        <tr>
                                            <td>#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $reservation->guest->full_name }}</td>
                                            <td>{{ $reservation->room->room_number }} ({{ $reservation->room->type }})
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('M d, Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('M d, Y') }}
                                            </td>

                                            <td>
                                                @php
                                                    $statusClasses = [
                                                        'confirmed' => 'bg-success',
                                                        'pending' => 'bg-info',
                                                        'cancelled' => 'bg-warning',
                                                        'checked_in' => 'bg-checked_in',
                                                        'checked_out' => 'bg-checked_out',
                                                        'no_show' => 'bg-no_show',
                                                    ];
                                                @endphp
                                                <span
                                                    class="badge {{ $statusClasses[$reservation->status] ?? 'bg-secondary' }}">
                                                    {{ ucfirst($reservation->status) }}
                                                </span>
                                            </td>
                                            <td>${{ number_format($reservation->amount, 2) }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.reservations.show', $reservation->id) }}"
                                                        class="btn btn-light border btn-sm shadow-0 me-1">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                                                        class="btn btn-light border btn-sm shadow-0 me-1">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.reservations.destroy', $reservation->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-light border btn-sm shadow-0"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>

                                                    @if ($reservation->status === 'confirmed')
                                                        <form
                                                            action="{{ route('admin.reservations.check-in', $reservation->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm shadow-0"
                                                                title="Check In">
                                                                <i class="fa fa-sign-in-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @if ($reservation->isCheckedIn())
                                                        <form
                                                            action="{{ route('admin.reservations.check-out', $reservation->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-sm shadow-0"
                                                                title="Check Out">
                                                                <i class="fa fa-sign-out-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                    @if ($reservation->status === 'confirmed' && $reservation->check_in->isPast())
                                                        <form
                                                            action="{{ route('admin.reservations.no-show', $reservation->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm shadow-0"
                                                                title="Mark as No Show">
                                                                <i class="fa fa-user-times"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>

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
    </section>
@endsection

@push('js')
    <script>
        new DataTable('#reservations');
        new DataTable('#PendingReservations');
        new DataTable('#checked_in_reservations');
        new DataTable('#checked_out_reservations');
    </script>

    <script>
        AOS.init()
    </script>
@endpush
