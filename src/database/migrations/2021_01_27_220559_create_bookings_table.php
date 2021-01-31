<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('bookings', function (Blueprint $table) {
			$table->increments('id');
			$table->string('reference_number');
			$table->integer('total_seats');

			$table->integer('show_id')->unsigned();
			$table->foreign('show_id')->references('id')->on('shows')
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users');

			$table->integer('status_id')->unsigned();
			$table->foreign('status_id')->references('id')->on('booking_status')
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::table('bookings', function (Blueprint $table) {
			$table->dropForeign('bookings_show_id_foreign');
			$table->dropForeign('bookings_user_id_foreign');
			$table->dropForeign('bookings_status_id_foreign');
		});
		Schema::dropIfExists('bookings');
	}
}
