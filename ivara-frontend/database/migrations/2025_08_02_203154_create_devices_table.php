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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('brand');                         // e.g. Samsung, Apple, etc.
            $table->string('model');                         // e.g. Galaxy S21, iPhone 13
            $table->string('serial_number')->unique();       // Unique identifier for the device

            // New fields for IMEIs, MAC, Product ID, etc.
            $table->string('imei_1')->nullable();            // IMEI 1
            $table->string('imei_2')->nullable();            // IMEI 2
            $table->string('imei_3_or_mac_or_plate')->nullable(); // IMEI 3 / MAC Address / Product ID / Plate Number

            $table->string('type')->nullable();              // e.g. Laptop, Phone, Tablet
            $table->string('os')->nullable();                // e.g. Android, iOS, Windows
            $table->enum('status', ['active', 'inactive', 'under_repair', 'lost', 'disposed'])->default('active');

            $table->date('purchase_date')->nullable();       // Purchase date
            $table->date('warranty_expiry')->nullable();     // Warranty expiration

            $table->string('location')->nullable();          // Device location
            $table->timestamp('last_seen_at')->nullable();   // Last scan/interaction

            $table->text('notes')->nullable();               // Extra notes

            // Foreign key relationships
            $table->unsignedBigInteger('client_id')->nullable();               // Linked client
            $table->unsignedBigInteger('assigned_technician_id')->nullable();  // Assigned technician

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('assigned_technician_id')->references('id')->on('technicians')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
