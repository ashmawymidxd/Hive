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
       Schema::create('blacklisted_guests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('guest_id')->constrained()->onDelete('cascade');
        $table->foreignId('added_by')->constrained('admins')->onDelete('cascade');
        $table->string('reason');
        $table->text('notes')->nullable();
        $table->date('blacklisted_until')->nullable(); // null means permanent
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blacklisted_guests');
    }
};
