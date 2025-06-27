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
        Schema::create('system_preferences', function (Blueprint $table) {
            $table->id();
            // Regional Settings
            $table->string('default_language')->default('en');
            $table->string('timezone')->default('UTC');
            $table->string('date_format')->default('Y-m-d');
            $table->string('currency_format')->default('$0,0.00');
            $table->string('measurement_system')->default('metric');

            // User Interface
            $table->string('ui_theme_color')->default('cyan');
            $table->string('default_loader')->default('elegant_spinner');
            $table->boolean('compact_mode')->default(false);
            $table->boolean('auto_refresh_dashboard')->default(true);
            $table->boolean('enable_animations')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_preferences');
    }
};
