@extends('admin.layouts.master')

@section('content')
    <section>
        <div class="row justify-content-between mb-4">
            <div class="col-md-6">
                <h3 class="font-bold text-dark">Completed Tasks</h3>
            </div>
            <div class="col-md-6 text-end">
                <div class="dropdown">
                    <button class="btn btn-primary shadow-0 dropdown-toggle" type="button" id="todoDropdown"
                        data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="todoDropdown">
                        <li class="border-bottom border-secondary">
                            <a class="dropdown-item" href="{{ route('admin.todo.create') }}">
                                <i class="fas fa-plus me-2"></i> Add New Task
                            </a>
                        </li>
                        <li class="border-bottom border-secondary">
                            <a class="dropdown-item" href="{{ route('admin.todo.index') }}">
                                <i class="fas fa-tasks me-2"></i> View Tasks
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.todo.completed') }}">
                                <i class="fas fa-check-circle me-2"></i> Completed Tasks
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card shadow-0 border">
            <div class="card-body">
                @if ($completedTodos->isEmpty())
                    <p class="text-muted">No completed tasks yet.</p>
                @else
                    <ul class="list-group">
                        @foreach ($completedTodos as $todo)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h5><s>{{ $todo->title }}</s></h5>
                                    @if ($todo->description)
                                        <p class="mb-0 text-muted"><s>{{ $todo->description }}</s></p>
                                    @endif
                                    <small class="text-muted">Completed on
                                        {{ $todo->completed_at->format('M d, Y H:i') }}</small>
                                </div>
                                <form action="{{ route('admin.todo.destroy', $todo) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light border btn-sm shadow-0">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        </div>
    @endsection
