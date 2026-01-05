<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdatesTable extends Migration
{
    public function up()
    {
        Schema::create('updates', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->date('date');
            $table->string('location');
            $table->string('image')->nullable(); // optional
            $table->text('description');
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('updates');
    }
}
