@extends('admin.layouts.master')

@push('css')
    <style>
        .invoice-view .avatar {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .invoice-view .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .invoice-view .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush

@section('content')
    <section class="invoice-view">
        <div class="card shadow-0 border rounded-lg overflow-hidden">
            <div class="card-header  py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">
                        <i class="fas fa-file-invoice me-2"></i>Invoice Details
                    </h3>
                    <span class="badge bg-white text-primary fs-6">
                        #{{ $invoice->invoice_number }}
                    </span>
                </div>
            </div>

            <div class="card-body">
                <!-- Header Section -->
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/admin/img/logo/hive.png') }}" alt="Hotel Logo" class="me-3"
                                style="height: 60px;">
                            <div>
                                <h2 class="mb-1 text-primary">Grand Hotel</h2>
                                <p class="mb-0 text-muted">
                                    <i class="fas fa-map-marker-alt me-1"></i> 123 Hotel Street, City, Country<br>
                                    <i class="fas fa-phone me-1"></i> (123) 456-7890
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded text-end">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">Issue Date:</span>
                                <strong>{{ $invoice->issue_date->format('M d, Y') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">Due Date:</span>
                                <strong
                                    class="{{ $invoice->due_date->isPast() && $invoice->status != 'paid' ? 'text-danger' : '' }}">
                                    {{ $invoice->due_date->format('M d, Y') }}
                                </strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Status:</span>
                                @if ($invoice->status == 'paid')
                                    <span class="badge bg-success py-2 px-3 rounded-pill">
                                        <i class="fas fa-check-circle me-1"></i> Paid
                                    </span>
                                @elseif($invoice->status == 'pending')
                                    <span class="badge bg-warning py-2 px-3 rounded-pill">
                                        <i class="fas fa-clock me-1"></i> Pending
                                    </span>
                                @else
                                    <span class="badge bg-danger py-2 px-3 rounded-pill">
                                        <i class="fas fa-times-circle me-1"></i> Cancelled
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Client Information -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light py-2">
                                <h5 class="mb-0">
                                    <i class="fas fa-user me-2"></i>Bill To
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="avatar avatar-md bg-dark text-white rounded-circle d-flex align-items-center justify-content-center">
                                            {{ substr($invoice->guest->getFullNameAttribute(), 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ $invoice->guest->name }}</h6>
                                        <p class="mb-1 text-muted">
                                            <i class="fas fa-door-open me-1"></i> Room {{ $invoice->room->room_number }}
                                        </p>
                                        <p class="mb-1 text-muted">
                                            <i class="fas fa-envelope me-1"></i> {{ $invoice->guest->email }}
                                        </p>
                                        <p class="mb-0 text-muted">
                                            <i class="fas fa-phone me-1"></i> {{ $invoice->guest->phone }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-light py-2">
                                <h5 class="mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Booking Details
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="mb-2 text-muted">Room Type:</p>
                                        <p class="mb-2 text-muted">Check-In:</p>
                                        <p class="mb-0 text-muted">Check-Out:</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-2"><strong>{{ $invoice->room->type }}</strong></p>
                                        <p class="mb-2">
                                            <strong>{{ optional($invoice->booking)->check_in_date?->format('M d, Y') ?? 'N/A' }}</strong>
                                        </p>
                                        <p class="mb-0">
                                            <strong>{{ optional($invoice->booking)->check_out_date?->format('M d, Y') ?? 'N/A' }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoice Items -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light py-2">
                        <h5 class="mb-0">
                            <i class="fas fa-receipt me-2"></i>Invoice Items
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="60%">Description</th>
                                        <th width="20%" class="text-center">Days</th>
                                        <th width="20%" class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>Room {{ $invoice->room->room_number }}</strong><br>
                                            <small class="text-muted">{{ $invoice->room->type }} -
                                                {{ $invoice->room->bed_type }}</small>
                                        </td>
                                        <td class="text-center">
                                            {{ optional($invoice->booking)->nights_stayed ?? 1 }}
                                        </td>
                                        <td class="text-end">${{ number_format($invoice->amount, 2) }}</td>
                                    </tr>

                                   

                                    <tr class="table-light">
                                        <td colspan="2" class="text-end"><strong>Subtotal:</strong></td>
                                        <td class="text-end">${{ number_format($invoice->amount, 2) }}</td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="2" class="text-end"><strong>Tax (10%):</strong></td>
                                        <td class="text-end">${{ number_format($invoice->amount * 0.1, 2) }}</td>
                                    </tr>
                                    <tr class="table-active">
                                        <td colspan="2" class="text-end"><strong>Total Amount:</strong></td>
                                        <td class="text-end">
                                            <h5 class="mb-0 text-primary">${{ number_format($invoice->amount * 1.1, 2) }}
                                            </h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                @if ($invoice->status == 'paid' && $invoice->payment)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-light py-2">
                            <h5 class="mb-0">
                                <i class="fas fa-credit-card me-2"></i>Payment Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><span class="text-muted">Payment Method:</span>
                                        <strong>{{ ucfirst($invoice->payment->method) }}</strong>
                                    </p>
                                    <p class="mb-1"><span class="text-muted">Transaction ID:</span>
                                        <strong>{{ $invoice->payment->transaction_id }}</strong>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1"><span class="text-muted">Payment Date:</span>
                                        <strong>{{ $invoice->payment->payment_date->format('M d, Y H:i') }}</strong>
                                    </p>
                                    <p class="mb-1"><span class="text-muted">Amount Paid:</span>
                                        <strong
                                            class="text-success">${{ number_format($invoice->payment->amount, 2) }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Notes Section -->
                @if ($invoice->notes)
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light py-2">
                            <h5 class="mb-0">
                                <i class="fas fa-sticky-note me-2"></i>Additional Notes
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-light" role="alert">
                                <i class="fas fa-quote-left text-muted me-2"></i>
                                {{ $invoice->notes }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Footer Actions -->
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.invoices.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Invoices
                    </a>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.invoices.download', $invoice) }}" class="btn btn-outline-primary">
                            <i class="fas fa-file-pdf me-2"></i>Download PDF
                        </a>
                        <a href="{{ route('admin.invoices.print', $invoice) }}" class="btn btn-outline-success">
                            <i class="fas fa-print me-2"></i>Print Invoice
                        </a>
                        @if ($invoice->status == 'pending')
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#markAsPaidModal">
                                <i class="fas fa-check-circle me-2"></i>Mark as Paid
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mark as Paid Modal -->
    @if ($invoice->status == 'pending')
        <div class="modal fade" id="markAsPaidModal" tabindex="-1" aria-labelledby="markAsPaidModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title" id="markAsPaidModalLabel">Confirm Payment</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.invoices.mark-as-paid', $invoice) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="paymentMethod" class="form-label">Payment Method</label>
                                <select class="form-select" id="paymentMethod" name="payment_method" required>
                                    <option value="">Select payment method</option>
                                    <option value="cash">Cash</option>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="transactionId" class="form-label">Transaction ID (if applicable)</label>
                                <input type="text" class="form-control" id="transactionId" name="transaction_id">
                            </div>
                            <div class="mb-3">
                                <label for="paymentDate" class="form-label">Payment Date</label>
                                <input type="datetime-local" class="form-control" id="paymentDate" name="payment_date"
                                    value="{{ now()->format('Y-m-d\TH:i') }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning">Confirm Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif


@endsection

@push('js')
@endpush
