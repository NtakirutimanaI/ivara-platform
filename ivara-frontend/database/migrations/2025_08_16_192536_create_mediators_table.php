<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediatorsTable extends Migration
{
    public function up()
    {
        Schema::create('mediators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('commission_percentage', 5, 2)->default(10);
            $table->integer('total_clients')->default(0);
            $table->decimal('total_transactions', 12, 2)->default(0.00);
            $table->enum('level', ['junior','mid','senior','super'])->default('junior');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('approved_by_admin')->default(false);
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mediators');
    }
}
