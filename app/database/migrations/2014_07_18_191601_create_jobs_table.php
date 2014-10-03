<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('company_name');
			$table->string('company_address');
			$table->string('company_city');
			$table->integer('company_state');
			$table->text('description');
			$table->text('qualifications');
			$table->string('pay');
			$table->text('compensation_extras');
			$table->integer('experience');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobs');
	}

}
