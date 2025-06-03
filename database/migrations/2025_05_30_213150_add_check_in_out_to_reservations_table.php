<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->timestamp('actual_check_in')->nullable();
            $table->timestamp('actual_check_out')->nullable();
            $table->enum('status', [
                'pending',
                'confirmed',
                'cancelled',
                'checked_in',
                'checked_out',
                'no_show'
            ])->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['actual_check_in', 'actual_check_out']);
            $table->enum('status', [
                'pending',
                'confirmed',
                'cancelled'
            ])->default('pending')->change();
        });
    }
};
