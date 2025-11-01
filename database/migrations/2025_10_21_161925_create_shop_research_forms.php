<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('shop_research_forms', function (Blueprint $table) {
            $table->id();

            // Step 1: Shop Details
            $table->string('shop_name');
            $table->string('client_name');
            $table->string('mobile_number');
            $table->string('email');
            $table->string('business_type');
            $table->text('shop_address');

            // Step 2: Retailer Questions
            $table->string('shop_type')->nullable();
            $table->integer('number_of_employees')->nullable();
            $table->string('shop_floor_size')->nullable();
            $table->string('monthly_turnover')->nullable();
            $table->integer('customers_per_day')->nullable();
            $table->string('operating_since')->nullable();
            $table->boolean('enrolled_in_ecommerce')->nullable();
            $table->text('ecommerce_platforms')->nullable();
            $table->string('ecommerce_usage_duration')->nullable();
            $table->integer('offline_sales_percentage')->nullable();
            $table->integer('online_sales_percentage')->nullable();
            $table->text('order_reception_methods')->nullable();
            $table->boolean('knows_quick_commerce')->nullable();
            $table->boolean('participates_quick_commerce')->nullable();
            $table->text('quick_commerce_effect')->nullable();
            $table->text('barriers_not_participating')->nullable();
            $table->boolean('willing_to_partner')->nullable();
            $table->text('required_incentives')->nullable();
            $table->text('concerns_about_platform')->nullable();
            $table->string('digital_orders_handling')->nullable();
            $table->boolean('customers_ask_delivery')->nullable();
            $table->boolean('local_delivery_exists')->nullable();
            $table->string('delivery_cost')->nullable();
            $table->boolean('stock_variety_adequate')->nullable();
            $table->string('delivery_radius')->nullable();
            $table->boolean('digital_assistance_available')->nullable();
            $table->boolean('comfortable_with_apps')->nullable();
            $table->string('product_margins')->nullable();
            $table->string('cost_absorption_ability')->nullable();
            $table->text('quick_commerce_future_view')->nullable();
            $table->text('viability_changes')->nullable();

            // Step 3: Consumer Questions
            $table->string('consumer_age')->nullable();
            $table->string('consumer_gender')->nullable();
            $table->string('consumer_income')->nullable();
            $table->string('consumer_profession')->nullable();
            $table->integer('household_size')->nullable();
            $table->text('living_location')->nullable();
            $table->string('shop_distance')->nullable();
            $table->boolean('has_internet_access')->nullable();
            $table->boolean('uses_smartphone')->nullable();
            $table->boolean('uses_apps_regularly')->nullable();
            $table->boolean('uses_grocery_platforms')->nullable();
            $table->text('platforms_used')->nullable();
            $table->string('shopping_frequency')->nullable();
            $table->text('items_purchased')->nullable();
            $table->boolean('aware_quick_commerce')->nullable();
            $table->text('known_quick_commerce_services')->nullable();
            $table->boolean('services_available_area')->nullable();
            $table->text('useful_situations')->nullable();
            $table->text('preferred_categories')->nullable();
            $table->text('quick_commerce_concerns')->nullable();
            $table->string('acceptable_delivery_time')->nullable();
            $table->string('extra_payment_willingness')->nullable();
            $table->text('trust_factors')->nullable();
            $table->boolean('had_bad_experiences')->nullable();
            $table->text('bad_experience_details')->nullable();
            $table->boolean('prefers_local_kirana_delivery')->nullable();
            $table->boolean('would_use_quick_commerce')->nullable();
            $table->string('repeat_customer_likelihood')->nullable();
            $table->text('purchase_planning_method')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shop_research_forms');
    }
};