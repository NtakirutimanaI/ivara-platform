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
    Schema::create('clients', function (Blueprint $table) {
    $table->id();
    $table->string('name');                 // Full Name
    $table->string('phone');                // Primary Phone Number
    $table->string('email')->nullable();    // Optional Email Address
    $table->string('address')->nullable();  // Optional Physical Address
    $table->string('city')->nullable();     // City of residence
    $table->string('country')->default('Rwanda'); // Default country
    $table->string('national_id')->nullable(); // Optional ID number
    $table->enum('gender', ['Male', 'Female', 'Other'])->nullable(); // Optional gender
    $table->date('date_of_birth')->nullable(); // Optional birthdate
    $table->text('notes')->nullable();      // Any additional comments or notes
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
