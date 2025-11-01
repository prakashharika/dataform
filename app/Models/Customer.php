<?php
// app/Models/Customer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
<<<<<<< HEAD

        // Question 1
=======
>>>>>>> e138d49 (Updated project with local changes)
        'age',
        'gender',
        'income',
        'profession',
        'household_size',
<<<<<<< HEAD

        // Question 2
        'living_location',
        'shop_distance',

        // Question 3
        'has_internet_access',
        'uses_smartphone',
        'uses_apps_regularly',

        // Question 4
        'uses_grocery_platforms',

        // Question 5
        'platforms_used',
        'shopping_frequency',
        'items_purchased',

        // Question 6
        'aware_quick_commerce',
        'known_quick_commerce_services',

        // Question 7
        'services_available_area',

        // Question 8
        'useful_situations',

        // Question 9
        'preferred_categories',

        // Question 10
        'quick_commerce_concerns',

        // Question 11
        'acceptable_delivery_time',

        // Question 12
        'extra_payment_willingness',

        // Question 13
        'trust_factors',

        // Question 14
        'had_bad_experiences',
        'bad_experience_details',

        // Question 15
        'prefers_local_kirana_delivery',
    ];

=======
        'living_location',
        'shop_distance',
        'has_internet_access',
        'uses_smartphone',
        'uses_apps_regularly',
        'uses_grocery_platforms',
        'platforms_used',
        'shopping_frequency',
        'items_purchased',
        'aware_quick_commerce',
        'known_quick_commerce_services',
        // Newly added (Q7–Q18)
        'services_available_area',
        'useful_situations',
        'preferred_categories',
        'quick_commerce_concerns',
        'acceptable_delivery_time',
        'extra_payment_willingness',
        'trust_factors',
        'had_bad_experiences',
        'bad_experience_details',
        'prefers_local_kirana_delivery',
        'would_use_quick_commerce',
        'repeat_customer_likelihood',
        'planning_big_vs_small',
    ];


>>>>>>> e138d49 (Updated project with local changes)
    protected $casts = [
        'has_internet_access' => 'boolean',
        'uses_smartphone' => 'boolean',
        'uses_apps_regularly' => 'boolean',
        'uses_grocery_platforms' => 'boolean',
        'aware_quick_commerce' => 'boolean',
        'services_available_area' => 'boolean',
        'had_bad_experiences' => 'boolean',
        'prefers_local_kirana_delivery' => 'boolean',
    ];

    /**
     * Get the user that owns the customer record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}