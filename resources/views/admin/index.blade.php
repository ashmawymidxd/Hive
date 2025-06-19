@extends('admin/layouts/master')

@section('title')
    Dashboard
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
        <h3 class="font-bold text-dark">Dashboard</h3>
        <p class="text-secondary">Welcome back to Hotel Hive management system.</p>
        <div class="row mt-4">
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card p-3 shadow-2 ">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="text-secondary">Available Rooms</p>
                        <button class="btn btn-secondary btn-lg btn-floating">
                            <i class="fa fa-bed"></i>
                        </button>
                    </div>
                    @php
                        $totalRooms = App\Models\Room::count();
                        $availableRooms = App\Models\Room::where('status', 'available')->count();

                        // Calculate percentage change from last month
                        $currentMonthAvailable = App\Models\Room::where('status', 'available')
                            ->whereMonth('updated_at', now()->month)
                            ->count();

                        $lastMonthAvailable = App\Models\Room::where('status', 'available')
                            ->whereMonth('updated_at', now()->subMonth()->month)
                            ->count();

                        $percentageChange =
                            $lastMonthAvailable > 0
                                ? round((($currentMonthAvailable - $lastMonthAvailable) / $lastMonthAvailable) * 100, 0)
                                : ($currentMonthAvailable > 0
                                    ? 100
                                    : 0);
                    @endphp
                    <h3 class="text-dark font-bold">{{ $availableRooms }}/{{ $totalRooms }}</h3>
                    <small class="text-{{ $percentageChange >= 0 ? 'success' : 'danger' }}">
                        {{ $percentageChange >= 0 ? '↑' : '↓' }} {{ abs($percentageChange) }}%
                        vs last month
                    </small>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card p-3 shadow-2 ">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="text-secondary">New Guests</p>
                        <button class="btn btn-secondary btn-lg btn-floating">
                            <i class="fa fa-user-group"></i>
                        </button>
                    </div>
                    <h3 class="text-dark font-bold">{{ App\Models\Guest::count() }}</h3>
                    @php
                        // Calculate percentage change from last month
                        $currentMonthCount = App\Models\Guest::whereMonth('created_at', now()->month)->count();
                        $lastMonthCount = App\Models\Guest::whereMonth('created_at', now()->subMonth()->month)->count();
                        $percentageChange =
                            $lastMonthCount > 0
                                ? round((($currentMonthCount - $lastMonthCount) / $lastMonthCount) * 100, 0)
                                : 100;
                    @endphp
                    <small class="text-{{ $percentageChange >= 0 ? 'success' : 'danger' }}">
                        {{ $percentageChange >= 0 ? '↑' : '↓' }} {{ abs($percentageChange) }}%
                        vs last month
                    </small>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card p-3 shadow-2 ">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="text-secondary">Today's Revenue</p>
                        <button class="btn btn-secondary btn-lg btn-floating">
                            <i class="fa fa-dollar-sign"></i>
                        </button>
                    </div>
                    <h3 class="text-dark font-bold">${{ number_format($todayRevenue) }}</h3>

                    @if ($percentageChange !== null)
                        <small class="text-secondary">
                            {{ $percentageChange >= 0 ? '↑' : '↓' }} {{ abs(number_format($percentageChange, 1)) }}%
                            vs last month
                        </small>
                    @else
                        <small class="text-secondary">No data for last month</small>
                    @endif

                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card p-3 shadow-2 ">
                    @php
                        // Current occupancy
                        $totalRooms = App\Models\Room::count();
                        $occupiedRooms = App\Models\Room::where('status', 'occupied')->count();
                        $currentOccupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100) : 0;

                        // Historical data (last 30 days)
                        $occupancyRecords = App\Models\OccupancyRecord::where('record_date', '>=', now()->subDays(30))
                            ->orderBy('record_date')
                            ->get();

                        // Calculate 30-day average
                        $averageOccupancy = $occupancyRecords->avg('occupancy_rate');

                        // Yesterday's rate for trend
$yesterdayRate = App\Models\OccupancyRecord::where('record_date', today()->subDay())->value(
    'occupancy_rate',
                        );
                        $trend = $yesterdayRate ? $currentOccupancyRate - $yesterdayRate : 0;
                    @endphp

                    <div class="d-flex align-items-center justify-content-between">
                        <p class="text-secondary">Occupancy Rate</p>
                        <button class="btn btn-secondary btn-lg btn-floating" data-bs-toggle="tooltip"
                            title="View historical data">
                            <i class="fa fa-calendar-alt"></i>
                        </button>
                    </div>

                    <h3 class="text-dark font-bold">{{ $currentOccupancyRate }}%</h3>



                    <div class="d-flex justify-content-between">
                        <small class="text-secondary">{{ round($averageOccupancy) }}% 30-day avg</small>
                        <small class="{{ $trend >= 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fas fa-arrow-{{ $trend >= 0 ? 'up' : 'down' }}"></i>
                            {{ abs(round($trend, 1)) }}%
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-md-12 col-lg-4 mt-1" data-aos="fade-up" data-aos-delay="500">
                <div class="card shadow-2 p-3" style="height: 380px;">
                    @php
                        $totalRooms = App\Models\Room::count();
                        $available = App\Models\Room::where('status', 'available')->count();
                        $occupied = App\Models\Room::where('status', 'occupied')->count();
                        $maintenance = App\Models\Room::where('status', 'maintenance')->count();
                        $cleaning = App\Models\Room::where('status', 'cleaning')->count();
                        $reserved = App\Models\Reservation::count();

                        // Calculate percentages (avoid division by zero)
                        $availablePercent = $totalRooms > 0 ? ($available / $totalRooms) * 100 : 0;
                        $occupiedPercent = $totalRooms > 0 ? ($occupied / $totalRooms) * 100 : 0;
                        $maintenancePercent = $totalRooms > 0 ? ($maintenance / $totalRooms) * 100 : 0;
                        $cleaningPercent = $totalRooms > 0 ? ($cleaning / $totalRooms) * 100 : 0;
                        $reservedPercent = $totalRooms > 0 ? ($reserved / $totalRooms) * 100 : 0;
                    @endphp

                    <div class="d-flex align-items-center justify-content-between">
                        <h5>Room Status</h5>
                        <small class="text-secondary">{{ $totalRooms }} total rooms</small>
                    </div>

                    <div class="mt-3">
                        <!-- Available Rooms Progress Bar -->
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ $availablePercent }}%; border-radius: 0 20px 20px 0px;"
                                aria-valuenow="{{ $availablePercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <!-- Occupied Rooms Progress Bar -->
                        <div class="progress" style="height: 10px; margin-top: 8px;">
                            <div class="progress-bar bg-info" role="progressbar"
                                style="width: {{ $occupiedPercent }}%; border-radius: 0 20px 20px 0px;"
                                aria-valuenow="{{ $occupiedPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <!-- Cleaning Rooms Progress Bar -->
                        <div class="progress" style="height: 10px; margin-top: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $cleaningPercent }}%; border-radius: 0 20px 20px 0px;"
                                aria-valuenow="{{ $cleaningPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <!-- Maintenance Rooms Progress Bar -->
                        <div class="progress" style="height: 10px; margin-top: 8px;">
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ $maintenancePercent }}%; border-radius: 0 20px 20px 0px;"
                                aria-valuenow="{{ $maintenancePercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!-- Reserved Rooms Progress Bar -->
                        <div class="progress" style="height: 10px; margin-top: 8px;">
                            <div class="progress-bar bg-secondary" role="progressbar"
                                style="width: {{ $reservedPercent }}%; border-radius: 0 20px 20px 0px;"
                                aria-valuenow="{{ $reservedPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex align-items-center justify-content-start gap-2 mb-2">
                            <div class="rounded-circle bg-success p-2" style="width: 5px; height: 5px;"></div>
                            <strong>{{ $available }}</strong> <span>Available Rooms</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start gap-2 mb-2">
                            <div class="rounded-circle bg-info p-2" style="width: 5px; height: 5px;"></div>
                            <strong>{{ $occupied }}</strong> <span>Occupied Rooms</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start gap-2 mb-2">
                            <div class="rounded-circle bg-warning p-2" style="width: 5px; height: 5px;"></div>
                            <strong>{{ $cleaning }}</strong> <span>Cleaning Rooms</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start gap-2">
                            <div class="rounded-circle bg-danger p-2" style="width: 5px; height: 5px;"></div>
                            <strong>{{ $maintenance }}</strong> <span>Under Maintenance</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-start gap-2 mt-2">
                            <div class="rounded-circle bg-secondary p-2" style="width: 5px; height: 5px;"></div>
                            <strong>{{ $reserved }}</strong> <span>Reserved Rooms</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-8 mt-1" data-aos="fade-up" data-aos-delay="600">
                <div class="card shadow-2 p-3" style="height: 380px">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <h5 class="font-bold">Occupancy Rate</h5>
                        <div class="d-flex justify-content-end mb-3">
                            <button id="dailyBtn" class="btn btn-primary btn-sm me-2 shadow-0 bg-navy">Daily</button>
                            <button id="weeklyBtn" class="btn btn-secondary btn-sm me-2">Weekly</button>
                            <button id="monthlyBtn" class="btn btn-secondary btn-sm">Monthly</button>
                        </div>
                    </div>
                    <canvas class="p-3" id="occupancyChart" height="400" width="1200">
                    </canvas>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row mt-4" data-aos="fade-up" data-aos-delay="200">
            <div class="col-md-12">
                <div class="bg-white rounded-3 shadow-2 p-3">
                    <div class="">
                        <h6 class="font-bold text-dark">Quick Actions</h6>
                    </div>
                    <div class="row mt-3">
                        <a href="{{ route('admin.reservations.create') }}" class="col-lg-3 col-md-6 text-center mt-1"
                            data-aos="flip-up" data-aos-delay="100">
                            <div
                                class="hover-primary rounded-3 border d-flex flex-column align-items-center justify-content-center p-3">
                                <span
                                    class="bg-primary p-3 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="fa fa-bars text-white"></i>
                                </span>
                                <h6 class="mt-3 text-dark font-bold">New Booking</h6>
                            </div>
                        </a>
                        <a href="{{ route('admin.reservations.index') }}" class="col-lg-3 col-md-6 text-center mt-1"
                            data-aos="flip-up" data-aos-delay="200">
                            <div
                                class="hover-primary rounded-3 border d-flex flex-column align-items-center justify-content-center p-3">
                                <span
                                    class="bg-success p-3 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-arrow-right-to-bracket text-white"></i>
                                </span>
                                <h6 class="mt-3 text-dark font-bold">Check In</h6>
                            </div>
                        </a>
                        <a href="{{ route('admin.reservations.index') }}" class="col-lg-3 col-md-6 text-center mt-1"
                            data-aos="flip-up" data-aos-delay="300">
                            <div
                                class="hover-primary rounded-3 border d-flex flex-column align-items-center justify-content-center p-3">
                                <span
                                    class="bg-warning p-3 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-arrow-right-from-bracket text-white"></i>
                                </span>
                                <h6 class="mt-3 text-dark font-bold">Check Out</h6>
                            </div>
                        </a>
                        <a href="{{ route('admin.rooms.index') }}" class="col-lg-3 col-md-6 text-center mt-1"
                            data-aos="flip-up" data-aos-delay="400">
                            <div
                                class="hover-primary rounded-3 border d-flex flex-column align-items-center justify-content-center p-3">
                                <span
                                    class="bg-primary p-3 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="fa fa-bed text-white"></i>
                                </span>
                                <h6 class="mt-3 text-dark font-bold">Room Status</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row mt-4">
            <div class="col-md-12 col-lg-8 mt-1" data-aos="fade-up" data-aos-delay="300">
                <div class="card shadow-2 p-0">
                    <div class="p-3">
                        <h6 class="font-bold text-dark">Recent Bookings</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Guest</th>
                                    <th>Room</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Status</th>
                                    <th>Amount</th>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="text-center p-3">
                        <a class="text-dark" href="{{ route('admin.reservations.index') }}">View All Bookings</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 mt-1" data-aos="fade-up" data-aos-delay="400">
                <div class="card shadow-2 h-100">
                    <div class="card-header d-flex align-items-center justify-content-between p-3">
                        <h6 class="font-bold text-dark">Notifications</h6>
                        <span class="badge rounded-pill badge-light">{{ auth()->user()->unreadNotifications->count() }}
                            New</span>
                    </div>
                    <div class="card-body p-0">
                        @foreach (auth('admin')->user()->unreadNotifications->take(5) as $notification)
                            <div class="d-flex align-items-center gap-2 hover-primary p-3 mark-as-read"
                                data-id="{{ $notification->id }}" style="cursor: pointer;">
                                @php
                                    // Determine icon and color based on notification type
                                    $iconConfig = [
                                        'App\Notifications\ReservationCreatedNotification' => [
                                            'icon' => 'fa-calendar-plus',
                                            'color' => 'primary',
                                        ],
                                        'App\Notifications\CheckInNotification' => [
                                            'icon' => 'fa-sign-in-alt',
                                            'color' => 'success',
                                        ],
                                        'App\Notifications\CheckOutNotification' => [
                                            'icon' => 'fa-sign-out-alt',
                                            'color' => 'info',
                                        ],
                                        'App\Notifications\InvoiceNotification' => [
                                            'icon' => 'fa-file-invoice-dollar',
                                            'color' => 'warning',
                                        ],
                                        'default' => [
                                            'icon' => 'fa-bell',
                                            'color' => 'warning',
                                        ],
                                    ];

                                    $config = $iconConfig[$notification->type] ?? $iconConfig['default'];
                                @endphp

                                <span
                                    class="bg-{{ $config['color'] }} p-1 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 35px; height: 35px;">
                                    <i class="fa-solid {{ $config['icon'] }} text-white"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <span
                                        class="text-dark">{{ $notification->data['message'] ?? 'New notification' }}</span>
                                    <small class="text-secondary">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach

                        @if (auth()->user()->unreadNotifications->isEmpty())
                            <div class="d-flex align-items-center gap-2 hover-primary p-3">
                                <div class="d-flex flex-column w-100 text-center">
                                    <span class="text-secondary">No new notifications</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-center py-4">
                        <a href="{{ route('admin.notifications.index') }}" class="text-dark">
                            view all notifications
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dailyBtn = document.getElementById('dailyBtn');
            const weeklyBtn = document.getElementById('weeklyBtn');
            const monthlyBtn = document.getElementById('monthlyBtn');
            const ctx = document.getElementById('occupancyChart').getContext('2d');

            let occupancyChart;

            // Initialize chart with daily data
            fetchOccupancyData('daily');

            // Button event listeners
            dailyBtn.addEventListener('click', function() {
                setActiveButton(dailyBtn, [weeklyBtn, monthlyBtn]);
                fetchOccupancyData('daily');
            });

            weeklyBtn.addEventListener('click', function() {
                setActiveButton(weeklyBtn, [dailyBtn, monthlyBtn]);
                fetchOccupancyData('weekly');
            });

            monthlyBtn.addEventListener('click', function() {
                setActiveButton(monthlyBtn, [dailyBtn, weeklyBtn]);
                fetchOccupancyData('monthly');
            });

            function setActiveButton(activeBtn, inactiveBtns) {
                activeBtn.classList.remove('btn-secondary');
                activeBtn.classList.add('btn-primary', 'bg-navy');

                inactiveBtns.forEach(btn => {
                    btn.classList.remove('btn-primary', 'bg-navy');
                    btn.classList.add('btn-secondary');
                });
            }

            function fetchOccupancyData(period) {
                fetch(`http://127.0.0.1:8000/api/occupancy-data/${period}`)
                    .then(response => response.json())
                    .then(data => {
                        updateChart(data);
                    })
                    .catch(error => {
                        console.error('Error fetching occupancy data:', error);
                    });
            }

            function updateChart(data) {
                if (occupancyChart) {
                    occupancyChart.destroy();
                }

                const chartTitle = `Occupancy Rate (${data.period.charAt(0).toUpperCase() + data.period.slice(1)})`;

                occupancyChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: chartTitle,
                            data: data.data,
                            backgroundColor: 'rgba(59, 130, 246, 1)',
                            borderRadius: 7,
                        }]
                    },
                   
                    options: {
                        responsive: true,
                        maintainAspectRatio: true, // This is important for fixed height
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                title: {
                                    display: true,
                                    text: 'Occupancy Rate (%)'
                                },
                                ticks: {
                                    callback: function(value) {
                                        return value + '%';
                                    }
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: data.period === 'daily' ? 'Date' : data.period === 'weekly' ?
                                        'Week' : 'Month'
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.y.toFixed(2) + '%';
                                    }
                                }
                            },
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        }
                    }
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.mark-as-read').click(function(e) {
                e.preventDefault();
                const notificationId = $(this).data('id');

                // Mark as read via AJAX
                $.ajax({
                    url: '/admin/notifications/' + notificationId + '/mark-as-read',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        // Optionally redirect or refresh notifications
                        window.location.href = "{{ route('admin.notifications.index') }}";
                    }
                });
            });
        });
    </script>

    <script>
        AOS.init();
    </script>
@endpush
