<x-layouts.app :title="__('Analytics Dashboard')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .analytics-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .analytics-card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background: linear-gradient(90deg, #262626, #404040);
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #262626;
            margin: 2rem 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }
    </style>

    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">📊 Analytics Dashboard</h1>
                        <p class="text-muted mb-0">Comprehensive insights from research form data</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('form.record') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i>View Records
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $businessTypeStats->sum('count') }}</div>
                    <div class="stats-label">Total Submissions</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="stats-number">{{ $ecommerceStats->enrolled ?? 0 }}</div>
                    <div class="stats-label">E-commerce Enabled</div>
                    <small>{{ $ecommercePercentage }}%</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="stats-number">{{ $quickCommerceStats->willing_to_partner ?? 0 }}</div>
                    <div class="stats-label">Willing to Partner</div>
                    <small>{{ $quickCommercePercentage }}%</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                    <div class="stats-number">{{ $consumerWillingness->willing ?? 0 }}</div>
                    <div class="stats-label">Consumers Interested</div>
                    <small>{{ $consumerWillingnessPercentage }}%</small>
                </div>
            </div>
        </div>

        <!-- Show message if no data -->
        @if($businessTypeStats->sum('count') == 0)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        No data available yet. Start by submitting some research forms to see analytics.
                    </div>
                </div>
            </div>
        @else
            <!-- Charts Grid -->
            <div class="row">
                <!-- Business Type Distribution -->
                <div class="col-lg-6 mb-4">
                    <div class="card analytics-card">
                        <div class="card-header text-white">
                            <h5 class="mb-0"><i class="fas fa-store me-2"></i>Business Type Distribution</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="businessTypeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- E-commerce Enrollment -->
                <div class="col-lg-6 mb-4">
                    <div class="card analytics-card">
                        <div class="card-header text-white">
                            <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>E-commerce Enrollment</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="ecommerceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Commerce Awareness -->
                <div class="col-lg-6 mb-4">
                    <div class="card analytics-card">
                        <div class="card-header text-white">
                            <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Commerce Awareness</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="quickCommerceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Submissions -->
                <div class="col-lg-6 mb-4">
                    <div class="card analytics-card">
                        <div class="card-header text-white">
                            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Submission Trends (Last 6 Months)</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="monthlySubmissionsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shop Type Distribution -->
                @if($shopTypeStats->count() > 0)
                <div class="col-lg-6 mb-4">
                    <div class="card analytics-card">
                        <div class="card-header text-white">
                            <h5 class="mb-0"><i class="fas fa-building me-2"></i>Shop Type Distribution</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="shopTypeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Consumer Willingness -->
                @if($consumerWillingness && $consumerWillingness->total > 0)
                <div class="col-lg-6 mb-4">
                    <div class="card analytics-card">
                        <div class="card-header text-white">
                            <h5 class="mb-0"><i class="fas fa-users me-2"></i>Consumer Quick Commerce Willingness</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="consumerWillingnessChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- User Submission Stats -->
            @if($userStats->count() > 0)
            <div class="row">
                <div class="col-12">
                    <div class="card analytics-card">
                        <div class="card-header text-white">
                            <h5 class="mb-0"><i class="fas fa-user-chart me-2"></i>User Submission Statistics</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="userStatsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endif
    </div>

    @if($businessTypeStats->sum('count') > 0)
    <script>
        // Business Type Chart
        const businessTypeCtx = document.getElementById('businessTypeChart').getContext('2d');
        new Chart(businessTypeCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($businessTypeStats->pluck('business_type')) !!},
                datasets: [{
                    data: {!! json_encode($businessTypeStats->pluck('count')) !!},
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
                        '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });

        // E-commerce Enrollment Chart
        const ecommerceCtx = document.getElementById('ecommerceChart').getContext('2d');
        new Chart(ecommerceCtx, {
            type: 'pie',
            data: {
                labels: ['Enrolled', 'Not Enrolled'],
                datasets: [{
                    data: [
                        {{ $ecommerceStats->enrolled ?? 0 }},
                        {{ $ecommerceStats->not_enrolled ?? 0 }}
                    ],
                    backgroundColor: ['#4BC0C0', '#FF6384']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Quick Commerce Chart
        const quickCommerceCtx = document.getElementById('quickCommerceChart').getContext('2d');
        new Chart(quickCommerceCtx, {
            type: 'bar',
            data: {
                labels: ['Aware', 'Participating', 'Willing to Partner'],
                datasets: [{
                    label: 'Number of Shops',
                    data: [
                        {{ $quickCommerceStats->aware ?? 0 }},
                        {{ $quickCommerceStats->participating ?? 0 }},
                        {{ $quickCommerceStats->willing_to_partner ?? 0 }}
                    ],
                    backgroundColor: ['#36A2EB', '#FFCE56', '#4BC0C0']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Monthly Submissions Chart
        const monthlyCtx = document.getElementById('monthlySubmissionsChart').getContext('2d');
        const months = {!! json_encode($monthlySubmissions->map(function($item) {
            return date('M Y', mktime(0, 0, 0, $item->month, 1, $item->year));
        })) !!};
        
        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Submissions',
                    data: {!! json_encode($monthlySubmissions->pluck('count')) !!},
                    borderColor: '#FF6384',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Shop Type Chart
        @if($shopTypeStats->count() > 0)
        const shopTypeCtx = document.getElementById('shopTypeChart').getContext('2d');
        new Chart(shopTypeCtx, {
            type: 'polarArea',
            data: {
                labels: {!! json_encode($shopTypeStats->pluck('shop_type')) !!},
                datasets: [{
                    data: {!! json_encode($shopTypeStats->pluck('count')) !!},
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
                        '#9966FF', '#FF9F40', '#FF6384'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        @endif

        // Consumer Willingness Chart
        @if($consumerWillingness && $consumerWillingness->total > 0)
        const consumerCtx = document.getElementById('consumerWillingnessChart').getContext('2d');
        new Chart(consumerCtx, {
            type: 'doughnut',
            data: {
                labels: ['Willing to Use', 'Not Willing'],
                datasets: [{
                    data: [
                        {{ $consumerWillingness->willing ?? 0 }},
                        {{ $consumerWillingness->not_willing ?? 0 }}
                    ],
                    backgroundColor: ['#43e97b', '#FF6384']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        @endif

        // User Stats Chart
        @if($userStats->count() > 0)
        const userStatsCtx = document.getElementById('userStatsChart').getContext('2d');
        new Chart(userStatsCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($userStats->pluck('name')) !!},
                datasets: [{
                    label: 'Number of Submissions',
                    data: {!! json_encode($userStats->pluck('shop_research_forms_count')) !!},
                    backgroundColor: '#667eea'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        @endif
    </script>
    @endif
</x-layouts.app>