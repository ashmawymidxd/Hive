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
       Schema::create('hotel_settings', function (Blueprint $table) {
            $table->id();
            // Basic Info Fields
            $table->string('hotel_name');
            $table->string('legal_business_name');
            $table->text('hotel_description');
            $table->string('phone_number');
            $table->string('email');
            $table->string('website')->nullable();
            
            // Location Fields
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('state_province');
            $table->string('zip_postal_code');
            $table->string('country');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            // Property Details
            $table->tinyInteger('star_rating')->nullable();
            $table->integer('total_rooms')->nullable();
            $table->integer('total_floors')->nullable();
            $table->integer('year_built')->nullable();
            $table->text('property_amenities')->nullable();
            $table->text('hotel_policies')->nullable();

            // Tax & Financial Information
            $table->string('tax_id')->nullable();
            $table->string('default_currency', 3)->default('USD');
            $table->decimal('vat_tax_rate', 5, 2)->nullable();
            $table->decimal('occupancy_tax_rate', 5, 2)->nullable();
            $table->decimal('service_charge_rate', 5, 2)->nullable();
            
            // Additional Fields
            $table->string('logo_path')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_settings');
    }
};
