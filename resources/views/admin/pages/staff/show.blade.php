@extends('admin.layouts.master')

@section('title')
    Staff Details: {{ $staff->first_name }} {{ $staff->last_name }}
@endsection

@section('content')
    <section>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-0 border">
                    <div class="card-header">
                        <h3 class="card-title">Staff Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="staff-avatar">
                                <span class="fa fa-user-circle fa-5x"></span>
                            </div>
                            <h4>{{ $staff->first_name }} {{ $staff->last_name }}</h4>
                            <p class="text-muted">{{ $staff->role->name }}</p>
                        </div>

                        <div class="staff-details">
                            <p><strong>Email:</strong> {{ $staff->email }}</p>
                            <p><strong>Phone:</strong> {{ $staff->phone }}</p>
                            <p><strong>Department:</strong> {{ $staff->department->name }}</p>
                            <p><strong>Status:</strong>
                                <span
                                    class="badge badge-{{ $staff->status == 'active' ? 'success' : ($staff->status == 'on_leave' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($staff->status) }}
                                </span>
                            </p>
                            <p><strong>Hire Date:</strong> {{ $staff->hire_date->format('M d, Y') }}</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow-0 border">
                    <div class="card-header">
                        <h3 class="card-title">Staff Tasks</h3>
                    </div>
                    <div class="card-body">

                        @if ($staff->tasks->count() > 0)
                            <table class="table w-100" id="taskTable">
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
@endpush
