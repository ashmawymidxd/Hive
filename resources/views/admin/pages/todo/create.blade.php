@extends('admin.layouts.master')

@section('content')
<section>
    <div class="row justify-content-between mb-4">
        <div class="col-md-6">
           <h3 class="font-bold text-dark">Add New Task</h3>
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

    <div class="card shadow-0 border">
        <div class="card-body">
            <form action="{{ route('admin.todo.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title *</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary shadow-0">Add Task</button>
                <a href="{{ route('admin.todo.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</section>
@endsection