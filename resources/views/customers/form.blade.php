<x-layouts.app :title="__('Customer Research Form')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Reuse the same styling as the shop form */
        body {
            background: #f8fafc;
        }

        .form-card {
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

        .form-label {
            font-weight: 600;
            color: #495057;
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

         body { background: #f8fafc; }
        .form-card { background: #fff; border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); }
        .card-header { background: linear-gradient(90deg, #262626, #404040); border-top-left-radius: 12px !important; border-top-right-radius: 12px !important; }
        .form-label { font-weight: 600; color: #495057; }
        .question-group { margin-bottom: 1.5rem; padding: 1rem; background: #f8f9fa; border-radius: 8px; }
        .question-text { font-weight: 600; color: #495057; margin-bottom: 0.5rem; }
        .conditional-section { display: none; margin-left: 1rem; padding-left: 1rem; border-left: 3px solid #262626; }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card form-card">
                    <div class="card-header text-white text-center py-3">
                        <h4 class="mb-0">👥 Customer Research Form</h4>
                    </div>

                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('customers.store') }}" method="POST">
                            @csrf

                            <!-- Question 1 -->
                            <div class="question-group">
                                <div class="question-text">1. Personal Information</div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Age</label>
                                        <input type="text" name="age" class="form-control" placeholder="e.g., 25-34, 35-44">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-select">
                                            <option value="">-- Select --</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Income</label>
                                        <input type="text" name="income" class="form-control" placeholder="e.g., ₹50,000/month">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Profession</label>
                                        <input type="text" name="profession" class="form-control" placeholder="e.g., Software Engineer, Teacher">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Household Size</label>
                                        <input type="number" name="household_size" class="form-control" min="1" max="20" placeholder="Number of family members">
                                    </div>
                                </div>
                            </div>

                            <!-- Question 2 -->
                            <div class="question-group">
                                <div class="question-text">2. Where do you live and how far are shops from your home?</div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Living Location</label>
                                        <textarea name="living_location" class="form-control" rows="2" placeholder="Enter your area, locality, city..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Shop Distance</label>
                                        <input type="text" name="shop_distance" class="form-control" placeholder="e.g., 1 km, 5 km, walking distance">
                                    </div>
                                </div>
                            </div>

                            <!-- Question 3 -->
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

                            <!-- Question 4 -->
                            <div class="question-group">
                                <div class="question-text">4. Do you currently use any platforms for buying groceries / essentials?</div>
                                <select name="uses_grocery_platforms" class="form-select" onchange="togglePlatformDetails(this.value)">
                                    <option value="">-- Select --</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Question 5 (Conditional) -->
                            <div id="platformDetails" class="conditional-section">
                                <div class="question-group">
                                    <div class="question-text">5. Which platforms, how often, and what do you buy?</div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Platforms Used</label>
                                            <input type="text" name="platforms_used" class="form-control" placeholder="e.g., Blinkit, Zepto, Instamart, Amazon">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Shopping Frequency</label>
                                            <input type="text" name="shopping_frequency" class="form-control" placeholder="e.g., Weekly, Monthly, Occasionally">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Items Purchased</label>
                                            <textarea name="items_purchased" class="form-control" rows="2" placeholder="What items do you typically buy online?"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Question 6 -->
                            <div class="question-group">
                                <div class="question-text">6. Are you aware of quick commerce services? Which ones?</div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Aware of Quick Commerce</label>
                                        <select name="aware_quick_commerce" class="form-select">
                                            <option value="">-- Select --</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Known Services</label>
                                        <input type="text" name="known_quick_commerce_services" class="form-control" placeholder="e.g., Blinkit, Zepto, Swiggy Instamart">
                                    </div>
                                </div>
                            </div>

                            <!-- Question 7 -->
                            <div class="question-group">
                                <div class="question-text">7. Do any of these services currently deliver to your area?</div>
                                <select name="services_available_area" class="form-select">
                                    <option value="">-- Select --</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    <option value="2">Not sure</option>
                                </select>
                            </div>

                            <!-- Question 8 -->
                            <div class="question-group">
                                <div class="question-text">8. In what situations do you feel quick delivery is useful?</div>
                                <textarea name="useful_situations" class="form-control" rows="2" placeholder="e.g., sudden guests, missing ingredients, urgent needs"></textarea>
                            </div>

                            <!-- Question 9 -->
                            <div class="question-group">
                                <div class="question-text">9. What item categories would you buy via quick commerce?</div>
                                <textarea name="preferred_categories" class="form-control" rows="2" placeholder="e.g., groceries, snacks, medicines, beverages"></textarea>
                            </div>

                            <!-- Question 10 -->
                            <div class="question-group">
                                <div class="question-text">10. What concerns do you have about using quick commerce?</div>
                                <textarea name="quick_commerce_concerns" class="form-control" rows="2" placeholder="e.g., pricing, quality, reliability, returns"></textarea>
                            </div>

                            <!-- Question 11 -->
                            <div class="question-group">
                                <div class="question-text">11. What delivery time would you find acceptable?</div>
                                <input type="text" name="acceptable_delivery_time" class="form-control" placeholder="e.g., within 10 minutes, within 30 minutes">
                            </div>

                            <!-- Question 12 -->
                            <div class="question-group">
                                <div class="question-text">12. How much extra are you willing to pay for fast delivery?</div>
                                <input type="text" name="extra_payment_willingness" class="form-control" placeholder="e.g., ₹20 extra, 5% surcharge">
                            </div>

                            <!-- Question 13 -->
                            <div class="question-group">
                                <div class="question-text">13. What factors affect your trust in a seller or delivery platform?</div>
                                <textarea name="trust_factors" class="form-control" rows="2" placeholder="e.g., reviews, delivery speed, known brand, previous experience"></textarea>
                            </div>

                            <!-- Question 14 -->
                            <div class="question-group">
                                <div class="question-text">14. Have you had bad experiences with delivery / online orders?</div>
                                <select name="had_bad_experiences" class="form-select" onchange="toggleBadExperience(this.value)">
                                    <option value="">-- Select --</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>

                                <div id="badExperienceDetails" class="conditional-section mt-2">
                                    <label class="form-label">If yes, please describe</label>
                                    <textarea name="bad_experience_details" class="form-control" rows="2"></textarea>
                                </div>
                            </div>

                            <!-- Question 15 -->
                            <div class="question-group">
                                <div class="question-text">15. Would you prefer shopping from local kirana stores if they offer delivery?</div>
                                <select name="prefers_local_kirana_delivery" class="form-select">
                                    <option value="">-- Select --</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <!-- Question 16 -->
                            <div class="question-group">
                                <div class="question-text">16. Would you use a quick commerce platform if one sets up in your area?</div>
                                <select name="would_use_quick_commerce" class="form-select">
                                    <option value="">-- Select --</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    <option value="2">Maybe</option>
                                </select>
                            </div>

                            <!-- Question 17 -->
                            <div class="question-group">
                                <div class="question-text">17. How likely are you to be a repeat customer if service is good?</div>
                                <select name="repeat_customer_likelihood" class="form-select">
                                    <option value="">-- Select --</option>
                                    <option value="Very Likely">Very Likely</option>
                                    <option value="Likely">Likely</option>
                                    <option value="Neutral">Neutral</option>
                                    <option value="Unlikely">Unlikely</option>
                                    <option value="Very Unlikely">Very Unlikely</option>
                                </select>
                            </div>

                            <!-- Question 18 -->
                            <div class="question-group">
                                <div class="question-text">18. How do you plan your big grocery vs small urgent purchases?</div>
                                <textarea name="planning_big_vs_small" class="form-control" rows="2" placeholder="e.g., monthly bulk from supermarket, small items via quick commerce"></textarea>
                            </div>

                          
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-save me-2"></i>Submit Customer Form
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePlatformDetails(value) {
            const platformDetails = document.getElementById('platformDetails');
            platformDetails.style.display = value === '1' ? 'block' : 'none';
        }
    </script>

      <script>
        function togglePlatformDetails(value) {
            document.getElementById('platformDetails').style.display = value === '1' ? 'block' : 'none';
        }

        function toggleBadExperience(value) {
            document.getElementById('badExperienceDetails').style.display = value === '1' ? 'block' : 'none';
        }
    </script>
</x-layouts.app>