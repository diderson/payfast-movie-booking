<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaLocationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('cinema_locations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('cinema_id')->unsigned();
			$table->foreign('cinema_id')->references('id')->on('cinemas')
				->onDelete('restrict')
				->onUpdate('cascade');

			$table->string('name');
			$table->string('telephone')->nullable();
			$table->string('email')->nullable();
			$table->text('address')->nullable();
			$table->integer('total_theatre')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('cinema_locations', function (Blueprint $table) {
			$table->dropForeign('cinema_locations_cinema_id_foreign');
		});
		Schema::dropIfExists('cinema_locations');
	}
}
