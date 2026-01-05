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
        $categories = [
            'technical_repair'         => ['service', 'booking', 'provider', 'product', 'client', 'report', 'payment', 'review', 'setting'],
            'creative_lifestyle'      => ['service', 'booking', 'provider', 'product', 'client', 'report', 'payment', 'review', 'setting'],
            'transport_travel'        => ['service', 'booking', 'provider', 'vehicle', 'client', 'report', 'payment', 'review', 'setting'],
            'food_fashion'            => ['service', 'booking', 'provider', 'product', 'client', 'report', 'payment', 'review', 'setting'],
            'education_knowledge'     => ['course', 'enrollment', 'instructor', 'material', 'student', 'report', 'payment', 'review', 'setting'],
            'agriculture_environment' => ['service', 'booking', 'provider', 'product', 'client', 'report', 'payment', 'review', 'setting'],
            'other_services'          => ['service', 'booking', 'provider', 'product', 'client', 'report', 'payment', 'review', 'setting'],
        ];

        foreach ($categories as $cat => $entities) {
            foreach ($entities as $entity) {
                $tableName = $cat . '_' . $entity . 's';
                if (!Schema::hasTable($tableName)) {
                    Schema::create($tableName, function (Blueprint $table) {
                        $table->id();
                        $table->string('name');
                        $table->text('description')->nullable();
                        $table->decimal('price', 10, 2)->nullable();
                        $table->string('status')->default('active');
                        $table->timestamps();
                    });
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $categories = [
            'technical_repair',
            'creative_lifestyle',
            'transport_travel',
            'food_fashion',
            'education_knowledge',
            'agriculture_environment',
            'other_services',
        ];

        $entities = ['service', 'booking', 'provider', 'product', 'vehicle', 'course', 'enrollment', 'instructor', 'material', 'student', 'client', 'report', 'payment', 'review', 'setting'];

        foreach ($categories as $cat) {
            foreach ($entities as $entity) {
                Schema::dropIfExists($cat . '_' . $entity . 's');
            }
        }
    }
};
