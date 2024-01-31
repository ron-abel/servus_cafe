<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('picup_times', function (Blueprint $table) {
            Schema::rename('locations', 'pickup_times');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('picup_times', function (Blueprint $table) {
            Schema::rename('pickup_times', 'locations');
        });
    }
};
