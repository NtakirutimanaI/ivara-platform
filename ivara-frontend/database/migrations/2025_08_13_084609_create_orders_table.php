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
    Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade'); // Make product optional for generic orders
    $table->string('order_number')->nullable();
    $table->decimal('total_amount', 10, 2)->default(0);
    $table->integer('quantity')->default(1);
    $table->string('payment_method')->nullable(); 
    $table->enum('status',['Pending','Approved','Rejected','Delivered','completed','Confirmed','paid'])->default('Pending');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
