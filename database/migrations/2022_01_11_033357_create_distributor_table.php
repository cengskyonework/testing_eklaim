<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->string('id_type');
            $table->integer('id_no');
			$table->longText('address')->nullable();
			$table->text('email');
			$table->integer('region_id');
			$table->integer('npwp');
			$table->integer('hp');
			$table->longText('keterangan')->nullable();
			$table->text('jenis_usaha');
			$table->integer('status');
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
        Schema::dropIfExists('distributor');
    }
}
