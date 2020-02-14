<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMealsTable extends Migration {

	public function up()
	{
		Schema::create('meals', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->text('ingredients');
			$table->string('image');
			$table->decimal('price');
			$table->decimal('price_offer')->nullable();
			$table->integer('restaurant_id')->unsigned()->nullable();
			$table->integer('classification_id')->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('meals');
	}
}