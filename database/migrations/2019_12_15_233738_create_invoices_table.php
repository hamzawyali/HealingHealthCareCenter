<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('agent_id')->index('agent_invoice');
			$table->integer('patient_id');
			$table->enum('status', array('pending','paid'));
			$table->float('original_amount');
			$table->float('discount')->nullable();
			$table->float('total_amount');
			$table->boolean('is_notification')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('invoices');
	}

}
