<?php

namespace App\Payfast\Interfaces;

interface MovieRepositoryInterface {

	public function findMovieByShowId($show_id);

	public function findByUserId($user_id);

	public function getMovieShowTime($location_id, $movie_id);

	public function getMovieShowLocationByMovieId($movie_id);

	public function getMovieShowTotalBookedSeats($show_id);

	public function getTheatreTotalSeats($location_id);

	public function getCurrentShowingMovies();

	public function update($id, $data);

	public function destroy($id);

	public function validate($data);

	public function instance();
}