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
            font-size: 0.9rem;
        }

        .info-value {
            color: #212529;
            font-size: 1rem;
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
        .badge-primary { background-color: #0d6efd; }
        .badge-danger { background-color: #dc3545; }

        .empty-value {
            color: #6c757d;
            font-style: italic;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1rem;
        }
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
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this record?')">
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
                            <small class="float-end">ID: #{{ $record->id }}</small>
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Created By -->
                        @if($record->user)
                        <div class="section-title">Created By</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">User</div>
                                    <div class="info-value">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="user-avatar">
                                                {{ substr($record->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $record->user->name }}</div>
                                                <small class="text-muted">{{ $record->user->email }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

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
                                    <div class="info-label">Reference video link</div>
                                    <div class="info-value">{{ $record->reference_video_link }}</div>
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
                                    <div class="info-label">Mobile Number</div>
                                    <div class="info-value">{{ $record->mobile_number }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Email Address</div>
                                    <div class="info-value">{{ $record->email }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Business Type</div>
                                    <div class="info-value">
                                        <span class="badge badge-info">{{ $record->business_type }}</span>
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

                        <!-- Retailer Questions - Section 1 -->
                        <div class="section-title">Retailer Information - Business Details</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">1. Shop Type</div>
                                    <div class="info-value">
                                        @if($record->shop_type)
                                            {{ $record->shop_type }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">2. Number of Employees</div>
                                    <div class="info-value">
                                        @if($record->number_of_employees)
                                            {{ $record->number_of_employees }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">2. Shop Floor Size</div>
                                    <div class="info-value">
                                        @if($record->shop_floor_size)
                                            {{ $record->shop_floor_size }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">2. Monthly Turnover</div>
                                    <div class="info-value">
                                        @if($record->monthly_turnover)
                                            {{ $record->monthly_turnover }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">2. Customers per Day</div>
                                    <div class="info-value">
                                        @if($record->customers_per_day)
                                            {{ $record->customers_per_day }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">3. Operating Since</div>
                                    <div class="info-value">
                                        @if($record->operating_since)
                                            {{ $record->operating_since }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Retailer Questions - E-commerce Section -->
                        <div class="section-title">Retailer Information - E-commerce & Digital</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">4. Enrolled in E-commerce Platforms</div>
                                    <div class="info-value">
                                        @if($record->enrolled_in_ecommerce === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->enrolled_in_ecommerce === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($record->enrolled_in_ecommerce === 1)
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">5. E-commerce Platforms Used</div>
                                    <div class="info-value">
                                        @if($record->ecommerce_platforms)
                                            {{ $record->ecommerce_platforms }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">5. E-commerce Usage Duration</div>
                                    <div class="info-value">
                                        @if($record->ecommerce_usage_duration)
                                            {{ $record->ecommerce_usage_duration }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">6. Offline Sales Percentage</div>
                                    <div class="info-value">
                                        @if($record->offline_sales_percentage)
                                            {{ $record->offline_sales_percentage }}%
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">6. Online Sales Percentage</div>
                                    <div class="info-value">
                                        @if($record->online_sales_percentage)
                                            {{ $record->online_sales_percentage }}%
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">7. Order Reception Methods</div>
                                    <div class="info-value">
                                        @if($record->order_reception_methods)
                                            {{ $record->order_reception_methods }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Retailer Questions - Quick Commerce Section -->
                        <div class="section-title">Retailer Information - Quick Commerce</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">8. Knows About Quick Commerce</div>
                                    <div class="info-value">
                                        @if($record->knows_quick_commerce === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->knows_quick_commerce === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">9. Participates in Quick Commerce</div>
                                    <div class="info-value">
                                        @if($record->participates_quick_commerce === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->participates_quick_commerce === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($record->quick_commerce_effect)
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">10. Quick Commerce Effects</div>
                                    <div class="info-value">{{ $record->quick_commerce_effect }}</div>
                                </div>
                            </div>
                            @endif

                            @if($record->barriers_not_participating)
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">10. Barriers to Participation</div>
                                    <div class="info-value">{{ $record->barriers_not_participating }}</div>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">11. Willing to Partner</div>
                                    <div class="info-value">
                                        @if($record->willing_to_partner === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->willing_to_partner === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($record->required_incentives)
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">12. Required Incentives</div>
                                    <div class="info-value">{{ $record->required_incentives }}</div>
                                </div>
                            </div>
                            @endif

                            @if($record->concerns_about_platform)
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">13. Concerns About Platform</div>
                                    <div class="info-value">{{ $record->concerns_about_platform }}</div>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">14. Digital Orders Handling</div>
                                    <div class="info-value">
                                        @if($record->digital_orders_handling)
                                            {{ $record->digital_orders_handling }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">15. Customers Ask for Delivery</div>
                                    <div class="info-value">
                                        @if($record->customers_ask_delivery === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->customers_ask_delivery === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">16. Local Delivery Exists</div>
                                    <div class="info-value">
                                        @if($record->local_delivery_exists === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->local_delivery_exists === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">17. Delivery Cost</div>
                                    <div class="info-value">
                                        @if($record->delivery_cost)
                                            {{ $record->delivery_cost }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">18. Stock Variety Adequate</div>
                                    <div class="info-value">
                                        @if($record->stock_variety_adequate === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->stock_variety_adequate === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">19. Delivery Radius</div>
                                    <div class="info-value">
                                        @if($record->delivery_radius)
                                            {{ $record->delivery_radius }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">20. Digital Assistance Available</div>
                                    <div class="info-value">
                                        @if($record->digital_assistance_available === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->digital_assistance_available === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">21. Comfortable with Apps</div>
                                    <div class="info-value">
                                        @if($record->comfortable_with_apps === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->comfortable_with_apps === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">22. Product Margins</div>
                                    <div class="info-value">
                                        @if($record->product_margins)
                                            {{ $record->product_margins }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">23. Cost Absorption Ability</div>
                                    <div class="info-value">
                                        @if($record->cost_absorption_ability)
                                            {{ $record->cost_absorption_ability }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($record->quick_commerce_future_view)
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">24. Future View of Quick Commerce</div>
                                    <div class="info-value">{{ $record->quick_commerce_future_view }}</div>
                                </div>
                            </div>
                            @endif

                            @if($record->viability_changes)
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">25. Suggested Changes for Viability</div>
                                    <div class="info-value">{{ $record->viability_changes }}</div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Consumer Questions -->
                        <div class="section-title">Consumer Information</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">1. Age</div>
                                    <div class="info-value">
                                        @if($record->consumer_age)
                                            {{ $record->consumer_age }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">1. Gender</div>
                                    <div class="info-value">
                                        @if($record->consumer_gender)
                                            {{ $record->consumer_gender }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">1. Income</div>
                                    <div class="info-value">
                                        @if($record->consumer_income)
                                            {{ $record->consumer_income }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">1. Profession</div>
                                    <div class="info-value">
                                        @if($record->consumer_profession)
                                            {{ $record->consumer_profession }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">1. Household Size</div>
                                    <div class="info-value">
                                        @if($record->household_size)
                                            {{ $record->household_size }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">2. Living Location</div>
                                    <div class="info-value">
                                        @if($record->living_location)
                                            {{ $record->living_location }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">2. Shop Distance</div>
                                    <div class="info-value">
                                        @if($record->shop_distance)
                                            {{ $record->shop_distance }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-group">
                                    <div class="info-label">3. Has Internet Access</div>
                                    <div class="info-value">
                                        @if($record->has_internet_access === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->has_internet_access === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-group">
                                    <div class="info-label">3. Uses Smartphone</div>
                                    <div class="info-value">
                                        @if($record->uses_smartphone === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->uses_smartphone === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-group">
                                    <div class="info-label">3. Uses Apps Regularly</div>
                                    <div class="info-value">
                                        @if($record->uses_apps_regularly === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($record->uses_apps_regularly === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Continue with remaining consumer questions... -->
                            <!-- Add all other consumer fields following the same pattern -->

                        </div>

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