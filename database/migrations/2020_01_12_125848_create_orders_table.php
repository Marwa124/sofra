<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->string('notes')->nullable();
      $table->integer('payment_method_id')->unsigned()->nullable();
			$table->enum('status', array('pending', 'accepted', 'rejected', 'delivered', 'declined','confirmed'));
			$table->string('price')->nullable();
			$table->decimal('app_fees')->nullable();
			$table->integer('restaurant_id')->unsigned()->nullable();
			$table->integer('client_id')->unsigned()->nullable();
			$table->decimal('total')->nullable();
			$table->decimal('net')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
