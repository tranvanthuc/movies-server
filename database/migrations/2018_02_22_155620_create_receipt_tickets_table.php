<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateReceiptTicketsTable.
 */
class CreateReceiptTicketsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('receipts_tickets', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('receipt_id');
            $table->integer('ticket_id');
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
		Schema::drop('receipts_tickets');
	}
}
