@extends('admin.layouts.master')

@section('title')
    Staff Details: {{ $staff->first_name }} {{ $staff->last_name }}
@endsection

@push('css')
    <style>
        .progress-circle {
            position: relative;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #0035d32a;
            margin: 0 auto 10px;
        }

        .progress-circle:after {
            content: '';
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            top: 5px;
            left: 5px;
        }

        .progress-circle .progress-value {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.2rem;
            font-weight: bold;
            z-index: 2;
        }

        .progress-circle svg {
            position: absolute;
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }

        .progress-circle circle {
            fill: none;
            stroke-width: 8;
            stroke-linecap: round;
            stroke-dasharray: 250;
            stroke-dashoffset: 250;
            transition: stroke-dashoffset 0.8s ease;
        }
    </style>
@endpush
@section('content')
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-0 border">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Staff Information</h3>

                            <div class="">
                                <a href="{{ route('admin.staff.index') }}"
                                    class="btn btn-light border btn-sm float-end me-2"><i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="staff-details">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div
                                                class="d-flex flex-column gap-3 justify-content-start align-items-start my-3">
                                                <div class="d-flex align-items-center gap-2 text-muted">
                                                    <i class="fas fa-shield-alt"></i>
                                                    <h5 class="mb-0">Security Settings</h5>
                                                </div>

                                                <div class="d-flex align-items-center gap-3 ps-4">
                                                    <i class="fas fa-key text-primary"></i>
                                                    <div>
                                                        <strong>Two Factor Authentication:</strong>
                                                        <span
                                                            class="badge bg-{{ $staff->two_factor_enabled ? 'success' : 'secondary' }}">
                                                            {{ $staff->two_factor_enabled ? 'Enabled' : 'Disabled' }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center gap-3 ps-4">
                                                    <i class="fas fa-user-secret text-primary"></i>
                                                    <div>
                                                        <strong>Two Factor Secret:</strong>
                                                        <span class="text-monospace small">
                                                            {{ $staff->two_factor_secret ? substr($staff->two_factor_secret, 0, 4) . '••••••••' : 'N/A' }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center gap-3 ps-4">
                                                    <i class="fas fa-key text-primary"></i>
                                                    <div>
                                                        <strong>Recovery Codes:</strong>
                                                        <span
                                                            class="{{ $staff->two_factor_recovery_codes ? 'text-success' : 'text-secondary' }}">
                                                            {{ $staff->two_factor_recovery_codes ? 'Available' : 'N/A' }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center gap-3 ps-4">
                                                    <i class="fas fa-globe text-primary"></i>
                                                    <div>
                                                        <strong>Timezone:</strong>
                                                        <span class="badge bg-info">
                                                            {{ $staff->timezone }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center gap-3 ps-4">
                                                    <i class="fas fa-language text-primary"></i>
                                                    <div>
                                                        <strong>Language:</strong>
                                                        <span class="badge bg-light text-dark">
                                                            {{ $staff->language }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="d-flex flex-column gap-3 justify-content-start align-items-start my-3">
                                                <!-- Basic Information Section -->
                                                <div class="d-flex align-items-center gap-2 text-muted">
                                                    <i class="fas fa-id-card"></i>
                                                    <h5 class="mb-0">Basic Information</h5>
                                                </div>

                                                <div class="d-flex align-items-center gap-3 ps-4">
                                                    <i class="fas fa-phone text-primary"></i>
                                                    <div>
                                                        <strong>Phone:</strong> {{ $staff->phone }}
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center gap-3 ps-4">
                                                    <i class="fas fa-lock text-primary"></i>
                                                    <div>
                                                        <strong>Password:</strong>
                                                        <span
                                                            class="{{ $staff->password ? 'text-success' : 'text-secondary' }}">
                                                            {{ $staff->password ? '••••••••' : 'N/A' }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center gap-3 ps-4">
                                                    <i class="fas fa-clock text-primary"></i>
                                                    <div>
                                                        <strong>Last Login:</strong>
                                                        <span
                                                            class="{{ $staff->last_login_at ? 'text-success' : 'text-secondary' }}">
                                                            {{ $staff->last_login_at ? $staff->last_login_at->format('M d, Y H:i') : 'Never logged in' }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center gap-3 ps-4">
                                                    <i class="fas fa-network-wired text-primary"></i>
                                                    <div>
                                                        <strong>Last Login IP:</strong>
                                                        <span
                                                            class="{{ $staff->last_login_ip ? 'text-monospace' : 'text-secondary' }}">
                                                            {{ $staff->last_login_ip ?? 'N/A' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="text-center mb-4 d-flex gap-3 align-items-center rounded-3 badge badge-info p-3  border-start border-3 border-info">
                                    <div
                                        class="staff-avatar border border-3 border-info rounded-circle d-flex justify-content-center align-items-center p-1">
                                        @if ($staff->image_path)
                                            <img src="{{ asset('assets/admin/img/admin/' . $staff->image_path) }}"
                                                alt="Staff Avatar" class="img-fluid rounded-circle object-fit-cover"
                                                style="width: 60px; height: 60px;">
                                        @else
                                            <span class="fa fa-user-circle fa-3x"></span>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                        <div class="d-flex flex-column align-items-start">
                                            <h5 class="text-dark fw-bold">{{ $staff->first_name }} {{ $staff->last_name }}
                                            </h5>
                                            <p class="text-muted">{{ $staff->email }}</p>
                                        </div>
                                        <div class="mt-3">
                                            <p class="font-bold mb-3 fa-xl">{{ $staff->role->name }}</p>
                                            <div class="d-flex gap-3 justify-content-start align-items-center mb-3 ">
                                                <i
                                                    class="fa fa-{{ $staff->status == 'active' ? 'check-circle text-success' : ($staff->status == 'on_leave' ? 'clock text-warning' : 'times-circle text-danger') }} fa-2x"></i>
                                                <span
                                                    class="badge badge-{{ $staff->status == 'active' ? 'success' : ($staff->status == 'on_leave' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($staff->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top d-flex align-items-center justify-content-center mb-4">
                                    <div class="p-3 text-center badge-warning w-100">
                                        <i class="fa solid fa-building fa-2x"></i> <br>
                                        <small>{{ $staff->department->name }}</small>
                                    </div>
                                    <div class="p-3 text-center badge-secondary w-100">
                                        <i class="fa fa-calendar fa-2x"></i> <br>
                                        <small>{{ $staff->hire_date->format('M d, Y') }}</small>
                                    </div>
                                </div>

                                <div
                                    class="d-flex justify-content-around align-items-center justify-content-center mb-3 flex-wrap">
                                    <!-- Total Tasks Assigned -->
                                    <div class="p-2 text-center">
                                        <div class="progress-circle" data-value="{{ $staff->tasks->count() }}"
                                            data-max="{{ max($staff->tasks->count(), 1) }}" data-color="#4e73df">
                                            <span class="progress-value">{{ $staff->tasks->count() }}</span>
                                        </div>
                                        <small class="text-muted mt-2 d-block">All Tasks</small>
                                    </div>

                                    <!-- Completed Tasks -->
                                    <div class="p-2 text-center">
                                        <div class="progress-circle"
                                            data-value="{{ $staff->tasks->where('status', 'completed')->count() }}"
                                            data-max="{{ max($staff->tasks->count(), 1) }}" data-color="#1cc88a">
                                            <span
                                                class="progress-value">{{ $staff->tasks->where('status', 'completed')->count() }}</span>
                                        </div>
                                        <small class="text-muted mt-2 d-block">Completed</small>
                                    </div>

                                    <!-- In Progress Tasks -->
                                    <div class="p-2 text-center">
                                        <div class="progress-circle"
                                            data-value="{{ $staff->tasks->where('status', 'in_progress')->count() }}"
                                            data-max="{{ max($staff->tasks->count(), 1) }}" data-color="#f6c23e">
                                            <span
                                                class="progress-value">{{ $staff->tasks->where('status', 'in_progress')->count() }}</span>
                                        </div>
                                        <small class="text-muted mt-2 d-block">In Progress</small>
                                    </div>

                                    <!-- Pending Tasks -->
                                    <div class="p-2 text-center">
                                        <div class="progress-circle"
                                            data-value="{{ $staff->tasks->where('status', 'pending')->count() }}"
                                            data-max="{{ max($staff->tasks->count(), 1) }}" data-color="#858796">
                                            <span
                                                class="progress-value">{{ $staff->tasks->where('status', 'pending')->count() }}</span>
                                        </div>
                                        <small class="text-muted mt-2 d-block">Pending</small>
                                    </div>

                                    <!-- Overdue Tasks -->
                                    <div class="p-2 text-center">
                                        <div class="progress-circle"
                                            data-value="{{ $staff->tasks->where('status', 'overdue')->count() }}"
                                            data-max="{{ max($staff->tasks->count(), 1) }}" data-color="#e74a3b">
                                            <span
                                                class="progress-value">{{ $staff->tasks->where('status', 'overdue')->count() }}</span>
                                        </div>
                                        <small class="text-muted mt-2 d-block">Overdue</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="card shadow-0 border">
                    <div class="card-header bg-light">
                        <h3 class="card-title">Staff Tasks</h3>
                    </div>
                    <div class="card-body">

                        @if ($staff->tasks->count() > 0)
                            <table class="table w-100 table-hover" id="taskTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Task</th>
                                        <th>Status</th>
                                        <th>Priority</th>
                                        <th>Assigned by</th>
                                        <th>Due Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staff->tasks as $task)
                                        <tr>
                                            <td>{{ $task->name }}</td>

                                            <td>
                                                <span
                                                    class="badge badge-{{ $task->status == 'completed' ? 'success' : ($task->status == 'in_progress' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $task->priority }}</span>
                                            </td>
                                            <td>{{ $task->assigner->fullName }}</td>
                                            <td>{{ $task->due_date->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No tasks assigned.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        new DataTable("#taskTable")
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const circles = document.querySelectorAll('.progress-circle');

            circles.forEach(circle => {
                const value = parseInt(circle.getAttribute('data-value'));
                const max = parseInt(circle.getAttribute('data-max'));
                const color = circle.getAttribute('data-color');
                const percentage = (value / max) * 100;
                const circumference = 250;
                const offset = circumference - (percentage / 100) * circumference;

                const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                const svgCircle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');

                svg.setAttribute('viewBox', '0 0 100 100');
                svgCircle.setAttribute('cx', '50');
                svgCircle.setAttribute('cy', '50');
                svgCircle.setAttribute('r', '40');
                svgCircle.setAttribute('stroke', color);
                svgCircle.setAttribute('stroke-dashoffset', offset);

                svg.appendChild(svgCircle);
                circle.insertBefore(svg, circle.firstChild);

                // Adjust text color if the circle is too full
                if (percentage > 70) {
                    const valueElement = circle.querySelector('.progress-value');
                    valueElement.style.color = color;
                }
            });
        });
    </script>
@endpush
