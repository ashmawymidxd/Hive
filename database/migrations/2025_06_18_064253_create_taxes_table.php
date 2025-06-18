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
        // database/migrations/xxxx_create_taxes_table.php
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('tax_id')->unique(); // TAX-2023-001 format
            $table->string('description');
            $table->string('type'); // e.g., Sales Tax, VAT, etc.
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->enum('status', ['Filed', 'Pending', 'Paid', 'Overdue']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
