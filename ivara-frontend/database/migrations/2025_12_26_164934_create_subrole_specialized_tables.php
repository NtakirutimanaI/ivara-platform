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
        Schema::create('technician_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->string('brand')->nullable();
            $table->string('category')->nullable();
            $table->foreignId('technician_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('mechanic_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->string('brand')->nullable();
            $table->string('category')->nullable();
            $table->foreignId('mechanic_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tailor_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->foreignId('tailor_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('businessperson_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->foreignId('businessperson_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->string('license_plate')->unique();
            $table->string('vin')->nullable();
            $table->string('color')->nullable();
            $table->integer('mileage')->nullable();
            $table->string('owner_name');
            $table->string('contact_number');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technician_products');
        Schema::dropIfExists('mechanic_products');
        Schema::dropIfExists('tailor_products');
        Schema::dropIfExists('businessperson_products');
        Schema::dropIfExists('vehicles');
    }
};
