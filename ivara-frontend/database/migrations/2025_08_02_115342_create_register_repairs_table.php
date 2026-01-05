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
    Schema::create('register_repairs', function (Blueprint $table) {
        $table->id();

        // Basic device and customer info
        $table->string('device_name');
        $table->string('device_model')->nullable();
        $table->string('serial_number')->nullable();
        $table->string('issue_description');
        $table->string('customer_name');
        $table->string('customer_contact')->nullable();
        $table->string('customer_email')->nullable();

        // Repair details
        $table->date('date_received')->nullable();
        $table->date('expected_completion_date')->nullable();
        $table->text('diagnosis')->nullable();
        $table->text('repair_actions')->nullable();
        $table->string('repair_status')->default('pending'); // e.g., pending, in_progress, completed
        $table->decimal('repair_cost', 10, 2)->nullable();
        
        // Additional info
        $table->string('technician')->nullable();
        $table->string('warranty_status')->nullable();
        $table->text('notes')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_repairs');
    }
};
