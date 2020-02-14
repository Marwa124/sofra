<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMealOrderTable extends Migration {

	public function up()
	{
		Schema::create('meal_order', function(Blueprint $table) {
			$table->increments('id');
			$table->enum('status', array('pending', 'accepted', 'rejected', 'delivered', 'declined'));
			$table->integer('quantity')->default('1');
			$table->integer('meal_id')->unsigned();
			$table->text('note')->nullable();
			$table->integer('order_id')->unsigned();
			$table->decimal('price');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('meal_order');
	}
}