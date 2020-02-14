<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('content');
			$table->string('action')->default('pending');
			$table->integer('notifiable_id')->unsigned();
			$table->string('notifiable_type');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}
