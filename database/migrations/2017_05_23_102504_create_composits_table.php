<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompositsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('composits', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('task_id');
			$table->integer('parent_id')->index();
			$table->string('descr');
			$table->timestamps();
			$table->foreign('task_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('composits');
	}

}
