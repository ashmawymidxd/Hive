@extends('admin.layouts.master')

@section('title', 'Expense Details')

@section('content')
    <div class="card shadow-0 border">
        <div class="card-header bg-light p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Expense Details</h4>
                <div>
                    <a href="{{ route('admin.expenses.edit', $expense) }}" class="btn btn-light shadow-0 btn-sm">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <button class="btn btn-light shadow-0 btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                </div>
            </div>
        </div>
        
        <div class="card-body p-4">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="detail-item mb-3">
                        <h6 class="detail-label text-muted">EXPENSE ID</h6>
                        <p class="detail-value">{{ $expense->expense_number }}</p>
                    </div>
                    
                    <div class="detail-item mb-3">
                        <h6 class="detail-label text-muted">CATEGORY</h6>
                        <p class="detail-value">
                            <span class="badge bg-primary-light text-primary">
                                {{ $expense->category->name }}
                            </span>
                        </p>
                    </div>
                    
                    <div class="detail-item mb-3">
                        <h6 class="detail-label text-muted">DEPARTMENT</h6>
                        <p class="detail-value">
                            <span class="badge bg-secondary-light text-secondary">
                                {{ $expense->department->name }}
                            </span>
                        </p>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="detail-item mb-3">
                        <h6 class="detail-label text-muted">AMOUNT</h6>
                        <p class="detail-value text-success fw-bold">
                            ${{ number_format($expense->amount, 2) }}
                        </p>
                    </div>
                    
                    <div class="detail-item mb-3">
                        <h6 class="detail-label text-muted">EXPENSE DATE</h6>
                        <p class="detail-value">
                            <i class="far fa-calendar-alt me-2"></i>
                            {{ $expense->date->format('M d, Y') }}
                        </p>
                    </div>
                    
                    <div class="detail-item mb-3">
                        <h6 class="detail-label text-muted">CREATED AT</h6>
                        <p class="detail-value">
                            <i class="far fa-clock me-2"></i>
                            {{ $expense->created_at->format('M d, Y H:i') }}
                        </p>
                    </div>
                </div>
                
                <!-- Description Section -->
                <div class="col-12 mt-4">
                    <div class="card border shadow-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-align-left me-2"></i> Description
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $expense->description ?: 'No description provided' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Information Section (if needed) -->
                @if($expense->updated_at != $expense->created_at)
                <div class="col-12 mt-3">
                    <p class="text-muted small">
                        <i class="fas fa-info-circle me-1"></i>
                        Last updated: {{ $expense->updated_at->diffForHumans() }}
                    </p>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Footer with Back Button -->
        <div class="card-footer bg-light p-3">
            <a href="{{ route('admin.invoices.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Expenses
            </a>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this expense?</p>
                    <p class="fw-bold">{{ $expense->expense_number }} - {{ $expense->category->name }} (${{ number_format($expense->amount, 2) }})</p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.expenses.destroy', $expense) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Expense</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
    .detail-item {
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #f0f0f0;
    }
    .detail-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    .detail-value {
        font-size: 1rem;
        margin-bottom: 0;
    }
    .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.1);
    }
    .bg-secondary-light {
        background-color: rgba(108, 117, 125, 0.1);
    }
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Any additional JavaScript can go here
        // For example, you could add a print button functionality
        document.getElementById('printBtn').addEventListener('click', function() {
            window.print();
        });
    });
</script>
@endpush