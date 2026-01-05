<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->string('device_type')->nullable();
            $table->string('device_name');
            $table->string('serial_number')->unique();
            $table->string('brand');
            $table->string('model');
            $table->string('operating_system')->nullable();
            $table->string('device_owner');
            $table->string('contact_number');
            $table->date('received_date');
            $table->enum('warranty_status', ['Under Warranty', 'Out of Warranty']);
            $table->text('problem_description');
            $table->string('technician')->nullable();
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->enum('repair_status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
}
