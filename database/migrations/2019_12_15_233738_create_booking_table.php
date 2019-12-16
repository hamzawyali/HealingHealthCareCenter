<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('booking', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('patient_id');
			$table->integer('medical_services_id');
			$table->string('notes', 500)->nullable();
			$table->dateTime('date_time');
			$table->softDeletes();
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
		Schema::drop('booking');
	}

}
