<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Questions 7–18
            $table->string('would_use_quick_commerce')->nullable()->after('prefers_local_kirana_delivery');
            $table->string('repeat_customer_likelihood')->nullable()->after('would_use_quick_commerce');
            $table->text('planning_big_vs_small')->nullable()->after('repeat_customer_likelihood');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([

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
            ]);
        });
    }
};
