<?php

namespace Database\Seeders;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MovieSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$movies = [
			[
				'title' => 'The Marsk man',
				'slug' => Str::slug('The Marsk man'),
				'description' => 'Jim (Liam Neeson) is a former Marine who lives a solitary life as a rancher along the Arizona-Mexican border. But his peaceful existence soon comes crashing down when he tries to protect a boy on the run from members of a vicious cartel.',
				'duration' => '2h',
				'genre' => 'Action',
				'image_url' => '/images/movie/movie-1.jpeg',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'title' => 'Dinner with firend',
				'slug' => Str::slug('Dinner with firend'),
				'description' => 'Abby is looking forward to a laid-back Thanksgiving with her best friend Molly. But the friends’ plans for a quiet turkey dinner go up in smoke when they’re joined by Molly’s new boyfriend and her flamboyant mother. Throw in some party crashers including Molly’s old flame, a wannabe shaman, and a trio of Fairy Gay Mothers, and it’s a recipe for a comically chaotic holiday no one will ever forget—even if they wanted to!',
				'duration' => '1h45',
				'genre' => 'Commedy',
				'image_url' => '/images/movie/movie-2.jpeg',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		];

		DB::table('movies')->insert($movies);

		$cinemas = [
			[
				'name' => 'Payfast Movie Cinema',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		];

		DB::table('cinemas')->insert($cinemas);

		$booking_status = [
			[
				'name' => 'confirmed',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'pending',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'cancelled',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'refund',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		];

		DB::table('booking_status')->insert($booking_status);

		$cinema_locations = [
			[
				'name' => 'Capetown',
				'cinema_id' => 1,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'Joburg',
				'cinema_id' => 1,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		];

		DB::table('cinema_locations')->insert($cinema_locations);

		$theatres = [
			[
				'name' => 'Capetown Theatre 1',
				'location_id' => 1,
				'total_seats' => 30,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'Capetown Theatre 2',
				'location_id' => 1,
				'total_seats' => 30,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'Joburg Theatre 1',
				'location_id' => 2,
				'total_seats' => 30,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'Joburg Theatre 2',
				'location_id' => 2,
				'total_seats' => 30,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		];

		DB::table('theatres')->insert($theatres);

		$shows = [
			[
				'movie_id' => 1,
				'theatre_id' => 1,
				'start_time' => '2021-03-01 10:00:00',
				'end_time' => '2021-03-01 12:00:00',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'movie_id' => 2,
				'theatre_id' => 2,
				'start_time' => '2021-03-01 10:15:00',
				'end_time' => '2021-03-01 12:00:00',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'movie_id' => 1,
				'theatre_id' => 3,
				'start_time' => '2021-03-01 10:10:00',
				'end_time' => '2021-03-01 12:00:00',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'movie_id' => 2,
				'theatre_id' => 4,
				'start_time' => '2021-03-01 11:00:00',
				'end_time' => '2021-03-01 13:45:00',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],

			[
				'movie_id' => 1,
				'theatre_id' => 1,
				'start_time' => '2021-03-01 15:00:00',
				'end_time' => '2021-03-01 17:00:00',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'movie_id' => 2,
				'theatre_id' => 2,
				'start_time' => '2021-03-01 15:15:00',
				'end_time' => '2021-03-01 17:00:00',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'movie_id' => 1,
				'theatre_id' => 3,
				'start_time' => '2021-03-01 15:10:00',
				'end_time' => '2021-03-01 17:00:00',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'movie_id' => 2,
				'theatre_id' => 4,
				'start_time' => '2021-03-01 16:00:00',
				'end_time' => '2021-03-01 18:45:00',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		];

		DB::table('shows')->insert($shows);
	}
}
