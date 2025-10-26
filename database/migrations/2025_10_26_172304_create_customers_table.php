<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_customers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            // User relationship
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Question 1: Personal Information
            $table->string('age')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('income')->nullable();
            $table->string('profession')->nullable();
            $table->integer('household_size')->nullable();

            // Question 2: Location Information
            $table->text('living_location')->nullable();
            $table->string('shop_distance')->nullable();

            // Question 3: Digital Access
            $table->boolean('has_internet_access')->nullable();
            $table->boolean('uses_smartphone')->nullable();
            $table->boolean('uses_apps_regularly')->nullable();

            // Question 4: Platform Usage
            $table->boolean('uses_grocery_platforms')->nullable();

            // Question 5: Platform Details (conditional)
            $table->text('platforms_used')->nullable();
            $table->string('shopping_frequency')->nullable();
            $table->text('items_purchased')->nullable();

            // Question 6: Quick Commerce Awareness
            $table->boolean('aware_quick_commerce')->nullable();
            $table->text('known_quick_commerce_services')->nullable();

            // Question 7: Service Availability
            $table->boolean('services_available_area')->nullable();

            // Question 8: Useful Situations
            $table->text('useful_situations')->nullable();

            // Question 9: Preferred Categories
            $table->text('preferred_categories')->nullable();

            // Question 10: Concerns
            $table->text('quick_commerce_concerns')->nullable();

            // Question 11: Delivery Time
            $table->string('acceptable_delivery_time')->nullable();

            // Question 12: Extra Payment Willingness
            $table->string('extra_payment_willingness')->nullable();

            // Question 13: Trust Factors
            $table->text('trust_factors')->nullable();

            // Question 14: Bad Experiences
            $table->boolean('had_bad_experiences')->nullable();
            $table->text('bad_experience_details')->nullable();

            // Question 15: Local Kirana Preference
            $table->boolean('prefers_local_kirana_delivery')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};