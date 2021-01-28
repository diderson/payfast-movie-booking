<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToMoviesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('movies', function (Blueprint $table) {
			$table->string('slug')->after('title');
			$table->unique('slug', 'unique_slug');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('movies', function (Blueprint $table) {
			$table->dropUnique('unique_slug');
			$table->dropColumn('slug');
		});
	}
}
