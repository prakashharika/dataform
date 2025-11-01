<x-layouts.app :title="__('Customer Details')">
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
                        <h1 class="h3 mb-0">Customer Details</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('customers.records') }}">Customer Records</a></li>
                                <li class="breadcrumb-item active">#{{ $customer->id }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('customers.records') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Records
                        </a>
                        <form action="{{ route('customers.destroy', $customer) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this customer record?')">
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
                            <i class="fas fa-user me-2"></i>
                            Customer Record #{{ $customer->id }}
                            <small class="float-end">
                                @if($customer->age && $customer->gender)
                                    {{ $customer->age }}, {{ $customer->gender }}
                                @else
                                    Customer Information
                                @endif
                            </small>
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Created By -->
                        @if($customer->user)
                        <div class="section-title">Created By</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">User</div>
                                    <div class="info-value">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="user-avatar">
                                                {{ substr($customer->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $customer->user->name }}</div>
                                                <small class="text-muted">{{ $customer->user->email }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Question 1: Personal Information -->
                        <div class="section-title">1. Personal Information</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Age</div>
                                    <div class="info-value">
                                        @if($customer->age)
                                            {{ $customer->age }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Gender</div>
                                    <div class="info-value">
                                        @if($customer->gender)
                                            {{ $customer->gender }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Income</div>
                                    <div class="info-value">
                                        @if($customer->income)
                                            {{ $customer->income }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Profession</div>
                                    <div class="info-value">
                                        @if($customer->profession)
                                            {{ $customer->profession }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Household Size</div>
                                    <div class="info-value">
                                        @if($customer->household_size)
                                            {{ $customer->household_size }} members
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Question 2: Location Information -->
                        <div class="section-title">2. Location Information</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Living Location</div>
                                    <div class="info-value">
                                        @if($customer->living_location)
                                            {{ $customer->living_location }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Shop Distance</div>
                                    <div class="info-value">
                                        @if($customer->shop_distance)
                                            {{ $customer->shop_distance }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Question 3: Digital Access -->
                        <div class="section-title">3. Digital Access</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="info-group">
                                    <div class="info-label">Internet Access</div>
                                    <div class="info-value">
                                        @if($customer->has_internet_access === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($customer->has_internet_access === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-group">
                                    <div class="info-label">Uses Smartphone</div>
                                    <div class="info-value">
                                        @if($customer->uses_smartphone === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($customer->uses_smartphone === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-group">
                                    <div class="info-label">Uses Apps Regularly</div>
                                    <div class="info-value">
                                        @if($customer->uses_apps_regularly === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($customer->uses_apps_regularly === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Question 4-5: Platform Usage -->
                        <div class="section-title">4-5. Platform Usage</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Uses Grocery Platforms</div>
                                    <div class="info-value">
                                        @if($customer->uses_grocery_platforms === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($customer->uses_grocery_platforms === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($customer->uses_grocery_platforms === 1)
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Shopping Frequency</div>
                                    <div class="info-value">
                                        @if($customer->shopping_frequency)
                                            {{ $customer->shopping_frequency }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Platforms Used</div>
                                    <div class="info-value">
                                        @if($customer->platforms_used)
                                            {{ $customer->platforms_used }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Items Purchased</div>
                                    <div class="info-value">
                                        @if($customer->items_purchased)
                                            {{ $customer->items_purchased }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Question 6: Quick Commerce Awareness -->
                        <div class="section-title">6. Quick Commerce Awareness</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Aware of Quick Commerce</div>
                                    <div class="info-value">
                                        @if($customer->aware_quick_commerce === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($customer->aware_quick_commerce === 0)
                                            <span class="badge badge-secondary">No</span>
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($customer->aware_quick_commerce === 1)
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Known Quick Commerce Services</div>
                                    <div class="info-value">
                                        @if($customer->known_quick_commerce_services)
                                            {{ $customer->known_quick_commerce_services }}
                                        @else
                                            <span class="empty-value">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Continue with remaining questions... -->
                        <!-- Add questions 7-15 following the same pattern -->

                        <!-- Question 7 -->
                        @if($customer->services_available_area !== null)
                        <div class="section-title">7. Service Availability</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Services Available in Area</div>
                                    <div class="info-value">
                                        @if($customer->services_available_area === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-secondary">No</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Question 8 -->
                        @if($customer->useful_situations)
                        <div class="section-title">8. Useful Situations for Quick Delivery</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Situations</div>
                                    <div class="info-value">{{ $customer->useful_situations }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Question 9 -->
                        @if($customer->preferred_categories)
                        <div class="section-title">9. Preferred Categories for Quick Commerce</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Categories</div>
                                    <div class="info-value">{{ $customer->preferred_categories }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Question 10 -->
                        @if($customer->quick_commerce_concerns)
                        <div class="section-title">10. Concerns About Quick Commerce</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Concerns</div>
                                    <div class="info-value">{{ $customer->quick_commerce_concerns }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Question 11 -->
                        @if($customer->acceptable_delivery_time)
                        <div class="section-title">11. Acceptable Delivery Time</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Delivery Time</div>
                                    <div class="info-value">{{ $customer->acceptable_delivery_time }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Question 12 -->
                        @if($customer->extra_payment_willingness)
                        <div class="section-title">12. Extra Payment Willingness</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Extra Payment</div>
                                    <div class="info-value">{{ $customer->extra_payment_willingness }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Question 13 -->
                        @if($customer->trust_factors)
                        <div class="section-title">13. Trust Factors</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Factors Affecting Trust</div>
                                    <div class="info-value">{{ $customer->trust_factors }}</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Question 14 -->
                        @if($customer->had_bad_experiences !== null)
                        <div class="section-title">14. Bad Experiences</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Had Bad Experiences</div>
                                    <div class="info-value">
                                        @if($customer->had_bad_experiences === 1)
                                            <span class="badge badge-warning">Yes</span>
                                        @else
                                            <span class="badge badge-success">No</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($customer->had_bad_experiences === 1 && $customer->bad_experience_details)
                            <div class="col-12">
                                <div class="info-group">
                                    <div class="info-label">Bad Experience Details</div>
                                    <div class="info-value">{{ $customer->bad_experience_details }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Question 15 -->
                        @if($customer->prefers_local_kirana_delivery !== null)
                        <div class="section-title">15. Local Kirana Preference</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Prefers Local Kirana Delivery</div>
                                    <div class="info-value">
                                        @if($customer->prefers_local_kirana_delivery === 1)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-secondary">No</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Timestamps -->
                        <div class="section-title">Submission Details</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Submitted On</div>
                                    <div class="info-value">
                                        {{ $customer->created_at->format('F d, Y \a\t h:i A') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">Last Updated</div>
                                    <div class="info-value">
                                        {{ $customer->updated_at->format('F d, Y \a\t h:i A') }}
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