<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nomor');
			$table->integer('promo_id');		
			$table->integer('distributor_id');
			$table->string('status',100)->nullable();
			$table->string('payment_method',100)->nullable();
			$table->integer('price')->nullable();
			$table->integer('ppn')->nullable();
			$table->integer('administration_fee')->nullable();
			$table->integer('surat_jalan')->nullable();
			$table->integer('management_fee')->nullable();
			$table->integer('legal_fee')->nullable();
			$table->integer('discount')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('approved_by')->nullable();
			$table->date('approved_date')->nullable();
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
        Schema::dropIfExists('claim');
    }
}
