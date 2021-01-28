<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheatresTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('theatres', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');

			$table->integer('location_id')->unsigned();
			$table->foreign('location_id')->references('id')->on('cinema_locations')
				->onDelete('restrict')
				->onUpdate('cascade');

			$table->integer('total_seats')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::table('theatres', function (Blueprint $table) {
			$table->dropForeign('theatres_location_id_foreign');
		});
		Schema::dropIfExists('theatres');
	}
}
