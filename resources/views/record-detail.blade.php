{{-- resources/views/record-detail.blade.php --}}
<x-layouts.app :title="__('Record Details')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .detail-card {
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

        .info-group {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #262626;
        }

        .info-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .info-value {
            color: #212529;
            font-size: 1.1rem;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #262626;
            margin: 2rem 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .badge-success { background-color: #198754; }
        .badge-warning { background-color: #ffc107; color: #000; }
        .badge-info { background-color: #0dcaf0; color: #000; }
        .badge-secondary { background-color: #6c757d; }
    </style>

    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">Record Details</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('form.record') }}">Records</a></li>
                                <li class="breadcrumb-item active">#{{ $record->id }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('form.record') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Records
                        </a>
                        <form action="{{ route('form.destroy', $record) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash me-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card detail-card">
                    <div class="card-header text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-store me-2"></i>
                            {{ $record->shop_name }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Basic Information -->
                        <div class="section-title">Basic Information</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Shop Name</div>
                                    <div class="info-value">{{ $record->shop_name }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Client Name</div>
                                    <div class="info-value">{{ $record->client_name }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Contact Information</div>
                                    <div class="info-value">
                                        <div><i class="fas fa-phone me-2"></i>{{ $record->mobile_number }}</div>
                                        <div><i class="fas fa-envelope me-2"></i>{{ $record->email }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Business Details</div>
                                    <div class="info-value">
                                        <span class="badge badge-info">{{ $record->business_type }}</span>
                                        @if($record->shop_type)
                                            <span class="badge badge-secondary ms-1">{{ $record->shop_type }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Shop Address</div>
                                    <div class="info-value">{{ $record->shop_address }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Retailer Questions -->
                        @if($record->shop_type || $record->number_of_employees)
                        <div class="section-title">Retailer Information</div>
                        <div class="row g-3">
                            @if($record->shop_type)
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Shop Type</div>
                                    <div class="info-value">{{ $record->shop_type }}</div>
                                </div>
                            </div>
                            @endif
                            
                            @if($record->number_of_employees)
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Number of Employees</div>
                                    <div class="info-value">{{ $record->number_of_employees }}</div>
                                </div>
                            </div>
                            @endif

                            @if($record->operating_since)
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Operating Since</div>
                                    <div class="info-value">{{ $record->operating_since }}</div>
                                </div>
                            </div>
                            @endif

                            @if($record->enrolled_in_ecommerce !== null)
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">E-commerce Enrollment</div>
                                    <div class="info-value">
                                        @if($record->enrolled_in_ecommerce)
                                            <span class="badge badge-success">Yes</span>
                                            @if($record->ecommerce_platforms)
                                                <div class="mt-1"><small>Platforms: {{ $record->ecommerce_platforms }}</small></div>
                                            @endif
                                        @else
                                            <span class="badge badge-secondary">No</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($record->willing_to_partner !== null)
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Willing to Partner</div>
                                    <div class="info-value">
                                        @if($record->willing_to_partner)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-secondary">No</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Consumer Questions -->
                        @if($record->consumer_age || $record->consumer_income)
                        <div class="section-title">Consumer Information</div>
                        <div class="row g-3">
                            @if($record->consumer_age)
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Age</div>
                                    <div class="info-value">{{ $record->consumer_age }}</div>
                                </div>
                            </div>
                            @endif

                            @if($record->consumer_gender)
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Gender</div>
                                    <div class="info-value">{{ $record->consumer_gender }}</div>
                                </div>
                            </div>
                            @endif

                            @if($record->consumer_income)
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Income</div>
                                    <div class="info-value">{{ $record->consumer_income }}</div>
                                </div>
                            </div>
                            @endif

                            @if($record->would_use_quick_commerce !== null)
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Would Use Quick Commerce</div>
                                    <div class="info-value">
                                        @if($record->would_use_quick_commerce)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-secondary">No</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Additional Notes -->
                        @if($record->quick_commerce_future_view || $record->viability_changes)
                        <div class="section-title">Additional Comments</div>
                        <div class="row g-3">
                            @if($record->quick_commerce_future_view)
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Future View of Quick Commerce</div>
                                    <div class="info-value">{{ $record->quick_commerce_future_view }}</div>
                                </div>
                            </div>
                            @endif

                            @if($record->viability_changes)
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Suggested Changes for Viability</div>
                                    <div class="info-value">{{ $record->viability_changes }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Timestamps -->
                        <div class="section-title">Submission Details</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Submitted On</div>
                                    <div class="info-value">
                                        {{ $record->created_at->format('F d, Y \a\t h:i A') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Last Updated</div>
                                    <div class="info-value">
                                        {{ $record->updated_at->format('F d, Y \a\t h:i A') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>