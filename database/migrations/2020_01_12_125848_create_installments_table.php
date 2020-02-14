<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstallmentsTable extends Migration {

	public function up()
	{
		Schema::create('installments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('restaurant_id')->nullable();
			$table->float('amount');
			$table->timestamp('date');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('installments');
	}
}