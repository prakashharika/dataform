<?php
// app/Http/Controllers/CustomerController.php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Question 1
            'age' => 'nullable|string|max:50',
            'gender' => 'nullable|in:Male,Female,Other',
            'income' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'household_size' => 'nullable|integer|min:1|max:20',

            // Question 2
            'living_location' => 'nullable|string',
            'shop_distance' => 'nullable|string|max:255',

            // Question 3
            'has_internet_access' => 'nullable|boolean',
            'uses_smartphone' => 'nullable|boolean',
            'uses_apps_regularly' => 'nullable|boolean',

            // Question 4
            'uses_grocery_platforms' => 'nullable|boolean',

            // Question 5 (conditional)
            'platforms_used' => 'nullable|string',
            'shopping_frequency' => 'nullable|string|max:255',
            'items_purchased' => 'nullable|string',

            // Question 6
            'aware_quick_commerce' => 'nullable|boolean',
            'known_quick_commerce_services' => 'nullable|string',

            // Question 7
            'services_available_area' => 'nullable|boolean',

            // Question 8
            'useful_situations' => 'nullable|string',

            // Question 9
            'preferred_categories' => 'nullable|string',

            // Question 10
            'quick_commerce_concerns' => 'nullable|string',

            // Question 11
            'acceptable_delivery_time' => 'nullable|string|max:255',

            // Question 12
            'extra_payment_willingness' => 'nullable|string|max:255',

            // Question 13
            'trust_factors' => 'nullable|string',

            // Question 14
            'had_bad_experiences' => 'nullable|boolean',
            'bad_experience_details' => 'nullable|string',

            // Question 15
            'prefers_local_kirana_delivery' => 'nullable|boolean',
        ]);

        // Add user_id to the validated data
        $validated['user_id'] = Auth::id();

        // Create the customer entry
        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer form submitted successfully!');
    }

    public function records(Request $request)
    {
        $search = $request->get('search');
        $userId = Auth::id();

        $customers = Customer::with('user')
            ->when($search, function ($query) use ($search) {
                return $query->where('profession', 'like', "%{$search}%")
                    ->orWhere('living_location', 'like', "%{$search}%")
                    ->orWhere('platforms_used', 'like', "%{$search}%");
            })
            ->when($userId != 1, function ($query) use ($userId) {
                // If user is NOT ID 1, only show their own records
                return $query->where('user_id', $userId);
            })
            ->latest()
            ->paginate(10);

        return view('customers.records', compact('customers'));
    }

    public function show(Customer $customer)
    {
        // Load the user relationship
        $customer->load('user');

        return view('customers.detail', compact('customer'));
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.records')->with('success', 'Customer record deleted successfully!');
    }
}