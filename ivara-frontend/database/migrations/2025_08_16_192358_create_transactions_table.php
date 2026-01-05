<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mediator_id')->constrained('mediators')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade'); // assuming clients are in users table
            $table->string('activity_type'); // e.g., device repair, service
            $table->decimal('amount', 12, 2);
            $table->decimal('commission_percentage', 5, 2)->default(10.00);
            $table->decimal('commission_amount', 12, 2)->default(0.00);
            $table->enum('status', ['pending','paid'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
