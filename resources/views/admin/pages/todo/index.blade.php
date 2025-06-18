@extends('admin.layouts.master')

@section('content')
<section>
    <div class="row justify-content-between mb-4">
        <div class="col-md-6">
           <h3 class="font-bold text-dark">To-Do List</h3>
        </div>
        <div class="col-md-6 text-end">
            <div class="dropdown">
                <button class="btn btn-primary shadow-0 dropdown-toggle" type="button" id="todoDropdown" data-mdb-toggle="dropdown" aria-expanded="false">
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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-0 border">
        <div class="card-body">
            @if($todos->isEmpty())
                <p class="text-muted">No tasks found. Add your first task!</p>
            @else
                <ul class="list-group">
                    @foreach($todos as $todo)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h5>{{ $todo->title }}</h5>
                                @if($todo->description)
                                    <p class="mb-0 text-muted">{{ $todo->description }}</p>
                                @endif
                            </div>
                            <div class="btn-group shadow-0" role="group">
                                <form action="{{ route('admin.todo.complete', $todo) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-light border btn-sm shadow-0">
                                        <i class="fas fa-check"></i> Complete
                                    </button>
                                </form>
                                <form action="{{ route('admin.todo.destroy', $todo) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light border btn-sm shadow-0">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>
@endsection