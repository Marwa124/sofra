<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->decimal('order_limit');
			$table->decimal('delivery_fees');
			$table->string('delivery_time');
			$table->integer('district_id')->unsigned();
			$table->string('password');
			$table->string('phone')->nullable();
			$table->string('whats_up')->nullable();
			$table->time('close_time');
			$table->time('open_time');
			$table->string('image');
			$table->timestamps();
			$table->string('pin_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
