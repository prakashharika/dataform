<?php
// app/Http/Controllers/FormController.php

namespace App\Http\Controllers;

use App\Models\ShopResearchForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Step 1 Validation
            'shop_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'email' => 'required|email',
            'business_type' => 'required|string',
            'shop_address' => 'required|string',

            // Step 2 Validation
            'shop_type' => 'nullable|string',
            'number_of_employees' => 'nullable|integer|min:0',
            'shop_floor_size' => 'nullable|string|max:255',
            'monthly_turnover' => 'nullable|string|max:255',
            'customers_per_day' => 'nullable|integer|min:0',
            'operating_since' => 'nullable|string|max:255',
            'enrolled_in_ecommerce' => 'nullable|boolean',
            'ecommerce_platforms' => 'nullable|string',
            'ecommerce_usage_duration' => 'nullable|string|max:255',
            'offline_sales_percentage' => 'nullable|integer|min:0|max:100',
            'online_sales_percentage' => 'nullable|integer|min:0|max:100',
            'order_reception_methods' => 'nullable|string',
            'knows_quick_commerce' => 'nullable|boolean',
            'participates_quick_commerce' => 'nullable|boolean',
            'quick_commerce_effect' => 'nullable|string',
            'barriers_not_participating' => 'nullable|string',
            'willing_to_partner' => 'nullable|boolean',
            'required_incentives' => 'nullable|string',
            'concerns_about_platform' => 'nullable|string',
            'digital_orders_handling' => 'nullable|string|max:255',
            'customers_ask_delivery' => 'nullable|boolean',
            'local_delivery_exists' => 'nullable|boolean',
            'delivery_cost' => 'nullable|string|max:255',
            'stock_variety_adequate' => 'nullable|boolean',
            'delivery_radius' => 'nullable|string|max:255',
            'digital_assistance_available' => 'nullable|boolean',
            'comfortable_with_apps' => 'nullable|boolean',
            'product_margins' => 'nullable|string|max:255',
            'cost_absorption_ability' => 'nullable|string|max:255',
            'quick_commerce_future_view' => 'nullable|string',
            'viability_changes' => 'nullable|string',

            // Step 3 Validation
            'consumer_age' => 'nullable|string|max:255',
            'consumer_gender' => 'nullable|string|max:255',
            'consumer_income' => 'nullable|string|max:255',
            'consumer_profession' => 'nullable|string|max:255',
            'household_size' => 'nullable|integer|min:1',
            'living_location' => 'nullable|string',
            'shop_distance' => 'nullable|string|max:255',
            'has_internet_access' => 'nullable|boolean',
            'uses_smartphone' => 'nullable|boolean',
            'uses_apps_regularly' => 'nullable|boolean',
            'uses_grocery_platforms' => 'nullable|boolean',
            'platforms_used' => 'nullable|string',
            'shopping_frequency' => 'nullable|string|max:255',
            'items_purchased' => 'nullable|string',
            'aware_quick_commerce' => 'nullable|boolean',
            'known_quick_commerce_services' => 'nullable|string',
            'services_available_area' => 'nullable|boolean',
            'useful_situations' => 'nullable|string',
            'preferred_categories' => 'nullable|string',
            'quick_commerce_concerns' => 'nullable|string',
            'acceptable_delivery_time' => 'nullable|string|max:255',
            'extra_payment_willingness' => 'nullable|string|max:255',
            'trust_factors' => 'nullable|string',
            'had_bad_experiences' => 'nullable|boolean',
            'bad_experience_details' => 'nullable|string',
            'prefers_local_kirana_delivery' => 'nullable|boolean',
            'would_use_quick_commerce' => 'nullable|boolean',
            'repeat_customer_likelihood' => 'nullable|string|max:255',
            'purchase_planning_method' => 'nullable|string',
        ]);

        // Add user_id to the validated data
        $validated['user_id'] = Auth::id();

        // Create the form entry
        ShopResearchForm::create($validated);

        return redirect()->route('form.index')->with('success', 'Form submitted successfully!');
    }

    public function record(Request $request)
    {
        $search = $request->get('search');
        $businessType = $request->get('business_type');
        $userId = Auth::id();

        $records = ShopResearchForm::with('user') // Eager load user relationship
            ->when($search, function ($query) use ($search) {
                return $query->where('shop_name', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('mobile_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($businessType, function ($query) use ($businessType) {
                return $query->where('business_type', $businessType);
            })
            ->when($userId != 1, function ($query) use ($userId) {
                // If user is NOT ID 1, only show their own records
                return $query->where('user_id', $userId);
            })
            // If user IS ID 1, no user filter is applied (shows all records)
            ->latest()
            ->paginate(10);

        $businessTypes = ShopResearchForm::distinct()->pluck('business_type')->filter();

        return view('records', compact('records', 'businessTypes'));
    }
    public function charts()
    {
        // Only allow user ID 1 to access charts
        if (Auth::id() != 1) {
            abort(403, 'Unauthorized access.');
        }

        // Business Type Distribution
        $businessTypeStats = ShopResearchForm::select('business_type', DB::raw('count(*) as count'))
            ->groupBy('business_type')
            ->orderBy('count', 'desc')
            ->get();

        // E-commerce Enrollment Stats
        $ecommerceStats = ShopResearchForm::select(
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN enrolled_in_ecommerce = 1 THEN 1 ELSE 0 END) as enrolled'),
            DB::raw('SUM(CASE WHEN enrolled_in_ecommerce = 0 THEN 1 ELSE 0 END) as not_enrolled')
        )->first();

        // Quick Commerce Participation
        $quickCommerceStats = ShopResearchForm::select(
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN knows_quick_commerce = 1 THEN 1 ELSE 0 END) as aware'),
            DB::raw('SUM(CASE WHEN participates_quick_commerce = 1 THEN 1 ELSE 0 END) as participating'),
            DB::raw('SUM(CASE WHEN willing_to_partner = 1 THEN 1 ELSE 0 END) as willing_to_partner')
        )->first();

        // Monthly Submissions Trend
        $monthlySubmissions = ShopResearchForm::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Shop Type Distribution
        $shopTypeStats = ShopResearchForm::whereNotNull('shop_type')
            ->select('shop_type', DB::raw('count(*) as count'))
            ->groupBy('shop_type')
            ->orderBy('count', 'desc')
            ->get();

        // Consumer Quick Commerce Willingness - Only count records where this field is not null
        $consumerWillingness = ShopResearchForm::whereNotNull('would_use_quick_commerce')
            ->select(
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN would_use_quick_commerce = 1 THEN 1 ELSE 0 END) as willing'),
                DB::raw('SUM(CASE WHEN would_use_quick_commerce = 0 THEN 1 ELSE 0 END) as not_willing')
            )->first();

        // User Submission Stats
        $userStats = User::withCount('shopResearchForms')
            ->has('shopResearchForms', '>', 0)
            ->orderBy('shop_research_forms_count', 'desc')
            ->get();

        // Calculate percentages safely
        $ecommercePercentage = $ecommerceStats && $ecommerceStats->total > 0 ?
            round(($ecommerceStats->enrolled / $ecommerceStats->total) * 100, 1) : 0;

        $quickCommercePercentage = $quickCommerceStats && $quickCommerceStats->total > 0 ?
            round(($quickCommerceStats->willing_to_partner / $quickCommerceStats->total) * 100, 1) : 0;

        $consumerWillingnessPercentage = $consumerWillingness && $consumerWillingness->total > 0 ?
            round(($consumerWillingness->willing / $consumerWillingness->total) * 100, 1) : 0;

        return view('charts', compact(
            'businessTypeStats',
            'ecommerceStats',
            'quickCommerceStats',
            'monthlySubmissions',
            'shopTypeStats',
            'consumerWillingness',
            'userStats',
            'ecommercePercentage',
            'quickCommercePercentage',
            'consumerWillingnessPercentage'
        ));
    }

    public function show(ShopResearchForm $record)
    {
        // Load the user relationship
        $record->load('user');

        return view('record-detail', compact('record'));
    }

    public function destroy(ShopResearchForm $record)
    {
        // Optional: Add authorization check
        // $this->authorize('delete', $record);

        $record->delete();

        return redirect()->route('form.record')->with('success', 'Record deleted successfully!');
    }
}