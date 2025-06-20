@extends('admin/layouts/master')

@section('title')
    Reports & analysis
@endsection

@push('css')
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush

@section('content')
    <h3 class="font-bold text-dark">Reports & Analytics</h3>
    <p class="text-secondary">Analyze hotel performance through comprehensive reports and data visualization</p>

    <div class="row mt-4">
        <div class="col-12">
            <ul class="nav nav-tabs border-bottom" id="reportTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="occupancy-tab" data-mdb-toggle="tab" data-mdb-target="#occupancy"
                        type="button" role="tab" aria-controls="occupancy" aria-selected="true">
                        <i class="fas fa-bed me-2"></i>Occupancy Reports
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="revenue-tab" data-mdb-toggle="tab" data-mdb-target="#revenue"
                        type="button" role="tab" aria-controls="revenue" aria-selected="false">
                        <i class="fas fa-dollar-sign me-2"></i>Revenue Analysis
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="demographics-tab" data-mdb-toggle="tab" data-mdb-target="#demographics"
                        type="button" role="tab" aria-controls="demographics" aria-selected="false">
                        <i class="fas fa-users me-2"></i>Guest Demographics
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="performance-tab" data-mdb-toggle="tab" data-mdb-target="#performance"
                        type="button" role="tab" aria-controls="performance" aria-selected="false">
                        <i class="fas fa-chart-bar me-2"></i>Performance Metrics
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="custom-tab" data-mdb-toggle="tab" data-mdb-target="#custom" type="button"
                        role="tab" aria-controls="custom" aria-selected="false">
                        <i class="fas fa-file-alt me-2"></i>Custom Reports
                    </button>
                </li>
            </ul>

            <div class="tab-content py-3" id="reportTabsContent">
                <div class="tab-pane fade show active" id="occupancy" role="tabpanel" aria-labelledby="occupancy-tab">
                    <div class="container-fluid p-0">
                        <div class="d-flex align-item-center justify-content-between">
                            <h4 class="font-bold text-dark">Occupancy Reports</h4>
                            <div class="d-flex align-item-center justify-content-center gap-2">
                                <button class="btn btn-outline-secondary rounded-2">
                                    <i class="fa fa-calendar-alt"></i> Data Range
                                </button>
                                <button class="btn btn-outline-secondary rounded-2">
                                    <i class="fa fa-download"></i> Export
                                </button>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card p-3 shadow-0 border shadow-1">
                                    <p class="text-secondary">Current Occupancy</p>
                                    <h3 class="text-dark font-bold">85%</h3>
                                    <small class="text-secondary">+8% from last month</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card p-3 shadow-0 border shadow-1">
                                    <p class="text-secondary">Average Length of Stay</p>
                                    <h3 class="text-dark font-bold">3.2 nights</h3>
                                    <small class="text-secondary">+0.4 from last month</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card p-3 shadow-0 border shadow-1">
                                    <p class="text-secondary">Highest Occupancy Day</p>
                                    <h3 class="text-dark font-bold">Saturday</h3>
                                    <small class="text-secondary">95% average occupancy</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <div class="card shadow-0 p-3 border shadow-1">
                                <h4 class="text-dark">Monthly Occupancy Trend</h4>
                                <canvas id="occupancyChart" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mt-2">
                            <div class="card shadow-0 border p-3">
                                <h4 class="text-dark">Occupancy by Day of Week</h4>
                                <canvas id="dailyOccupancyChart" height="250"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="card shadow-0 border p-3">
                                <h4 class="text-dark">Occupancy by Room Type</h4>
                                <canvas id="roomTypeChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="revenue" role="tabpanel" aria-labelledby="revenue-tab">
                    <div class="container-fluid p-0">
                        <div class="d-flex align-item-center justify-content-between">
                            <h4 class="font-bold text-dark">Revenue Analysis</h4>
                            <div class="d-flex align-item-center justify-content-center gap-2">
                                <button class="btn btn-outline-secondary rounded-2">
                                    <i class="fa fa-download"></i> Export Data
                                </button>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card p-3 shadow-0 border shadow-1">
                                    <p class="text-secondary">Total Revenue (YTD)</p>
                                    <h3 class="text-dark font-bold">$1,840,000</h3>
                                    <small class="text-secondary">+12% from last year</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card p-3 shadow-0 border shadow-1">
                                    <p class="text-secondary">RevPAR</p>
                                    <h3 class="text-dark font-bold">$145.50</h3>
                                    <small class="text-secondary">+8.5% from last year</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card p-3 shadow-0 border shadow-1">
                                    <p class="text-secondary">Best Performing Month</p>
                                    <h3 class="text-dark font-bold">July</h3>
                                    <small class="text-secondary">$190,000 revenue</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <div class="card shadow-0 p-3 border shadow-1">
                                <h4 class="text-dark">Monthly Revenue Trend</h4>
                                <canvas id="revenueChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6 col-md-12 mt-2">
                            <div class="card shadow-0 border p-3">
                                <h4 class="text-dark">Revenue by Room Type</h4>
                                <canvas id="revenueByRoomChart" height="150"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 mt-2">
                            <div class="card shadow-0 border p-3">
                                <h4 class="text-dark">Revenue Sources</h4>
                                <div class="chart-container" style="position: relative; height:290px; width:100%">
                                    <canvas id="revenueSourcesChart"></canvas>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card shadow-1 border p-3">
                                <h4 class="text-dark">Key Revenue Metrics</h4>
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 mt-2">
                                        <div class="card shad shadow-0 bg-light p-3 border">
                                            <small class="text-secondary">Average Daily Rate</small>
                                            <h6 class="font-bold text text-dark">$189.75</h6>
                                            <small class="text-secondary">+$12.50 from last year</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-2">
                                        <div class="card shad shadow-0 bg-light p-3 border">
                                            <small class="text-secondary">Revenue per Available Room</small>
                                            <h6 class="font-bold text text-dark">$145.50</h6>
                                            <small class="text-secondary">+8.5% from last year</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-2">
                                        <div class="card shad shadow-0 bg-light p-3 border">
                                            <small class="text-secondary">Food & Beverage per Guest</small>
                                            <h6 class="font-bold text text-dark">$42.25</h6>
                                            <small class="text-secondary">+4.8% from last year</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-2">
                                        <div class="card shad shadow-0 bg-light p-3 border">
                                            <small class="text-secondary">TRevPAR</small>
                                            <h6 class="font-bold text text-dark">$182.90</h6>
                                            <small class="text-secondary">+7.2% from last year</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="demographics" role="tabpanel" aria-labelledby="demographics-tab">
                    <div class="container-fluid p-0">
                        <div class="d-flex align-item-center justify-content-between">
                            <h4 class="font-bold text-dark">Guest Demographics</h4>
                            <div class="d-flex align-item-center justify-content-center gap-2">
                                <button class="btn btn-outline-secondary rounded-2">
                                    <i class="fa fa-download"></i> Export Data
                                </button>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6 mt-1">
                                <div class="card shadow-0 border p-3">
                                    <h4 class="text-dark">Guest Age Distribution</h4>
                                    <div class="chart-container" style="position: relative; height:300px;">
                                        <canvas id="ageDistributionChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="card shadow-0 border p-3">
                                    <h4 class="text-dark">Purpose of Stay</h4>
                                    <div class="chart-container" style="position: relative; height:300px;">
                                        <canvas id="purposeOfStayChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md">
                                <div class="card shadow-1 border p-3">
                                    <h4 class="text-dark">Guest Origin by Country</h4>
                                    <div class="chart-container" style="position: relative; height:350px;">
                                        <canvas id="guestOriginChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6 mt-1">
                                <div class="card shadow-0 border p-3">
                                    <h4 class="text-dark">Loyalty Program Distribution</h4>
                                    <div class="chart-container" style="position: relative; height:300px;">
                                        <canvas id="loyaltyChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="card shadow-0 border p-3">
                                    <h4 class="text-dark">Key Demographics</h4>
                                    <div
                                        class="border-bottom p-2 hover-primary d-flex align-item-center justify-content-between">
                                        <span class="font-bold text-dark">Metric </span>
                                        <span class="font-bold text-dark">Value </span>
                                    </div>
                                    <div
                                        class="border-bottom p-2 hover-primary d-flex align-item-center justify-content-between">
                                        <span class="text-dark">Average Age</span>
                                        <span class="text-dark">38.5 years</span>
                                    </div>
                                    <div
                                        class="border-bottom p-2 hover-primary d-flex align-item-center justify-content-between">
                                        <span class="text-dark"> Percentage of Business Travelers</span>
                                        <span class="text-dark"> 45%</span>
                                    </div>
                                    <div
                                        class="border-bottom p-2 hover-primary d-flex align-item-center justify-content-between">
                                        <span class="text-dark">Percentage of International Guests </span>
                                        <span class="text-dark"> 32%</span>
                                    </div>
                                    <div
                                        class="border-bottom p-2 hover-primary d-flex align-item-center justify-content-between">
                                        <span class="text-dark"> Percentage in Loyalty Program</span>
                                        <span class="text-dark">45% </span>
                                    </div>
                                    <div
                                        class="border-bottom p-2 hover-primary d-flex align-item-center justify-content-between">
                                        <span class="text-dark"> Average Group Size</span>
                                        <span class="text-dark">2.3 persons</span>
                                    </div>
                                    <div class=" p-2 hover-primary d-flex align-item-center justify-content-between">
                                        <span class="text-dark"> Average Length of Stay </span>
                                        <span class="text-dark">3.2 nights</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="performance" role="tabpanel" aria-labelledby="performance-tab">
                    <div class="container-fluid p-0">
                        <div class="d-flex align-item-center justify-content-between">
                            <h4 class="font-bold text-dark">Performance Metrics</h4>
                            <div class="d-flex align-item-center justify-content-center gap-2">
                                <button class="btn btn-outline-secondary rounded-2">
                                    <i class="fa fa-download"></i> Export Report
                                </button>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card p-3 shadow-0 border shadow-1">
                                    <p class="text-secondary">Occupancy Rate (Current)</p>
                                    <h3 class="text-dark font-bold">85%</h3>
                                    <small class="text-secondary">+7% from previous period</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card p-3 shadow-0 border shadow-1">
                                    <p class="text-secondary">RevPAR (Current)</p>
                                    <h3 class="text-dark font-bold">$145.50</h3>
                                    <small class="text-secondary">+6.4% from previous period</small>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card p-3 shadow-0 border shadow-1">
                                    <p class="text-secondary">Guest Satisfaction Score</p>
                                    <h3 class="text-dark font-bold">4.7/5.0</h3>
                                    <small class="text-secondary">+0.3 from previous period</small>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card shadow-0 border p-4">
                                    <h4 class="text-dark">Key Performance Metrics Comparison</h4>
                                    <div class="table-responsive">
                                        <table class="table ">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Metric</th>
                                                    <th>Current</th>
                                                    <th>Previous</th>
                                                    <th>Change</th>
                                                    <th>Industry Average</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!--  			 -->
                                                <tr class="hover-primary">
                                                    <td>Occupancy</td>
                                                    <td>85%</td>
                                                    <td>78%</td>
                                                    <td>+9.0%</td>
                                                    <td>75%</td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <!-- Tab Navigation -->
                                <ul class="nav nav-tabs mb-4" id="analyticsTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="trends-tab" data-mdb-toggle="tab"
                                            data-mdb-target="#trends" type="button" role="tab"
                                            aria-controls="trends" aria-selected="true">
                                            Monthly Trends
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="competition-tab" data-mdb-toggle="tab"
                                            data-mdb-target="#competition" type="button" role="tab"
                                            aria-controls="competition" aria-selected="false">
                                            Competition Comparison
                                        </button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content" id="analyticsTabsContent">
                                    <div class="tab-pane fade show active" id="trends" role="tabpanel"
                                        aria-labelledby="trends-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card p-3 shadow-1 border">
                                                    <h4 class="text-dark mb-4">Monthly Performance Trends</h4>
                                                    <canvas id="performanceTrendsChart" height="100"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="competition" role="tabpanel"
                                        aria-labelledby="competition-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card p-3 shadow-1 border">
                                                    <h4 class="text-dark mb-4">Competitive Performance Analysis</h4>
                                                    <div class="" style="height:400px;">
                                                        <canvas id="competitiveAnalysisChart"></canvas>

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

                <div class="tab-pane fade" id="custom" role="tabpanel" aria-labelledby="custom-tab">
                    <div class="container-fluid p-0">
                        <div class="d-flex align-item-center justify-content-between">
                            <h4 class="font-bold text-dark">Performance Metrics</h4>
                            <div class="d-flex align-item-center justify-content-center gap-2">
                                <button class="btn btn-outline-secondary">
                                    <i class="fa fa-cog"></i> Configure Templates
                                </button>
                                <button class="btn btn-primary shadow-0">
                                    <i class="fa fa-file"></i> Generate Report
                                </button>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-4 col-md-12">
                                <div class="card shadow-1 border p-3 mt-1">
                                    <h4 class="text-dark">Report Configuration</h4>
                                    <div class="mt-3">
                                        <label for="">Report Name</label>
                                        <input class="form-control p-2 bg-light" type="text" name=""
                                            id="">
                                    </div>
                                    <div class="mt-3">
                                        <label for="">Date Range</label>
                                        <div class="row mt-3">
                                            <div class="col-lg-6 col-md-12">
                                                <label class="text-secondary" for="start_date">Start Date</label>
                                                <input type="text" id="start_date" class="form-control"
                                                    placeholder="Select start date">
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <label class="text-secondary" for="end_date">End Date</label>
                                                <input type="text" id="end_date" class="form-control"
                                                    placeholder="Select end date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h5>Data Metrics</h5>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="revenue" checked>
                                            <label class="form-check-label" for="revenue">Revenue</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="occupancy" checked>
                                            <label class="form-check-label" for="occupancy">Occupancy</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="adr" checked>
                                            <label class="form-check-label" for="adr">ADR</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="revpar" checked>
                                            <label class="form-check-label" for="revpar">RevPAR</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="expenses" checked>
                                            <label class="form-check-label" for="expenses">Expenses</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="profit">
                                            <label class="form-check-label" for="profit">Profit</label>
                                        </div>

                                        <h5 class="mt-4">Report Format</h5>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="tables">
                                            <label class="form-check-label" for="tables">Tables</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="charts">
                                            <label class="form-check-label" for="charts">Charts</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="executive_summary">
                                            <label class="form-check-label" for="executive_summary">Executive
                                                Summary</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="card shadow-1 border p-3">
                                        <h4 class="text-dark"> Saved Reports</h4>
                                        <div class="mt-2 d-flex align-item-center justify-content-between">
                                            <p>Monthly Revenue (Oct 2023)</p>
                                            <button class="btn btn-light p-3" type="button">
                                                <i class="fa fa-download"></i>
                                            </button>
                                        </div>
                                        <div class="mt-2 d-flex align-item-center justify-content-between">
                                            <p>Q3 Performance Summary</p>
                                            <button class="btn btn-light p-3" type="button">
                                                <i class="fa fa-download"></i>
                                            </button>
                                        </div>
                                        <div class="mt-2 d-flex align-item-center justify-content-between">
                                            <p>YTD Occupancy Analysis</p>
                                            <button class="btn btn-light p-3" type="button">
                                                <i class="fa fa-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <div class="card shadow-1 border p-3 mt-1">
                                    <h4 class="text-dark">Report Preview</h4>
                                    <div class="chart-container" style="position: relative; height:300px;">
                                        <canvas id="revenueBreakdownChart"></canvas>
                                    </div>
                                </div>
                                <div class="card mt-3 p-3 shadow-0 border">
                                    <h4 class="text-dark">Data Summary</h4>
                                    <div class="table-responsive">
                                        <table class="table ">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Metric</th>
                                                    <th>Value</th>
                                                    <th>Change (YoY)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="hover-primary">
                                                    <td>Total Revenue</td>
                                                    <td>$251,000</td>
                                                    <td>+8.5% </td>
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
@endsection

@push('js')
    <!-- Add Chart.js library (include this in your head or before closing body tag) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include chartjs-plugin-datalabels for percentage labels -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <!-- Include chartjs-plugin-datalabels for percentage labels -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <!-- Include chartjs-plugin-datalabels for percentage labels -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <!-- Include chartjs-plugin-datalabels for percentage labels -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('occupancyChart').getContext('2d');
            const occupancyChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                    datasets: [{
                        label: 'Occupancy Rate (%)',
                        data: [65, 59, 80, 81, 56, 55, 40, 50, 60, 70, 75,
                        85], // Replace with your actual data
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            title: {
                                display: true,
                                text: 'Occupancy Rate (%)'
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dailyCtx = document.getElementById('dailyOccupancyChart').getContext('2d');
            const dailyOccupancyChart = new Chart(dailyCtx, {
                type: 'bar',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Occupancy Rate (%)',
                        data: [65, 70, 75, 80, 85, 60, 50], // Replace with your actual data
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                            'rgba(255, 159, 64, 0.7)',
                            'rgba(199, 199, 199, 0.7)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(199, 199, 199, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false // Hide legend as we only have one dataset
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + '%';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            },
                            title: {
                                display: true,
                                text: 'Occupancy Rate'
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('roomTypeChart').getContext('2d');
            const roomTypeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Standard', 'Deluxe', 'Suite', 'Executive', 'Penthouse'],
                    datasets: [{
                        label: 'Occupancy Rate (%)',
                        data: [65, 75, 85, 60, 45], // Replace with your actual data
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                            'rgba(255, 159, 64, 0.7)',
                            'rgba(255, 99, 132, 0.7)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + '%';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                stepSize: 25,
                                callback: function(value) {
                                    return value + '%';
                                }
                            },
                            title: {
                                display: true,
                                text: 'Occupancy Rate'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                    datasets: [{
                        label: 'Revenue ($)',
                        data: [120000, 135000, 150000, 165000, 180000, 175000, 190000, 185000,
                            200000, 210000, 220000, 230000
                        ], // Replace with your actual data
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Revenue: $' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            },
                            title: {
                                display: true,
                                text: 'Revenue ($)'
                            },
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    elements: {
                        line: {
                            cubicInterpolationMode: 'monotone'
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueByRoomChart').getContext('2d');
            const revenueByRoomChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Standard', 'Deluxe', 'Suite', 'Executive', 'Penthouse'],
                    datasets: [{
                        label: 'Revenue ($)',
                        data: [120000, 180000, 220000, 280000,
                        320000], // Sample data including $280k for Executive
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.7)', // Standard - Blue
                            'rgba(75, 192, 192, 0.7)', // Deluxe - Teal
                            'rgba(153, 102, 255, 0.7)', // Suite - Purple
                            'rgba(255, 159, 64, 0.7)', // Executive - Orange
                            'rgba(255, 99, 132, 0.7)' // Penthouse - Red
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return '$' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + (value / 1000) + 'k'; // Formats as $280k
                                }
                            },
                            title: {
                                display: true,
                                text: 'Revenue ($)'
                            },
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 1000
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueSourcesChart').getContext('2d');
            const revenueSourcesChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Room Sales', 'Food & Beverage', 'Events & Conferences', 'Spa & Wellness',
                        'Other'
                    ],
                    datasets: [{
                        data: [65, 20, 10, 3, 2],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.7)', // Room Sales - Blue
                            'rgba(75, 192, 192, 0.7)', // Food & Beverage - Teal
                            'rgba(255, 159, 64, 0.7)', // Events - Orange
                            'rgba(153, 102, 255, 0.7)', // Spa - Purple
                            'rgba(201, 203, 207, 0.7)' // Other - Gray
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(201, 203, 207, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${percentage}% ($${(value / 100 * total).toLocaleString()})`;
                                }
                            }
                        },
                        datalabels: {
                            formatter: (value) => {
                                return value + '%';
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    cutout: '0%', // Makes it a donut chart (set to 0 for regular pie)
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('ageDistributionChart').getContext('2d');
            const ageDistributionChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['18-24', '25-34', '35-44', '45-54', '55-64', '65+'],
                    datasets: [{
                        data: [10, 25, 30, 20, 10, 5],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.8)', // 18-24
                            'rgba(75, 192, 192, 0.8)', // 25-34
                            'rgba(255, 159, 64, 0.8)', // 35-44
                            'rgba(153, 102, 255, 0.8)', // 45-54
                            'rgba(255, 99, 132, 0.8)', // 55-64
                            'rgba(201, 203, 207, 0.8)' // 65+
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 12,
                                padding: 20,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}%`;
                                }
                            }
                        },
                        datalabels: {
                            color: '#fff',
                            font: {
                                weight: 'bold',
                                size: 12
                            },
                            formatter: (value) => {
                                return value > 5 ? value + '%' : '';
                            }
                        }
                    },
                    cutout: '0%',
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('purposeOfStayChart').getContext('2d');
            const purposeOfStayChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Business', 'Leisure', 'Events', 'Other'],
                    datasets: [{
                        data: [45, 40, 10, 5],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.8)', // Business - Blue
                            'rgba(75, 192, 192, 0.8)', // Leisure - Teal
                            'rgba(255, 159, 64, 0.8)', // Events - Orange
                            'rgba(201, 203, 207, 0.8)' // Other - Gray
                        ],
                        borderColor: '#fff',
                        borderWidth: 2,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 12,
                                padding: 15,
                                font: {
                                    size: 12
                                },
                                generateLabels: function(chart) {
                                    const data = chart.data;
                                    return data.labels.map((label, i) => ({
                                        text: `${label} (${data.datasets[0].data[i]}%)`,
                                        fillStyle: data.datasets[0].backgroundColor[i],
                                        strokeStyle: data.datasets[0].borderColor,
                                        lineWidth: data.datasets[0].borderWidth,
                                        hidden: false,
                                        index: i
                                    }));
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}%`;
                                }
                            }
                        },
                        datalabels: {
                            color: '#fff',
                            font: {
                                weight: 'bold',
                                size: 12
                            },
                            formatter: (value) => {
                                return value > 5 ? value + '%' : '';
                            }
                        }
                    },
                    cutout: '0%',
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('guestOriginChart').getContext('2d');
            const guestOriginChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['United States', 'Canada', 'United Kingdom', 'Germany', 'France', 'Japan',
                        'Australia', 'China'
                    ],
                    datasets: [{
                        label: 'Number of Guests',
                        data: [1200, 900, 800, 600, 500, 400, 350,
                        300], // Sample data - replace with actual numbers
                        backgroundColor: 'rgba(54, 162, 235, 1)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 4 // Rounded bar corners
                    }]
                },
                options: {
                    indexAxis: 'y', // Makes chart horizontal
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.parsed.x} guests`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 300,
                                callback: function(value) {
                                    return value;
                                }
                            },
                            title: {
                                display: true,
                                text: 'Number of Guests'
                            },
                            grid: {
                                drawBorder: false
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 1000
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('loyaltyChart').getContext('2d');
            const loyaltyChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['New Guests', 'Returning (Non-member)', 'Silver', 'Gold', 'Platinum'],
                    datasets: [{
                        data: [35, 20, 25, 15,
                        5], // Includes estimated 20% for Returning (Non-member)
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.8)', // New Guests - Blue
                            'rgba(201, 203, 207, 0.8)', // Returning - Gray
                            'rgba(192, 192, 192, 0.8)', // Silver - Light Gray
                            'rgba(255, 215, 0, 0.8)', // Gold - Gold
                            'rgba(229, 228, 226, 0.8)' // Platinum - Platinum
                        ],
                        borderColor: '#fff',
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 12,
                                padding: 15,
                                font: {
                                    size: 12
                                },
                                generateLabels: function(chart) {
                                    const data = chart.data;
                                    return data.labels.map((label, i) => ({
                                        text: `${label} (${data.datasets[0].data[i]}%)`,
                                        fillStyle: data.datasets[0].backgroundColor[i],
                                        strokeStyle: data.datasets[0].borderColor,
                                        lineWidth: data.datasets[0].borderWidth,
                                        hidden: false,
                                        index: i
                                    }));
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}%`;
                                }
                            }
                        },
                        datalabels: {
                            color: '#333',
                            font: {
                                weight: 'bold',
                                size: 11
                            },
                            formatter: (value) => {
                                return value > 5 ? value + '%' : '';
                            }
                        }
                    },
                    cutout: '0%',
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('performanceTrendsChart').getContext('2d');
            const performanceTrendsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                    datasets: [{
                            label: 'Occupancy (%)',
                            data: [72, 78, 75, 80, 82, 85, 88, 86, 83, 80, 78, 85],
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            yAxisID: 'y'
                        },
                        {
                            label: 'ADR ($)',
                            data: [150.50, 168.75, 165.20, 172.30, 175.00, 180.50, 185.25, 182.75,
                                178.50, 175.25, 170.00, 182.50
                            ],
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            yAxisID: 'y1'
                        },
                        {
                            label: 'RevPAR ($)',
                            data: [108.36, 131.63, 123.90, 137.84, 143.50, 153.43, 163.02, 157.17,
                                148.16, 140.20, 132.60, 155.13
                            ],
                            borderColor: 'rgba(255, 159, 64, 1)',
                            backgroundColor: 'rgba(255, 159, 64, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        if (label.includes('ADR') || label.includes('RevPAR')) {
                                            label += '$' + context.parsed.y.toFixed(2);
                                        } else {
                                            label += context.parsed.y + '%';
                                        }
                                    }
                                    return label;
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 20
                            }
                        }
                    },
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Occupancy (%)'
                            },
                            min: 50,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Amount ($)'
                            },
                            grid: {
                                drawOnChartArea: false
                            },
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toFixed(2);
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('competitiveAnalysisChart').getContext('2d');
            const competitiveAnalysisChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: [
                        'Cost Control',
                        'Staff Efficiency',
                        'ADR',
                        'RevPAR',
                        'Guest Satisfaction',
                        'Occupancy'
                    ],
                    datasets: [{
                            label: 'Our Property',
                            data: [85, 90, 82, 78, 88, 80],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                            pointRadius: 4
                        },
                        {
                            label: 'Competitors',
                            data: [75, 80, 85, 80, 82, 85],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                            pointRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.raw + '/100';
                                }
                            }
                        }
                    },
                    scales: {
                        r: {
                            angleLines: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            suggestedMin: 0,
                            suggestedMax: 100,
                            ticks: {
                                stepSize: 20,
                                backdropColor: 'transparent'
                            },
                            pointLabels: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    elements: {
                        line: {
                            tension: 0.1
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueBreakdownChart').getContext('2d');
            const revenueBreakdownChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Room Revenue', 'F&B Revenue', 'Event Revenue', 'Spa Revenue',
                        'Other Revenue'],
                    datasets: [{
                        label: 'Revenue ($)',
                        data: [145000, 65000, 40000, 25000, 15000], // Sample data matching scale
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.7)', // Room
                            'rgba(75, 192, 192, 0.7)', // F&B
                            'rgba(255, 159, 64, 0.7)', // Event
                            'rgba(153, 102, 255, 0.7)', // Spa
                            'rgba(201, 203, 207, 0.7)' // Other
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(201, 203, 207, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return '$' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 160000,
                            ticks: {
                                stepSize: 40000,
                                callback: function(value) {
                                    return value === 0 ? '0' : '$' + (value / 1000) + 'k';
                                }
                            },
                            title: {
                                display: true,
                                text: 'Revenue ($)'
                            },
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                endPicker.set('minDate', dateStr); // Restrict end date to not be before start date
            }
        });

        const endPicker = flatpickr("#end_date", {
            dateFormat: "Y-m-d"
        });
    </script>
@endpush
