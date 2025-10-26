<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_reference_video_link_to_shop_research_forms.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('shop_research_forms', function (Blueprint $table) {
            $table->string('reference_video_link')->nullable()->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('shop_research_forms', function (Blueprint $table) {
            $table->dropColumn('reference_video_link');
        });
    }
};