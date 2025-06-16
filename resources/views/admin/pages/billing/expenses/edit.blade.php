@extends('admin.layouts.master')

@section('title', 'Edit Expense')

@section('content')
    <div class="card shadow-0 border p-4">
        <h4 class="text-dark">Edit Expense</h4>

        <form action="{{ route('admin.expenses.update', $expense) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="expense_number" class="form-label">Expense ID</label>
                        <input type="text" class="form-control" id="expense_number" name="expense_number" value="{{ $expense->expense_number }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $expense->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select class="form-select" id="department_id" name="department_id">
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $department->id == $expense->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" value="{{ $expense->amount }}" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $expense->date->format('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $expense->description }}</textarea>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update Expense</button>
                </div>
            </div>
        </form>
    </div>
@endsection
