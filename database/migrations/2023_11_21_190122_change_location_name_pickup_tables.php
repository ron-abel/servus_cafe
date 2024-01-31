<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pickup_times', function (Blueprint $table) {
            DB::statement("ALTER TABLE `pickup_times` CHANGE `location_name` `name` VARCHAR(255)");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pickup_times', function (Blueprint $table) {
            //
        });
    }
};
