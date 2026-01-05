<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('craftsperson_register_repair', function (Blueprint $table) {
            $table->id();
            $table->string('craftsperson_name'); // Name of the craftsperson
            $table->string('craft_type'); // Type of craft (e.g., Carpenter, Electrician)
            $table->string('repair_item'); // Item to repair
            $table->text('repair_description')->nullable(); // Details about repair
            $table->date('repair_date'); // Date of repair
            $table->decimal('repair_cost', 10, 2)->nullable(); // Cost of repair
            $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('Pending'); // Status
            $table->string('client_name')->nullable(); // Name of client
            $table->string('client_contact')->nullable(); // Client contact info
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('craftsperson_register_repair');
    }
};
