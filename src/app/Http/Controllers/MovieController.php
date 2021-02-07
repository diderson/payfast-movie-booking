<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Show;
use App\Models\Theatre;
use App\Payfast\Interfaces\BookingRepositoryInterface;
use App\Payfast\Interfaces\MovieRepositoryInterface;
use App\Traits\GenerateBookingNumber;
use Illuminate\Http\Request;
use Response;

class MovieController extends Controller {
	use GenerateBookingNumber;

	private $bookingRepository;
	private $movieRepository;

	public function __construct(BookingRepositoryInterface $bookingRepository, MovieRepositoryInterface $movieRepository) {
		$this->bookingRepository = $bookingRepository;
		$this->movieRepository = $movieRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//get movies that has show currently running
		$movies = $this->movieRepository->getCurrentShowingMovies();

		/*
			* Codes sample for my test
		*/

		//exit('diderson baka');

		return view('home', compact('movies'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $slug
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug) {
		$movie = Movie::where('slug', $slug)->first();
		$cinema_locations = [];

		if ($movie) {
			//get location that is currently showing the movie
			$locations_data = $this->movieRepository->getMovieShowLocationByMovieId($movie->id);

			$cinema_locations = $locations_data->pluck('name', 'id');
		}
		return view('view_movie', compact('movie', 'cinema_locations'));
	}

	/**
	 * get show time of the movie using AJAX
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Illuminate\Http\Request  $location_id
	 * @return \Illuminate\Http\Response
	 */
	public function getShowTime(Request $request, $location_id, $movie_id) {
		$result = [];

		if ($request->ajax()) {
			//getting show time by movie and location
			$show_time_data = $this->movieRepository->getMovieShowTime($location_id, $movie_id);

			$result = $show_time_data->pluck('time', 'id');
		}

		return Response::json($result);
	}

	/**
	 * get available seats in the show sing AJAX
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Illuminate\Http\Request  $location_id
	 * @return \Illuminate\Http\Response
	 */
	public function getAvailableSeat(Request $request, $location_id, $show_id) {

		$results = ['0' => 'Ticket not available'];

		//calculating available seat for the show in the theatre
		if ($request->ajax()) {
			$total_seats = $this->movieRepository->getTheatreTotalSeats($location_id);
			$show_total_seats = $this->movieRepository->getMovieShowTotalBookedSeats($show_id);

			# constructing the dropdown list for avaibale seat
			if ($show_total_seats < $total_seats) {
				$results = [];
				$available_seat = $total_seats - $show_total_seats;
				for ($i = 0; $i < $available_seat; $i++) {
					$x = $i + 1;
					$results[$x] = $x;
				}
			}
		}

		return Response::json($results);
	}

	/**
	 * get Theatre in a location
	 *
	 * @param  \Illuminate\Http\Request  $location_id
	 * @return \Illuminate\Http\Response
	 */
	public function getTheatreByLocation(Request $request, $location_id) {
		$result = [];

		if ($request->ajax()) {
			$theatre_data = Theatre::where('location_id', $location_id)->get();
			$result = $theatre_data->pluck('name', 'id');
		}

		return Response::json($result);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
