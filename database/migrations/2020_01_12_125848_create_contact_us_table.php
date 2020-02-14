<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactUsTable extends Migration {

	public function up()
	{
		Schema::create('contact_us', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->text('message')->nullable();
			$table->enum('type', array('complain', 'suggestion', 'inquire'));
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contact_us');
	}
}