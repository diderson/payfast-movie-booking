<?php

namespace App\Payfast\Repositories\Eloquent;

use App\Payfast\Interfaces\MovieRepositoryInterface;
use DB;

class EloquentMovieRepository implements MovieRepositoryInterface {

	/**
	 * Find movie by show_id
	 *
	 * @param $show_id
	 * @return Collection
	 */
	public function findMovieByShowId($show_id) {
		$movie = DB::table('shows as s')
			->join('movies as m', 'm.id', '=', 's.movie_id')
			->join('theatres as t', 't.id', '=', 's.theatre_id')
			->join('cinema_locations as l', 'l.id', '=', 't.location_id')
			->select('m.id', 'm.title', 'm.slug', 'm.image_url', 'm.genre', 'm.description', 's.start_time', 't.name as theatre', 'l.name as location')
			->where('s.id', '=', $show_id)
			->first();

		return $movie;
	}

	public function findByUserId($user_id) {

	}

	/**
	 * get specific movie show time in a location
	 *
	 * @param $location_id
	 * @return Collection
	 */
	public function getMovieShowTime($location_id, $movie_id) {

		$show_time_data = DB::table('shows as s')
			->join('theatres as t', 't.id', '=', 's.theatre_id')
			->join('cinema_locations as l', 'l.id', '=', 't.location_id')
			->select('s.id', DB::raw("CONCAT(DATE_FORMAT(s.start_time,'%d-%m-%Y'), ' ', DATE_FORMAT(s.start_time,'%H:%i')) AS time"))
			->where('s.movie_id', '=', $movie_id)
			->where('t.location_id', '=', $location_id)
			->groupBy('s.id', 'time')
			->orderBy('id', 'asc')
			->get();

		return $show_time_data;
	}

	/**
	 * get cinema locations by current showing movie
	 *
	 * @param $movie_id
	 * @return Collection
	 */
	public function getMovieShowLocationByMovieId($movie_id) {

		$locations_data = DB::table('shows as s')
			->join('theatres as t', 't.id', '=', 's.theatre_id')
			->join('cinema_locations as l', 'l.id', '=', 't.location_id')
			->select('l.id', 'l.name')
			->where('s.movie_id', '>=', $movie_id)
			->groupBy('l.id', 'l.name')
			->orderBy('id', 'asc')
			->get();

		return $locations_data;

	}

	/**
	 * get total booked seats in a show
	 *
	 * @param $show_id
	 * @return Collection
	 */
	public function getMovieShowTotalBookedSeats($show_id) {

		$show_total_seats = DB::table('shows as s')
			->join('theatres as t', 't.id', '=', 's.theatre_id')
			->join('bookings as b', 'b.show_id', '=', 's.id')
			->where('b.status_id', 1)
			->where('b.show_id', $show_id)
			->sum('b.total_seats');

		return $show_total_seats;

	}

	public function getTheatreTotalSeats($location_id) {
		$total_seats = 0;
		$theatre = DB::table('cinema_locations as c')
			->join('theatres as t', 't.location_id', '=', 'c.id')
			->select('t.total_seats')
			->where('t.location_id', $location_id)
			->first();

		if ($theatre) {
			$total_seats = $theatre->total_seats;
		}

		return $total_seats;
	}

	/**
	 * get current showing movie at the cinema
	 *
	 * @return Collection
	 */
	public function getCurrentShowingMovies() {
		$movies = DB::table('shows as s')
			->join('movies as m', 'm.id', '=', 's.movie_id')
			->select('m.id', 'm.title', 'm.slug', 'm.image_url', 'm.genre', 'm.description')
			->where('s.end_time', '>=', date('Y-m-d'))
			->groupBy('m.id', 'm.title', 'm.slug', 'm.image_url', 'm.genre', 'm.description')
			->orderBy('id', 'asc')
			->get();

		return $movies;
	}

	public function update($id, $data) {

	}

	public function destroy($id) {

	}

	public function validate($data) {

	}

	public function instance() {

	}
}