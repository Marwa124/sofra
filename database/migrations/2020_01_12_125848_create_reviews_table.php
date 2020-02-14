<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration {

	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->text('comment')->nullable();
			$table->enum('rate', array('1', '2', '3', '4', '5'));
			$table->integer('reviewable_id');
			$table->string('reviewable_type');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('reviews');
	}
}
