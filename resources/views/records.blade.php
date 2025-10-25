{{-- resources/views/records.blade.php --}}
<x-layouts.app :title="__('Research Records')">
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

        .search-box {
            max-width: 300px;
        }

        .action-btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .pagination {
            margin-bottom: 0;
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
    </style>

    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Research Records</h1>
                    <div class="d-flex gap-2">
                        <a href="{{ route('form.index') }}" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>New Form
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $records->total() }}</div>
                    <div class="stats-label">Total Records</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="stats-number">{{ $records->where('enrolled_in_ecommerce', true)->count() }}</div>
                    <div class="stats-label">E-commerce Enabled</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="stats-number">{{ $records->where('willing_to_partner', true)->count() }}</div>
                    <div class="stats-label">Willing to Partner</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                    <div class="stats-number">{{ $records->where('would_use_quick_commerce', true)->count() }}</div>
                    <div class="stats-label">Would Use Quick Commerce</div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card records-card">
                    <div class="card-body">
                        <form action="{{ route('form.record') }}" method="GET" class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="search" class="form-label">Search</label>
                                <input type="text" name="search" id="search" class="form-control" 
                                       placeholder="Search by shop name, client, mobile..." 
                                       value="{{ request('search') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="business_type" class="form-label">Business Type</label>
                                <select name="business_type" id="business_type" class="form-select">
                                    <option value="">All Types</option>
                                    @foreach($businessTypes as $type)
                                        <option value="{{ $type }}" {{ request('business_type') == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-search me-2"></i>Search
                                </button>
                                <a href="{{ route('form.record') }}" class="btn btn-outline-secondary">
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
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>All Submissions</h5>
                    </div>
                    <div class="card-body p-0">
                        @if($records->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Shop Name</th>
                                            <th>Client Name</th>
                                            <th>Contact</th>
                                            <th>Business Type</th>
                                            <th>E-commerce</th>
                                            <th>Quick Commerce</th>
                                            <th>Submitted</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($records as $record)
                                            <tr>
                                                <td><strong>#{{ $record->id }}</strong></td>
                                                <td>
                                                    <div class="fw-semibold">{{ $record->shop_name }}</div>
                                                    <small class="text-muted">{{ Str::limit($record->shop_address, 30) }}</small>
                                                </td>
                                                <td>{{ $record->client_name }}</td>
                                                <td>
                                                    <div>{{ $record->mobile_number }}</div>
                                                    <small class="text-muted">{{ $record->email }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{ $record->business_type }}</span>
                                                </td>
                                                <td>
                                                    @if($record->enrolled_in_ecommerce)
                                                        <span class="badge badge-success">Yes</span>
                                                    @else
                                                        <span class="badge badge-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($record->participates_quick_commerce)
                                                        <span class="badge badge-success">Active</span>
                                                    @elseif($record->knows_quick_commerce)
                                                        <span class="badge badge-warning">Aware</span>
                                                    @else
                                                        <span class="badge badge-secondary">Not Aware</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small>{{ $record->created_at->format('M d, Y') }}</small>
                                                    <br>
                                                    <small class="text-muted">{{ $record->created_at->format('h:i A') }}</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('form.show', $record) }}" 
                                                           class="btn btn-sm btn-outline-primary action-btn"
                                                           title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form action="{{ route('form.destroy', $record) }}" 
                                                              method="POST" 
                                                              onsubmit="return confirm('Are you sure you want to delete this record?')">
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
                                <i class="fas fa-inbox"></i>
                                <h4>No records found</h4>
                                <p>No research form submissions available yet.</p>
                                <a href="{{ route('form.index') }}" class="btn btn-success mt-3">
                                    <i class="fas fa-plus me-2"></i>Create First Form
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    @if($records->count() > 0)
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    Showing {{ $records->firstItem() }} to {{ $records->lastItem() }} 
                                    of {{ $records->total() }} results
                                </div>
                                {{ $records->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-submit form when filters change
        document.getElementById('business_type').addEventListener('change', function() {
            this.form.submit();
        });

        // Confirm before delete
        function confirmDelete() {
            return confirm('Are you sure you want to delete this record?');
        }
    </script>
</x-layouts.app>