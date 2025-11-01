<?php
// app/Models/ShopResearchForm.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShopResearchForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Add user_id to fillable
        // Step 1
        'shop_name',
        'reference_video_link',
        'client_name',
        'mobile_number',
        'email',
        'business_type',
        'shop_address',

        // Step 2 - Retailer Questions
        'shop_type',
        'number_of_employees',
        'shop_floor_size',
        'monthly_turnover',
        'customers_per_day',
        'operating_since',
        'enrolled_in_ecommerce',
        'ecommerce_platforms',
        'ecommerce_usage_duration',
        'offline_sales_percentage',
        'online_sales_percentage',
        'order_reception_methods',
        'knows_quick_commerce',
        'participates_quick_commerce',
        'quick_commerce_effect',
        'barriers_not_participating',
        'willing_to_partner',
        'required_incentives',
        'concerns_about_platform',
        'digital_orders_handling',
        'customers_ask_delivery',
        'local_delivery_exists',
        'delivery_cost',
        'stock_variety_adequate',
        'delivery_radius',
        'digital_assistance_available',
        'comfortable_with_apps',
        'product_margins',
        'cost_absorption_ability',
        'quick_commerce_future_view',
        'viability_changes',

        // Step 3 - Consumer Questions
        'consumer_age',
        'consumer_gender',
        'consumer_income',
        'consumer_profession',
        'household_size',
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
        'purchase_planning_method'
    ];

    protected $casts = [
        'enrolled_in_ecommerce' => 'boolean',
        'knows_quick_commerce' => 'boolean',
        'participates_quick_commerce' => 'boolean',
        'willing_to_partner' => 'boolean',
        'customers_ask_delivery' => 'boolean',
        'local_delivery_exists' => 'boolean',
        'stock_variety_adequate' => 'boolean',
        'digital_assistance_available' => 'boolean',
        'comfortable_with_apps' => 'boolean',
        'has_internet_access' => 'boolean',
        'uses_smartphone' => 'boolean',
        'uses_apps_regularly' => 'boolean',
        'uses_grocery_platforms' => 'boolean',
        'aware_quick_commerce' => 'boolean',
        'services_available_area' => 'boolean',
        'had_bad_experiences' => 'boolean',
        'prefers_local_kirana_delivery' => 'boolean',
        'would_use_quick_commerce' => 'boolean',
    ];

    /**
     * Get the user that owns the form submission.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}