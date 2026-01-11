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
        Schema::table('subscriptions', function (Blueprint $table) {
            if (!Schema::hasColumn('subscriptions', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('subscriptions', 'plan')) {
                $table->string('plan')->nullable();
            }
            if (!Schema::hasColumn('subscriptions', 'price')) {
                $table->decimal('price', 10, 2)->default(0.00);
            }
            if (!Schema::hasColumn('subscriptions', 'start_date')) {
                $table->timestamp('start_date')->nullable();
            }
            if (!Schema::hasColumn('subscriptions', 'end_date')) {
                $table->timestamp('end_date')->nullable();
            }
            if (!Schema::hasColumn('subscriptions', 'status')) {
                $table->string('status')->default('inactive');
            }
            if (!Schema::hasColumn('subscriptions', 'client_id')) {
                $table->unsignedBigInteger('client_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'plan', 'price', 'start_date', 'end_date', 'status', 'client_id']);
        });
    }
};
