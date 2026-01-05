<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Link to client and service
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('service_id');
            
            // Booking info
            $table->date('preferred_date')->nullable();
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled'])->default('Pending');
            $table->text('notes')->nullable();
            
            // Optional fields
            $table->decimal('price', 10, 2)->nullable();
            $table->string('duration')->nullable();
            
            $table->timestamps();

            // Foreign keys
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
