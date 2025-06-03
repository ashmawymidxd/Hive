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
        Schema::create('guest_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained()->onDelete('cascade');
            $table->foreignId('reservation_id')->nullable()->constrained();
            $table->string('type')->default('feedback'); // feedback, complaint, suggestion
            $table->string('category')->nullable(); // cleanliness, service, amenities, etc.
            $table->text('message');
            $table->enum('status', ['pending', 'acknowledged', 'resolved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_feedback');
    }
};
