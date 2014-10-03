<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobProgramTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_program', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_id')->unsigned()->index();
			$table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
			$table->integer('program_id')->unsigned()->index();
			$table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
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
		Schema::drop('job_program');
	}

}
