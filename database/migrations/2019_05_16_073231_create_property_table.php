<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('property_type_id');
            $table->year('year_built');
            $table->string('bed',10);
            $table->string('bath',10);
            $table->string('sq_ft',20);
            $table->float('price',10,2);
            $table->float('price_per_sq_ft',10,2);
            $table->longText('description')->nullable();
            $table->string('status',15);
			$table->integer('city_id');
			$table->integer('agent_id');
			$table->string('offer_type',20);
			$table->text('location');
			$table->string('map_latitude');
			$table->string('map_longitude');
			$table->string('image');
			$table->integer('is_featured');
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
        Schema::dropIfExists('property');
    }
}
