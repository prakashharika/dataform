<x-layouts.app :title="__('Customer Records')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .records-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: linear-gradient(90deg, #262626, #404040);
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }

        .badge-success { background-color: #198754; }
        .badge-warning { background-color: #ffc107; color: #000; }
        .badge-info { background-color: #0dcaf0; color: #000; }
        .badge-secondary { background-color: #6c757d; }
        .badge-primary { background-color: #0d6efd; }

        .search-box {
            max-width: 300px;
        }

        .action-btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 1.5rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.875rem;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Customer Records</h1>
                    <div class="d-flex gap-2">
                        <a href="{{ route('customers.index') }}" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>New Customer Form
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $customers->total() }}</div>
                    <div class="stats-label">Total Customers</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="stats-number">{{ $customers->where('uses_grocery_platforms', true)->count() }}</div>
                    <div class="stats-label">Use Online Platforms</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="stats-number">{{ $customers->where('aware_quick_commerce', true)->count() }}</div>
                    <div class="stats-label">Aware of Quick Commerce</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                    <div class="stats-number">{{ $customers->where('prefers_local_kirana_delivery', true)->count() }}</div>
                    <div class="stats-label">Prefer Local Kirana</div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card records-card">
                    <div class="card-body">
                        <form action="{{ route('customers.records') }}" method="GET" class="row g-3 align-items-end">
                            <div class="col-md-6">
                                <label for="search" class="form-label">Search</label>
                                <input type="text" name="search" id="search" class="form-control"
                                       placeholder="Search by profession, location, platforms..."
                                       value="{{ request('search') }}">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-search me-2"></i>Search
                                </button>
                                <a href="{{ route('customers.records') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-refresh me-2"></i>Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Records Table -->
        <div class="row">
            <div class="col-12">
                <div class="card records-card">
                    <div class="card-header text-white">
                        <h5 class="mb-0"><i class="fas fa-users me-2"></i>All Customer Submissions</h5>
                    </div>
                    <div class="card-body p-0">
                        @if($customers->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Personal Info</th>
                                            <th>Location</th>
                                            <th>Digital Access</th>
                                            <th>Platform Usage</th>
                                            <th>Quick Commerce</th>
                                            <th>Created By</th>
                                            <th>Submitted</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td><strong>#{{ $customer->id }}</strong></td>
                                                <td>
                                                    <div class="fw-semibold">
                                                        @if($customer->age)
                                                            {{ $customer->age }}
                                                        @else
                                                            <span class="text-muted">Age not provided</span>
                                                        @endif
                                                    </div>
                                                    <small class="text-muted">
                                                        {{ $customer->gender ?? 'Gender not provided' }} |
                                                        {{ $customer->profession ?? 'Profession not provided' }}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if($customer->living_location)
                                                        <div class="text-truncate" style="max-width: 200px;" title="{{ $customer->living_location }}">
                                                            {{ $customer->living_location }}
                                                        </div>
                                                    @else
                                                        <span class="text-muted">Not provided</span>
                                                    @endif
                                                    @if($customer->shop_distance)
                                                        <small class="text-muted d-block">Distance: {{ $customer->shop_distance }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column gap-1">
                                                        @if($customer->has_internet_access)
                                                            <span class="badge badge-success">Internet</span>
                                                        @endif
                                                        @if($customer->uses_smartphone)
                                                            <span class="badge badge-primary">Smartphone</span>
                                                        @endif
                                                        @if($customer->uses_apps_regularly)
                                                            <span class="badge badge-info">Apps</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($customer->uses_grocery_platforms)
                                                        <span class="badge badge-success">Yes</span>
                                                        @if($customer->platforms_used)
                                                            <small class="d-block text-muted">{{ Str::limit($customer->platforms_used, 30) }}</small>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($customer->aware_quick_commerce)
                                                        <span class="badge badge-success">Aware</span>
                                                        @if($customer->known_quick_commerce_services)
                                                            <small class="d-block text-muted">{{ Str::limit($customer->known_quick_commerce_services, 30) }}</small>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-secondary">Not Aware</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($customer->user)
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="user-avatar">
                                                                {{ substr($customer->user->name, 0, 1) }}
                                                            </div>
                                                            <div>
                                                                <div class="fw-semibold">{{ $customer->user->name }}</div>
                                                                <small class="text-muted">{{ $customer->user->email }}</small>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small>{{ $customer->created_at->format('M d, Y') }}</small>
                                                    <br>
                                                    <small class="text-muted">{{ $customer->created_at->format('h:i A') }}</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('customers.show', $customer) }}"
                                                           class="btn btn-sm btn-outline-primary action-btn"
                                                           title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form action="{{ route('customers.destroy', $customer) }}"
                                                              method="POST"
                                                              onsubmit="return confirm('Are you sure you want to delete this customer record?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger action-btn"
                                                                    title="Delete Record">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <h4>No customer records found</h4>
                                <p>No customer form submissions available yet.</p>
                                <a href="{{ route('customers.index') }}" class="btn btn-success mt-3">
                                    <i class="fas fa-plus me-2"></i>Create First Customer Form
                                </a>
                            </div>
                        @endif
                    </div>

                    @if($customers->count() > 0)
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }}
                                    of {{ $customers->total() }} results
                                </div>
                                {{ $customers->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-submit form when search changes (optional)
        document.getElementById('search').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                this.form.submit();
            }
        });

        // Confirm before delete
        function confirmDelete() {
            return confirm('Are you sure you want to delete this customer record?');
        }
    </script>
</x-layouts.app>