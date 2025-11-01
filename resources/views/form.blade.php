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

        .conditional-section {
            display: none;
            margin-left: 1rem;
            padding-left: 1rem;
            border-left: 3px solid #262626;
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
    <!-- Video Reference Section -->
                        <div class="video-reference">
                            <h5><i class="fas fa-video me-2"></i>Reference video link </h5>
                            <div class="mb-3">
                                <input type="url" name="reference_video_link" id="reference_video_link" class="form-control" 
                                       placeholder="https://www.youtube.com/watch?v=example or https://drive.google.com/file/d/example/view" 
                                       >
                                <small class="text-white-50">Please provide a YouTube, Google Drive, or other video sharing link</small>
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

                                <!-- Question 1 -->
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

                                <!-- Question 2 -->
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

                                <!-- Question 3 -->
                                <div class="question-group">
                                    <div class="question-text">3. How long has this shop been operating?</div>
                                    <input type="text" name="operating_since" class="form-control" placeholder="e.g., 5 years">
                                </div>

                                <!-- Question 4 -->
                                <div class="question-group">
                                    <div class="question-text">4. Are you currently enrolled on any e-commerce / hyperlocal delivery / marketplace platforms?</div>
                                    <select name="enrolled_in_ecommerce" class="form-select" onchange="toggleEcommerceDetails(this.value)">
                                        <option value="">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Questions 5-6 (Conditional) -->
                                <div id="ecommerceDetails" class="conditional-section">
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

                                <!-- Question 7 -->
                                <div class="question-group">
                                    <div class="question-text">7. How do you currently receive orders?</div>
                                    <textarea name="order_reception_methods" class="form-control" rows="2" placeholder="e.g., walk in, phone call, WhatsApp, delivery app, etc."></textarea>
                                </div>

                                <!-- Question 8 -->
                                <div class="question-group">
                                    <div class="question-text">8. Do you know about quick commerce / ultrafast delivery services in your city?</div>
                                    <select name="knows_quick_commerce" class="form-select" onchange="toggleQuickCommerceDetails(this.value)">
                                        <option value="">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Question 9 -->
                                <div class="question-group">
                                    <div class="question-text">9. Is your shop participating in any quick commerce fulfillment?</div>
                                    <select name="participates_quick_commerce" class="form-select" onchange="toggleParticipationDetails(this.value)">
                                        <option value="">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Questions 10 (Conditional) -->
                                <div id="participationDetails" class="conditional-section">
                                    <div class="question-group">
                                        <div class="question-text">10. If yes: what has been the effect so far? If not: why not (barriers)?</div>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">Effects (if participating)</label>
                                                <textarea name="quick_commerce_effect" class="form-control" rows="2" placeholder="Describe the effects..."></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Barriers (if not participating)</label>
                                                <textarea name="barriers_not_participating" class="form-control" rows="2" placeholder="Describe the barriers..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 11 -->
                                <div class="question-group">
                                    <div class="question-text">11. Would you be willing to enrol / partner with a local quick commerce platform?</div>
                                    <select name="willing_to_partner" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Question 12 -->
                                <div class="question-group">
                                    <div class="question-text">12. What incentives or support would you need to do so?</div>
                                    <textarea name="required_incentives" class="form-control" rows="2" placeholder="Describe required incentives..."></textarea>
                                </div>

                                <!-- Question 13 -->
                                <div class="question-group">
                                    <div class="question-text">13. What are the main concerns you have about joining a quick commerce platform?</div>
                                    <textarea name="concerns_about_platform" class="form-control" rows="2" placeholder="Describe your concerns..."></textarea>
                                </div>

                                <!-- Question 14 -->
                                <div class="question-group">
                                    <div class="question-text">14. How well do you think your shop is placed to handle digital orders?</div>
                                    <select name="digital_orders_handling" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="Very Well">Very Well</option>
                                        <option value="Well">Well</option>
                                        <option value="Moderately">Moderately</option>
                                        <option value="Poorly">Poorly</option>
                                        <option value="Not at all">Not at all</option>
                                    </select>
                                </div>

                                <!-- Question 15 -->
                                <div class="question-group">
                                    <div class="question-text">15. Do customers in your area ask for delivery / quick delivery?</div>
                                    <select name="customers_ask_delivery" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Question 16 -->
                                <div class="question-group">
                                    <div class="question-text">16. Are there existing local delivery services already fulfilling similar demands?</div>
                                    <select name="local_delivery_exists" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Question 17 -->
                                <div class="question-group">
                                    <div class="question-text">17. What is the cost for your shop to fulfil small frequent delivery orders?</div>
                                    <input type="text" name="delivery_cost" class="form-control" placeholder="e.g., ₹50 per delivery, 10% of order value, etc.">
                                </div>

                                <!-- Question 18 -->
                                <div class="question-group">
                                    <div class="question-text">18. Do you have stock & variety to meet instant order demand?</div>
                                    <select name="stock_variety_adequate" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Question 19 -->
                                <div class="question-group">
                                    <div class="question-text">19. What delivery radius is feasible for your shop?</div>
                                    <input type="text" name="delivery_radius" class="form-control" placeholder="e.g., 5 km, within same locality, etc.">
                                </div>

                                <!-- Question 20 -->
                                <div class="question-group">
                                    <div class="question-text">20. Does anyone in your family or among your staff help with digital tasks?</div>
                                    <select name="digital_assistance_available" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Question 21 -->
                                <div class="question-group">
                                    <div class="question-text">21. Are you comfortable using mobile / apps for order / payment?</div>
                                    <select name="comfortable_with_apps" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- Question 22 -->
                                <div class="question-group">
                                    <div class="question-text">22. What margins do you get on typical products?</div>
                                    <input type="text" name="product_margins" class="form-control" placeholder="e.g., 15-20%, ₹10-20 per item, etc.">
                                </div>

                                <!-- Question 23 -->
                                <div class="question-group">
                                    <div class="question-text">23. Would you be able to absorb additional costs or require higher selling price?</div>
                                    <select name="cost_absorption_ability" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="Absorb costs">Absorb costs</option>
                                        <option value="Require higher price">Require higher price</option>
                                        <option value="Mix of both">Mix of both</option>
                                        <option value="Not sure">Not sure</option>
                                    </select>
                                </div>

                                <!-- Question 24 -->
                                <div class="question-group">
                                    <div class="question-text">24. How do you see the future of quick commerce / hyperlocal delivery in your area?</div>
                                    <textarea name="quick_commerce_future_view" class="form-control" rows="2" placeholder="Share your views..."></textarea>
                                </div>

                                <!-- Question 25 -->
                                <div class="question-group">
                                    <div class="question-text">25. What changes would make it more viable?</div>
                                    <textarea name="viability_changes" class="form-control" rows="2" placeholder="Suggest changes..."></textarea>
                                </div>

                                   <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" onclick="prevStep(1)">
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

        function toggleQuickCommerceDetails(value) {
            // You can add functionality here if needed
        }

        function toggleParticipationDetails(value) {
            const participationDetails = document.getElementById('participationDetails');
            participationDetails.style.display = value ? 'block' : 'none';
        }

        function toggleGroceryPlatforms(value) {
            const groceryPlatformsDetails = document.getElementById('groceryPlatformsDetails');
            groceryPlatformsDetails.style.display = value === '1' ? 'block' : 'none';
        }

        function toggleBadExperienceDetails(value) {
            const badExperienceDetails = document.getElementById('badExperienceDetails');
            badExperienceDetails.style.display = value === '1' ? 'block' : 'none';
        }

        // Initialize form
        document.addEventListener('DOMContentLoaded', function() {
            showStep(1);
        });
    </script>
</x-layouts.app>