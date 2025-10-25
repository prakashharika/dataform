<x-layouts.app :title="__('Hyperlocal Research Form')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: #f8fafc;
        }

        a{
            color: #000000bb !important;
            text-decoration: none !important;
        }

        .form-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background: linear-gradient(90deg, #262626, #404040);
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #262626;
            box-shadow: 0 0 0 0.25rem rgba(38, 38, 38, 0.1);
        }

        .btn-success {
            background: linear-gradient(90deg, #198754, #157347);
            border: none;
            border-radius: 8px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: linear-gradient(90deg, #157347, #0d5e3d);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: linear-gradient(90deg, #6c757d, #5a6268);
            border: none;
            border-radius: 8px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .step-progress {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .step-progress::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #e9ecef;
            transform: translateY(-50%);
            z-index: 1;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .step.active {
            background: #262626;
            color: white;
        }

        .step.completed {
            background: #198754;
            color: white;
        }

        .step-label {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            margin-top: 8px;
            white-space: nowrap;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .step.active .step-label {
            color: #262626;
            font-weight: 600;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #262626;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .question-group {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .question-text {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card form-card">
                    <div class="card-header text-white text-center py-3">
                        <h4 class="mb-0">🏪 Hyperlocal Quick Commerce Research Form</h4>
                    </div>

                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Step Progress -->
                        <div class="step-progress">
                            <div class="step active" id="step1">
                                1
                                <span class="step-label">Shop Details</span>
                            </div>
                            <div class="step" id="step2">
                                2
                                <span class="step-label">Retailer Questions</span>
                            </div>
                            <div class="step" id="step3">
                                3
                                <span class="step-label">Consumer Questions</span>
                            </div>
                        </div>

                        <form action="{{ route('form.store') }}" method="POST" id="multiStepForm" novalidate>
                            @csrf

                            <!-- Step 1: Shop Details -->
                            <div class="form-section active" id="section1">
                                <p class="form-section-title">Business Details</p>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="shop_name" class="form-label">Shop Name *</label>
                                        <input type="text" name="shop_name" id="shop_name" class="form-control" placeholder="Enter shop name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="client_name" class="form-label">Client Name *</label>
                                        <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Enter client name" required>
                                    </div>
                                </div>

                                <p class="form-section-title">Contact Information</p>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="mobile_number" class="form-label">Mobile Number *</label>
                                        <input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="e.g. 9876543210" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" required>
                                    </div>
                                </div>

                                <p class="form-section-title">Business Type & Address</p>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="business_type" class="form-label">Business Type *</label>
                                        <select name="business_type" id="business_type" class="form-select" required>
                                            <option value="">-- Select --</option>
                                            <option value="Grocery">Grocery</option>
                                            <option value="Fruits & Veg">Fruits & Veg</option>
                                            <option value="Bakery">Bakery</option>
                                            <option value="Medical">Medical</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="shop_address" class="form-label">Shop Address *</label>
                                        <textarea name="shop_address" id="shop_address" rows="2" class="form-control" placeholder="Enter shop address" required></textarea>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" class="btn btn-success" onclick="nextStep(2)">
                                        Next ➔
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Retailer Questions -->
                            <div class="form-section" id="section2">
                                <p class="form-section-title">A. Questionnaire for Retailers / Shops / Supermarkets / Kirana Stores</p>

                                <div class="question-group">
                                    <div class="question-text">1. What type of shop is this?</div>
                                    <select name="shop_type" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="Supermarket">Supermarket</option>
                                        <option value="Grocery">Grocery</option>
                                        <option value="Provision">Provision</option>
                                        <option value="Slipper/Shoe store">Slipper/Shoe store</option>
                                        <option value="Departmental store">Departmental store</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>

                                <div class="question-group">
                                    <div class="question-text">2. Size of shop</div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Number of Employees</label>
                                            <input type="number" name="number_of_employees" class="form-control" min="0">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Shop Floor Size</label>
                                            <input type="text" name="shop_floor_size" class="form-control" placeholder="e.g., 500 sq ft">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Monthly Turnover</label>
                                            <input type="text" name="monthly_turnover" class="form-control" placeholder="e.g., ₹50,000">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Customers per Day</label>
                                            <input type="number" name="customers_per_day" class="form-control" min="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="question-group">
                                    <div class="question-text">3. How long has this shop been operating?</div>
                                    <input type="text" name="operating_since" class="form-control" placeholder="e.g., 5 years">
                                </div>

                                <div class="question-group">
                                    <div class="question-text">4. Are you currently enrolled on any e-commerce / hyperlocal delivery / marketplace platforms?</div>
                                    <select name="enrolled_in_ecommerce" class="form-select" onchange="toggleEcommerceDetails(this.value)">
                                        <option value="">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div id="ecommerceDetails" style="display: none;">
                                    <div class="question-group">
                                        <div class="question-text">5. If yes, which ones, and how long have you been using them?</div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Platforms Used</label>
                                                <input type="text" name="ecommerce_platforms" class="form-control" placeholder="e.g., Flipkart, Amazon, etc.">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Usage Duration</label>
                                                <input type="text" name="ecommerce_usage_duration" class="form-control" placeholder="e.g., 2 years">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="question-group">
                                        <div class="question-text">6. What proportion of your sales comes from offline vs. online?</div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Offline Sales (%)</label>
                                                <input type="number" name="offline_sales_percentage" class="form-control" min="0" max="100">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Online Sales (%)</label>
                                                <input type="number" name="online_sales_percentage" class="form-control" min="0" max="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add more questions following the same pattern -->
                                <div class="question-group">
                                    <div class="question-text">7. How do you currently receive orders?</div>
                                    <textarea name="order_reception_methods" class="form-control" rows="2" placeholder="e.g., walk in, phone call, WhatsApp, delivery app, etc."></textarea>
                                </div>

                                <div class="question-group">
                                    <div class="question-text">8. Do you know about quick commerce / ultrafast delivery services in your city?</div>
                                    <select name="knows_quick_commerce" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Continue with remaining questions in similar pattern -->

                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" onclick="prevStep(1)">
                                        ⬅ Previous
                                    </button>
                                    <button type="button" class="btn btn-success" onclick="nextStep(3)">
                                        Next ➔
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Consumer Questions -->
                            <div class="form-section" id="section3">
                                <p class="form-section-title">B. Questionnaire for Consumers / Users</p>

                                <div class="question-group">
                                    <div class="question-text">1. Personal Information</div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Age</label>
                                            <input type="text" name="consumer_age" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Gender</label>
                                            <select name="consumer_gender" class="form-select">
                                                <option value="">-- Select --</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Income</label>
                                            <input type="text" name="consumer_income" class="form-control" placeholder="e.g., ₹50,000/month">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Profession</label>
                                            <input type="text" name="consumer_profession" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Household Size</label>
                                            <input type="number" name="household_size" class="form-control" min="1">
                                        </div>
                                    </div>
                                </div>

                                <div class="question-group">
                                    <div class="question-text">2. Where do you live and how far are shops from your home?</div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Living Location</label>
                                            <textarea name="living_location" class="form-control" rows="2" placeholder="Enter your location"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Shop Distance</label>
                                            <input type="text" name="shop_distance" class="form-control" placeholder="e.g., 1 km">
                                        </div>
                                    </div>
                                </div>

                                <div class="question-group">
                                    <div class="question-text">3. Do you have internet access / smartphone / use apps regularly?</div>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Internet Access</label>
                                            <select name="has_internet_access" class="form-select">
                                                <option value="">-- Select --</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Uses Smartphone</label>
                                            <select name="uses_smartphone" class="form-select">
                                                <option value="">-- Select --</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Uses Apps Regularly</label>
                                            <select name="uses_apps_regularly" class="form-select">
                                                <option value="">-- Select --</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Continue with remaining consumer questions -->

                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" onclick="prevStep(2)">
                                        ⬅ Previous
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        💾 Submit Form
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;

        function showStep(step) {
            // Hide all sections
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Show current section
            document.getElementById(`section${step}`).classList.add('active');
            
            // Update progress steps
            document.querySelectorAll('.step').forEach((stepElem, index) => {
                stepElem.classList.remove('active', 'completed');
                if (index + 1 < step) {
                    stepElem.classList.add('completed');
                } else if (index + 1 === step) {
                    stepElem.classList.add('active');
                }
            });
        }

        function nextStep(step) {
            if (validateStep(currentStep)) {
                currentStep = step;
                showStep(step);
            }
        }

        function prevStep(step) {
            currentStep = step;
            showStep(step);
        }

        function validateStep(step) {
            const currentSection = document.getElementById(`section${step}`);
            const requiredFields = currentSection.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                alert('Please fill all required fields before proceeding.');
            }

            return isValid;
        }

        function toggleEcommerceDetails(value) {
            const ecommerceDetails = document.getElementById('ecommerceDetails');
            ecommerceDetails.style.display = value === '1' ? 'block' : 'none';
        }

        // Initialize form
        document.addEventListener('DOMContentLoaded', function() {
            showStep(1);
        });
    </script>
</x-layouts.app>