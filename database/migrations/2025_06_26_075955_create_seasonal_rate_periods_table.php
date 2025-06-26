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
        Schema::create('seasonal_rate_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Regular Season"
            $table->date('start_date');
            $table->date('end_date');
            $table->string('rate_adjustment_type'); // 'percentage', 'fixed', 'base_rate'
            $table->decimal('rate_adjustment_value', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasonal_rate_periods');
    }
};
