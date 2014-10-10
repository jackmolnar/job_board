<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEmployerDataToUserDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_details', function(Blueprint $table)
		{
			$table->string('employer_name', 100);
            $table->string('position_title', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_details', function(Blueprint $table)
		{
			$table->dropColumn('employer_name');
            $table->dropColumn('position_title');
		});
	}

}
