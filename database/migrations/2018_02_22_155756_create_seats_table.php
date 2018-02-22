<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSeatsTable.
 */
class CreateSeatsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seats', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('type_seat_id');
            $table->string('name');
            $table->tinyInteger('status')->default(1);
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
		Schema::drop('seats');
	}
}
