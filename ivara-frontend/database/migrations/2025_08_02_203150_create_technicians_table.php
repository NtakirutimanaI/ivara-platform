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
        Schema::create('technicians', function (Blueprint $table) {
            $table->id();
            $table->string('name');                           // Technician full name
            $table->string('email')->unique()->nullable();    // Contact email
            $table->string('phone')->nullable();              // Contact phone
            $table->string('expertise');                      // Area of specialization (e.g., phones, laptops)
            $table->integer('experience_years')->nullable();  // Number of years of experience
            $table->string('certifications')->nullable();     // Any certifications
            $table->enum('status', ['active', 'inactive', 'on_leave'])->default('active'); // Availability
            $table->string('location')->nullable();           // Where they are based
            $table->text('notes')->nullable();                // Additional notes

            // New fields
            $table->date('registered_on')->nullable();        // Itariki yanditsweho
            $table->string('received_by')->nullable();        // Izina ry’uwakiriye igikoresho (staff)
            $table->string('position')->nullable();           // Umwanya / Position (in English)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technicians');
    }
};
