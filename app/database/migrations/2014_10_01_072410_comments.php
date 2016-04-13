<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::Create('comments', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->string('commenter');
            $table->string('email');
            $table->text('comment');
            $table->boolean('approved');
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
		Schema::table('comments', function(Blueprint $table)
		{
			//
            Schema::drop('comments');
		});
	}

}
