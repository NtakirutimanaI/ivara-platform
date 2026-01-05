<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('craftsperson_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('craftsperson_id'); // linked to users table
            $table->string('name'); // product name
            $table->string('category')->nullable(); // optional category
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->integer('quantity')->default(0);
            $table->integer('min_threshold')->default(1); // for stock alerts
            $table->string('unit')->default('pcs');
            $table->enum('status', ['Available', 'Out of Stock', 'Discontinued'])->default('Available');
            $table->decimal('total_value', 12, 2)->default(0.00); // quantity * price
            $table->timestamps();

            $table->foreign('craftsperson_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('craftsperson_products');
    }
};