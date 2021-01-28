<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('show', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('movie_id')->unsigned();
			$table->foreign('movie_id')->references('id')->on('movies')
				->onDelete('restrict')
				->onUpdate('cascade');

			$table->integer('theatre_id')->unsigned();
			$table->foreign('theatre_id')->references('id')->on('theatres')
				->onDelete('restrict')
				->onUpdate('cascade');

			$table->datetime('start_time');
			$table->datetime('end_time');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('show', function (Blueprint $table) {
			$table->dropForeign('show_movie_id_foreign');
			$table->dropForeign('show_theatre_id_foreign');
		});
		Schema::dropIfExists('show');
	}
}
