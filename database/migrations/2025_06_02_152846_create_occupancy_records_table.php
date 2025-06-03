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
      // In the generated migration file
        Schema::create('occupancy_records', function (Blueprint $table) {
            $table->id();
            $table->date('record_date')->unique();
            $table->decimal('occupancy_rate', 5, 2); // Stores percentage with 2 decimal places
            $table->integer('occupied_rooms');
            $table->integer('total_rooms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupancy_records');
    }
};
