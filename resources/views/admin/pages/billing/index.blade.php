@extends('admin/layouts/master')

@section('title')
    Billing Management
@endsection

@push('css')
@endpush

@section('content')
    <section>
        <h3 class="font-bold text-dark">Billing & Accounting</h3>
        <p class="text-secondary">Manage hotel invoices, payments, expenses, and financial reporting</p>
        <div class="row mt-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs border-bottom" id="financialTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="invoice-tab" data-mdb-toggle="tab" data-mdb-target="#invoice"
                            type="button" role="tab" aria-controls="invoice" aria-selected="true">Invoice
                            Generation</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="payment-tab" data-mdb-toggle="tab" data-mdb-target="#payment"
                            type="button" role="tab" aria-controls="payment" aria-selected="false">Payment
                            Processing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="expense-tab" data-mdb-toggle="tab" data-mdb-target="#expense"
                            type="button" role="tab" aria-controls="expense" aria-selected="false">Expense
                            Tracking</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reports-tab" data-mdb-toggle="tab" data-mdb-target="#reports"
                            type="button" role="tab" aria-controls="reports" aria-selected="false">Financial
                            Reports</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tax-tab" data-mdb-toggle="tab" data-mdb-target="#tax" type="button"
                            role="tab" aria-controls="tax" aria-selected="false">Tax
                            Management</button>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content mt-4">
                    <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="text-dark font-bold">All Invoices</h4>
                            {{-- <button class="btn btn-primary shadow-0" id="generateInvoiceButton">
                                <i class="fa fa-add me-1"></i>
                                <i class="fa fa-file-invoice-dollar"></i>
                            </button> --}}
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-4">
                                    <h4 class="text-dark">Recent Invoices</h4>
                                    <div class="table-responsive">
                                        {{-- success messages closed alert --}}
                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-mdb-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        {{-- error messages closed alert --}}
                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-mdb-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <table class="table w-100" id="invoicesTable">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Invoice #</th>
                                                    <th>Guest</th>
                                                    <th>Room</th>
                                                    <th>Amount</th>
                                                    <th>Issue Date</th>
                                                    <th>Due Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($invoices as $invoice)
                                                    <tr class="hover-primary">
                                                        <td>{{ $invoice->invoice_number }}</td>
                                                        <td>{{ $invoice->guest->getFullNameAttribute() }}</td>
                                                        <td>{{ $invoice->room->room_number }}</td>
                                                        <td>${{ number_format($invoice->amount, 2) }}</td>
                                                        <td>{{ $invoice->issue_date->format('M d, Y') }}</td>
                                                        <td>{{ $invoice->due_date->format('M d, Y') }}</td>
                                                        <td>
                                                            @if ($invoice->status == 'paid')
                                                                <span class="badge bg-success">Paid</span>
                                                            @elseif($invoice->status == 'pending')
                                                                <span class="badge bg-warning">Pending</span>
                                                            @else
                                                                <span class="badge bg-danger">Cancelled</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.invoices.show', $invoice) }}"
                                                                class="btn btn-light border btn-sm shadow-0">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('admin.invoices.download', $invoice) }}"
                                                                class="btn btn-light border btn-sm shadow-0">
                                                                <i class="fa fa-download"></i>
                                                            </a>
                                                            <a href="{{ route('admin.invoices.print', $invoice) }}"
                                                                class="btn btn-light border btn-sm shadow-0">
                                                                <i class="fa fa-print"></i>
                                                            </a>
                                                            @if ($invoice->status == 'pending')
                                                                <form
                                                                    action="{{ route('admin.invoices.mark-as-paid', $invoice) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-light border btn-sm shadow-0"
                                                                        onclick="return confirm('Mark this invoice as paid?')">
                                                                        <i class="fa fa-check"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="text-dark font-bold">Payment Processing</h4>
                            <button class="btn btn-primary shadow-0" data-mdb-toggle="modal"
                                data-mdb-target="#createPaymentModal">
                                <i class="fas fa-plus me-2"></i>Process New Payment
                            </button>

                        </div>
                        <div class="row mt-4">
                            <!-- Total Payments Today -->
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Total Payments Today</small>
                                    <h3 class="text-dark font-bold">${{ number_format($todayPayments, 2) }}</h3>
                                    <small
                                        class="text-secondary {{ $percentageChange >= 0 ? 'text-success' : 'text-danger' }}">
                                        <i class="fas {{ $percentageChange >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                                        {{ abs($percentageChange) }}% from yesterday
                                    </small>
                                </div>
                            </div>

                            <!-- Pending Payments -->
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Pending Payments</small>
                                    <h3 class="text-dark font-bold">${{ number_format($pendingPayments, 2) }}</h3>
                                    <small class="text-secondary">
                                        {{ $pendingCount }} transaction{{ $pendingCount != 1 ? 's' : '' }} processing
                                    </small>
                                </div>
                            </div>

                            <!-- Recent Transactions -->
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Recent Transactions</small>
                                    <h3 class="text-dark font-bold">{{ $recentTransactions }}</h3>
                                    <small class="text-secondary">In the last 24 hours</small>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-4">
                                    <h4 class="text-dark">Payment History</h4>
                                    <div class="table-responsive">
                                        <table class="table w-100" id="PaymentTable">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Guest</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Method</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($payments as $payment)
                                                    <tr class="hover-primary">
                                                        <td>{{ $payment->payment_number }}</td>
                                                        <td>{{ $payment->guest->getFullName() }}</td>
                                                        <td>${{ number_format($payment->amount, 2) }}</td>
                                                        <td>{{ $payment->payment_date->format('M d, Y') }}</td>
                                                        <td>{{ $payment->payment_method }}</td>
                                                        <td>
                                                            @if ($payment->status === 'completed')
                                                                <i class="fa-regular text-success fa-circle-check"></i>
                                                                <span>Completed</span>
                                                            @elseif($payment->status === 'pending')
                                                                <i class="fa-regular text-warning fa-clock"></i>
                                                                <span>Pending</span>
                                                            @else
                                                                <i class="fa-regular text-danger fa-circle-xmark"></i>
                                                                <span>Failed</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.payments.show', $payment->id) }}"
                                                                class="btn btn-light border btn-sm">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <button class="btn btn-light border btn-sm delete-payment"
                                                                data-mdb-toggle="modal"
                                                                data-mdb-target="#deletePaymentModal"
                                                                data-id="{{ $payment->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="expense" role="tabpanel" aria-labelledby="expense-tab">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="text-dark font-bold">Payment Processing</h4>

                            {{-- show btn modal --}}
                            <button type="button" class="btn btn-primary shadow-0" data-mdb-toggle="modal"
                                data-mdb-target="#addExpenseModal">
                                <i class="fa fa-plus me-1"></i>
                                Add New Expense
                            </button>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Total Expenses (Monthly)</small>
                                    <h3 class="text-dark font-bold">$ {{ \App\Models\Expense::sum('amount') }}</h3>
                                    <small class="text-secondary">-2.5% from last month</small>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Largest Category</small>
                                    <h3 class="text-dark font-bold">
                                        {{ \App\Models\Expense::select('category_id')->withCount('category')->orderBy('category_count', 'desc')->first()
                                            ?->category?->name ?? 'N/A' }}
                                    </h3>
                                    <small class="text-secondary">$
                                        {{ \App\Models\Expense::where(
                                            'category_id',
                                            \App\Models\Expense::select('category_id')->withCount('category')->orderBy('category_count', 'desc')->first()
                                                ?->category?->id ?? 0,
                                        )->sum('amount') }}
                                        this month</small>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Total Departments</small>
                                    <h3 class="text-dark font-bold">
                                        {{ \App\Models\Department::count() }}
                                    </h3>
                                    <small class="text-secondary">Tracking expenses</small>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-4">
                                    <h4 class="text-dark">Expenses By Department</h4>
                                    <div id="expenses-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h4 class="text-dark">Recent Expenses</h4>
                                        <button class="btn btn-outline-primary" data-mdb-toggle="modal"
                                            data-mdb-target="#manageCategoriesModal">
                                            Manage Categories
                                        </button>
                                    </div>
                                    <table class="table w-100" id="expensesTable">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Department</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expenses as $expense)
                                                <tr class="hover-primary">
                                                    <td>{{ $expense->expense_number }}</td>
                                                    <td>
                                                        <span class="border btn-rounded p-1">
                                                            {{ $expense->category->name }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $expense->description }}</td>
                                                    <td>{{ $expense->department->name }}</td>
                                                    <td>${{ number_format($expense->amount, 2) }}</td>
                                                    <td>{{ $expense->date->format('Y-m-d') }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.expenses.show', $expense) }}"
                                                            class="btn btn-light border btn-sm shadow-0">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.expenses.edit', $expense) }}"
                                                            class="btn btn-light border btn-sm shadow-0">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('admin.expenses.destroy', $expense) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-light border btn-sm shadow-0 delete-expense"
                                                                onclick="return confirm('Are you sure?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-bold text-dark">Financial Reports</h4>
                            <div class="">
                                <button class="btn btn-outline-secondary shadow-0"> <i class="fa fa-download"></i>
                                    Export</button>
                                <button class="btn btn-primary shadow-0"> <i class="fa fa-chart-line"></i> Generate
                                    Report</button>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-9 col-md-12 mt-3">
                                <!-- Tabs -->
                                <ul class="nav nav-tabs" id="expensesTab" role="tablist">
                                    <li class="nav-item border" role="presentation">
                                        <button class="nav-link active" id="daily-tab" data-mdb-toggle="tab"
                                            data-mdb-target="#daily" type="button" role="tab">Daily</button>
                                    </li>
                                    <li class="nav-item border" role="presentation">
                                        <button class="nav-link" id="weekly-tab" data-mdb-toggle="tab"
                                            data-mdb-target="#weekly" type="button" role="tab">Weekly</button>
                                    </li>
                                    <li class="nav-item border" role="presentation">
                                        <button class="nav-link" id="monthly-tab" data-mdb-toggle="tab"
                                            data-mdb-target="#monthly" type="button" role="tab">Monthly</button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content pt-3" id="expensesTabContent">
                                    <div class="tab-pane fade show active" id="daily" role="tabpanel">
                                        <div class="card shadow-0 p-3 border">
                                            <h4 class="text-dark font-bold">Revenue vs Expenses</h4>
                                            <div id="daily-line-chart"></div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="weekly" role="tabpanel">
                                        <div class="card shadow-0 p-3 border">
                                            <h4 class="text-dark font-bold">Revenue vs Expenses</h4>
                                            <div id="weekly-bar-chart"></div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="monthly" role="tabpanel"
                                        aria-labelledby="monthly-tab">
                                        <div id="monthly-chart" class="card shadow-0 p-3 border">
                                            <h4 class="text-dark font-bold mb-4">Revenue vs Expenses</h4>
                                            <div class="chart-container"
                                                style="position: relative; height:400px; width:100%">
                                                <canvas id="revenueExpensesChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 mt-3">
                                <div class="card shadow-0 p-3 border">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0">Select Date</h5>
                                        <div>
                                            <button class="btn btn-sm btn-outline-secondary prev-month"><i
                                                    class="bi bi-chevron-left"></i></button>
                                            <button class="btn btn-sm btn-outline-secondary next-month"><i
                                                    class="bi bi-chevron-right"></i></button>
                                        </div>
                                    </div>
                                    <div id="dynamic-calendar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Total Expenses (Monthly)</small>
                                    <h3 class="text-dark font-bold">$24,750.25</h3>
                                    <small class="text-secondary">-2.5% from last month</small>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Largest Category</small>
                                    <h3 class="text-dark font-bold">F&B</h3>
                                    <small class="text-secondary">$4,500 this month</small>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Total Departments</small>
                                    <h3 class="text-dark font-bold">5</h3>
                                    <small class="text-secondary">Tracking expenses</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tax" role="tabpanel" aria-labelledby="tax-tab">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="text-dark font-bold">Tax Management</h4>
                            <button class="btn btn-primary shadow-0 ">
                                <i class="fa fa-file-invoice-dollar"></i>
                                Prepare Tax Filing
                            </button>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Total Tax Filed (YTD)</small>
                                    <h3 class="text-dark font-bold">$124,750.25</h3>
                                    <small class="text-secondary">Across all tax types</small>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Pending Filings</small>
                                    <h3 class="text-dark font-bold">1</h3>
                                    <small class="text-secondary">Due within 45 days</small>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="card shadow-0 border p-3">
                                    <small class="text-secondary">Next Filing Due</small>
                                    <h3 class="text-dark font-bold">Dec 15, 2023</h3>
                                    <small class="text-secondary">Property Tax filing</small>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-4">
                                    <h4 class="text-dark">Recent Tax Filings</h4>
                                    <div class="table-responsive">
                                        <table class="table ">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Description</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="hover-primary">
                                                    <td>TAX-2023-001</td>
                                                    <td>Sales</td>
                                                    <td>Sales Tax</td>
                                                    <td>$24,350.00</td>
                                                    <td>2023-09-30</td>
                                                    <td>
                                                        <span>Filed</span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-outline-secondary">
                                                            View Details
                                                        </button>

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
    </section>

    <!-- Incluides Invoice Generation Modal -->
    @include('admin.pages.billing.partials.invoice_generation_modal')
    @include('admin.pages.billing.partials.payment_add')
    @include('admin.pages.billing.partials.payment_delete')
    @include('admin.pages.billing.expenses.expenses_add_modal')
    @include('admin.pages.billing.expenses.manage_categories_modal')
@endsection

@push('js')
    <!-- Chart Script -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- expense chart --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize chart
            var options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    name: 'Amount ($)',
                    data: []
                }],
                xaxis: {
                    categories: []
                },
                colors: ['#9370DB'],
                noData: {
                    text: 'Loading data...'
                }
            };

            var chart = new ApexCharts(document.querySelector("#expenses-chart"), options);
            chart.render();

            // Fetch data with proper error handling
            async function fetchChartData() {
                try {
                    const response = await fetch("{{ route('admin.dashboard.chart-data') }}", {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new TypeError("Response wasn't JSON");
                    }

                    const data = await response.json();

                    chart.updateOptions({
                        xaxis: {
                            categories: data.departments
                        }
                    });

                    chart.updateSeries([{
                        name: 'Amount ($)',
                        data: data.amounts
                    }]);

                } catch (error) {
                    console.error('Error:', error);
                    chart.updateOptions({
                        noData: {
                            text: 'Error loading data. Please try again.'
                        }
                    });
                }
            }

            // Initial load
            fetchChartData();
        });
    </script>
    <!-- daily chart -->
    <script>
        var dailyLineOptions = {
            chart: {
                type: 'line',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Revenue',
                data: [3000, 2500, 1800, 9900, 4200, 3900, 2300, 3300, 4000, 3100, 3300, 4200, 4300, 4300, 4900,
                    6000, 6100, 5900, 6100, 5800, 6200, 5800, 6000, 7000, 7400, 7800, 7600, 7500, 7200
                ]
            }, {
                name: 'Expenses',
                data: [2500, 2000, 3000, 10000, 4700, 3800, 3800, 4000, 4100, 4200, 4400, 4600, 4700, 4800,
                    2300, 3200, 3400, 3500, 3700, 3900, 4100, 3800, 3900, 3700, 4100, 4300, 4200, 4100, 4000
                ]
            }],
            xaxis: {
                categories: Array.from({
                    length: 29
                }, (_, i) => i + 1),
                title: {
                    text: 'Day of Month'
                }
            },
            yaxis: {
                title: {
                    text: 'Amount ($)'
                }
            },
            colors: ['#7B68EE', '#3CB371'],
            stroke: {
                curve: 'smooth',
                width: 2
            },
            markers: {
                size: 4
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(val) {
                        return `$${val}`;
                    }
                }
            },
            legend: {
                position: 'bottom'
            }
        };

        var dailyLineChart = new ApexCharts(document.querySelector("#daily-line-chart"), dailyLineOptions);
        dailyLineChart.render();
    </script>
    <!-- weekly chart -->
    <script>
        var weeklyBarOptions = {
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Revenue',
                data: [28000, 32000, 37000, 44000]
            }, {
                name: 'Expenses',
                data: [17000, 16000, 20000, 25000]
            }],
            xaxis: {
                categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4']
            },
            yaxis: {
                title: {
                    text: 'Amount ($)'
                }
            },
            colors: ['#7B68EE', '#3CB371'],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '60%',
                    borderRadius: 0
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom'
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return `$${val}`;
                    }
                }
            }
        };

        var weeklyBarChart = new ApexCharts(document.querySelector("#weekly-bar-chart"), weeklyBarOptions);
        weeklyBarChart.render();
    </script>
    <!-- monthly chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data from your screenshot
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const revenue = [0, 110000, 100, 1000, 10000, 100000, 500000, 0, 0, 0, 0, 0]; // Only Feb data available
            const expenses = [0, 75000, 1000, 10000, 100000, 500000, 0, 0, 0, 0, 20000,
                0
            ]; // Only Feb data available

            // Get the canvas element
            const ctx = document.getElementById('revenueExpensesChart').getContext('2d');

            // Create the chart
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                            label: 'Revenue',
                            data: revenue,
                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Expenses',
                            data: expenses,
                            backgroundColor: 'rgba(255, 99, 132, 0.7)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': $' + context.raw.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

            // Update chart when tab is shown (in case it's not the default active tab)
            document.getElementById('monthly-tab').addEventListener('shown.bs.tab', function() {
                chart.update();
            });
        });
    </script>
    <!-- Add these scripts after your existing scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize with current month
            let currentMonth = dayjs();

            function renderCalendar() {
                const calendarEl = document.getElementById('dynamic-calendar');
                calendarEl.innerHTML = '';

                // Create month header
                const monthHeader = document.createElement('div');
                monthHeader.className = 'text-center fw-bold mb-2';
                monthHeader.textContent = currentMonth.format('MMMM YYYY');
                calendarEl.appendChild(monthHeader);

                // Create day names header
                const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                const dayNamesRow = document.createElement('div');
                dayNamesRow.className = 'd-flex text-center small text-muted mb-2';

                dayNames.forEach(day => {
                    const dayEl = document.createElement('div');
                    dayEl.className = 'flex-grow-1';
                    dayEl.textContent = day;
                    dayNamesRow.appendChild(dayEl);
                });
                calendarEl.appendChild(dayNamesRow);

                // Calculate days to show
                const startOfMonth = currentMonth.startOf('month');
                const endOfMonth = currentMonth.endOf('month');
                const startDay = startOfMonth.day();
                const daysInMonth = endOfMonth.date();

                // Create calendar grid
                const grid = document.createElement('div');
                grid.className = 'calendar-grid';

                // Add empty cells for days before start of month
                for (let i = 0; i < startDay; i++) {
                    const emptyCell = document.createElement('div');
                    emptyCell.className = 'calendar-day empty';
                    grid.appendChild(emptyCell);
                }

                // Add cells for each day of month
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayCell = document.createElement('div');
                    dayCell.className = 'calendar-day';

                    // Highlight current day
                    const isToday = currentMonth.date(day).isSame(dayjs(), 'day');
                    if (isToday) {
                        dayCell.classList.add('today');
                    }

                    dayCell.innerHTML = `
                         <div class="day-number">${day}</div>
                         <div class="events"></div>
                     `;
                    grid.appendChild(dayCell);
                }

                calendarEl.appendChild(grid);

                // Add some basic styling
                const style = document.createElement('style');
                style.textContent = `
                     .calendar-grid {
                         display: grid;
                         grid-template-columns: repeat(7, 1fr);
                         gap: 4px;
                     }
                     .calendar-day {
                         aspect-ratio: 1;
                         padding: 4px;
                         border-radius: 4px;
                         background: #f8f9fa;
                         display: flex;
                         flex-direction: column;
                     }
                     .calendar-day.empty {
                         background: transparent;
                     }
                     .calendar-day.today {
                         background: #e7f5ff;
                         font-weight: bold;
                     }
                     .calendar-day .day-number {
                         text-align: right;
                     }
                     .calendar-day .events {
                         flex-grow: 1;
                         font-size: 0.7rem;
                         overflow: hidden;
                     }
                 `;
                calendarEl.appendChild(style);
            }

            // Navigation buttons
            document.querySelector('.prev-month').addEventListener('click', function() {
                currentMonth = currentMonth.subtract(1, 'month');
                renderCalendar();
            });

            document.querySelector('.next-month').addEventListener('click', function() {
                currentMonth = currentMonth.add(1, 'month');
                renderCalendar();
            });

            // Initial render
            renderCalendar();
        });
    </script>
@endpush

@push('js')
    <script>
        $("#generateInvoiceButton").click(function() {
            $("#invoiceModal").modal('show');
        });

        new DataTable("#invoicesTable");
        new DataTable("#PaymentTable");
        new DataTable("#expensesTable");
    </script>
@endpush

{{-- payment --}}

@push('js')
    <script>
        $(document).ready(function() {
            // Delete modal handler
            $('.delete-payment').click(function() {
                const paymentId = $(this).data('id');
                const form = $('#deletePaymentForm');
                form.attr('action', `/admin/payments/${paymentId}`);
            });

            // Guest-Invoice relationship
            $('#guest_id').change(function() {
                const guestId = $(this).val();
                $('#invoice_id option').hide();
                $('#invoice_id option[value=""]').show();
                $('#invoice_id option[data-guest="' + guestId + '"]').show();
                $('#invoice_id').val('');
            });

            // Auto-fill amount when invoice is selected
            $('#invoice_id').change(function() {
                const invoiceId = $(this).val();
                if (invoiceId) {
                    $.get(`/invoices/${invoiceId}/amount`, function(data) {
                        $('#amount').val(data.amount);
                    });
                }
            });
        });
    </script>
@endpush
