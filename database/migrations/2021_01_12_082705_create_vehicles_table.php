<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_available')->default(1);
            $table->text('vehicle_image')->nullable();
            $table->string('name');
            $table->string('brand');
            $table->string('model');
            $table->integer('year_model');
            $table->integer('mileage_km');
            $table->string('vehicle_type');
            $table->string('vehicle_category');
            $table->string('registration_number');
            $table->double('body_mass')->nullable();
            $table->double('engine_capacity');
            $table->integer('power_kw');
            $table->double('average_consumption')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
