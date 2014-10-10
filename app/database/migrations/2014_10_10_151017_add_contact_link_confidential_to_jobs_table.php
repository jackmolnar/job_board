<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddContactLinkConfidentialToJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jobs', function(Blueprint $table)
		{
			$table->string('contact_link', 100);
			$table->string('contact_email', 100);
            $table->boolean('confidential');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('jobs', function(Blueprint $table)
		{
			$table->dropColumn('contact_link');
			$table->dropColumn('contact_email');
            $table->dropColumn('confidential');
		});
	}

}
