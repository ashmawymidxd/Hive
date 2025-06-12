@extends('admin/layouts/master')

@section('title')
    Show Payment , {{ $payment->payment_number }}
@endsection

@push('css')
    <style>
        .card-header {
            padding: 1rem 1.25rem;
        }

        .table-borderless td,
        .table-borderless th {
            padding: 0.75rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .badge {
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .hover-effect:hover {
            transform: translateY(-2px);
            transition: all 0.2s ease;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-0 border">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Payment Details</h5>
                        <div class="btn-group shadow-0">
                            <a href="{{ route('admin.invoices.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back to Payments
                            </a>
                            <button class="btn btn-sm btn-outline-danger" data-mdb-toggle="modal"
                                data-mdb-target="#deletePaymentModal">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Left Column - Payment Details -->
                            <div class="col-md-6">
                                <div class="card  shadow-0 border mb-4 h-100">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Payment Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th width="40%">Payment Number:</th>
                                                        <td>
                                                            <span
                                                                class="badge bg-primary">{{ $payment->payment_number }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Invoice Number:</th>
                                                        <td>
                                                            <a href="{{ route('admin.invoices.show', $payment->invoice_id) }}"
                                                                class="text-decoration-none">
                                                                {{ $payment->invoice->invoice_number }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Guest:</th>
                                                        <td>
                                                            <a href="{{ route('admin.guests.show', $payment->guest_id) }}"
                                                                class="text-decoration-none">
                                                                {{ $payment->guest->getFullName() }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Room:</th>
                                                        <td>
                                                            <a href="{{ route('admin.rooms.show', $payment->invoice->room_id) }}"
                                                                class="text-decoration-none">
                                                                {{ $payment->invoice->room->room_number }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment Date:</th>
                                                        <td>{{ $payment->payment_date->format('F j, Y') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment Method:</th>
                                                        <td>
                                                            <span class="badge bg-info text-dark">
                                                                {{ $payment->payment_method }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Amount and Status -->
                            <div class="col-md-6">
                                <div class="card  shadow-0 border mb-4 h-100">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Payment Summary</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="mb-0">Amount Paid:</h5>
                                            <h3 class="mb-0 text-success">${{ number_format($payment->amount, 2) }}</h3>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="mb-0">Status:</h5>
                                            @if ($payment->status === 'completed')
                                                <span class="badge bg-success py-2 px-3">
                                                    <i class="fas fa-check-circle me-1"></i> Completed
                                                </span>
                                            @elseif($payment->status === 'pending')
                                                <span class="badge bg-warning text-dark py-2 px-3">
                                                    <i class="fas fa-clock me-1"></i> Pending
                                                </span>
                                            @else
                                                <span class="badge bg-danger py-2 px-3">
                                                    <i class="fas fa-times-circle me-1"></i> Failed
                                                </span>
                                            @endif
                                        </div>

                                        <hr>

                                        <div class="mb-3">
                                            <h5 class="mb-2">Notes:</h5>
                                            <div class="card  shadow-0 border bg-light p-3">
                                                @if ($payment->notes)
                                                    {{ $payment->notes }}
                                                @else
                                                    <span class="text-muted">No notes available</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center text-muted small">
                                            <div>
                                                <i class="fas fa-calendar-plus me-1"></i>
                                                Created: {{ $payment->created_at->format('M j, Y H:i') }}
                                            </div>
                                            <div>
                                                <i class="fas fa-calendar-check me-1"></i>
                                                Updated: {{ $payment->updated_at->format('M j, Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Related Information Section -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card shadow-0 border">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Related Invoice Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Invoice Date</th>
                                                        <th>Due Date</th>
                                                        <th>Original Amount</th>
                                                        <th>Amount Paid</th>
                                                        <th>Balance</th>
                                                        <th>Invoice Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $payment->invoice->issue_date->format('M j, Y') }}</td>
                                                        <td>{{ $payment->invoice->due_date->format('M j, Y') }}</td>
                                                        <td>${{ number_format($payment->invoice->amount, 2) }}</td>
                                                        <td>${{ number_format($payment->invoice->payments->sum('amount'), 2) }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $balance =
                                                                    $payment->invoice->amount -
                                                                    $payment->invoice->payments->sum('amount');
                                                            @endphp
                                                            @if ($balance > 0)
                                                                <span
                                                                    class="text-danger">${{ number_format($balance, 2) }}</span>
                                                            @else
                                                                <span class="text-success">$0.00</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($payment->invoice->status === 'paid')
                                                                <span class="badge bg-success">Paid</span>
                                                            @elseif($payment->invoice->status === 'partial')
                                                                <span class="badge bg-warning text-dark">Partial</span>
                                                            @else
                                                                <span class="badge bg-danger">Unpaid</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deletePaymentModal" tabindex="-1" aria-labelledby="deletePaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deletePaymentModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this payment?</p>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This action cannot be undone. All payment data will be permanently
                        removed.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Tooltip initialization
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Print functionality
            $('#printPayment').click(function() {
                window.print();
            });
        });
    </script>
@endpush
