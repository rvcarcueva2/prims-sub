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
        Schema::create('appointment_history', function (Blueprint $table) {
            $table->id();  // Primary key

            // Appointment History Table
            $table->string('student_number');
            $table->text('date');
            $table->text('time');
            $table->text('nurse_doctor');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_history');
    }
};
