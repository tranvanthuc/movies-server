<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMoviesTable.
 */
class CreateMoviesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movies', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('genre_id');
            $table->string('title');
            $table->text('overview');
            $table->string('background_path');
            $table->string('poster_path');
            $table->string('trailer');
            $table->string('producer');
            $table->date('release_date');
            $table->integer('runtime')->comment('minutes');
            $table->string('language');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('movies');
	}
}
