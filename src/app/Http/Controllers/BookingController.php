<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Payfast\Interfaces\BookingRepositoryInterface;
use App\Payfast\Interfaces\MovieRepositoryInterface;
use App\Traits\GenerateBookingNumber;
use DB;
use Illuminate\Http\Request;

class BookingController extends Controller {

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
		$bookings = [];
		$user = auth()->user();
		$bookings = $this->bookingRepository->findAllByUserId($user->id, 20);

		return view('my_booking', compact('bookings'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {

		$bookin_data = $request->all();

		if (isset($bookin_data['movie_id'])) {
			$this->emptyBookingSession($request);

			$movie_id = $bookin_data['movie_id'];
			$location_id = $bookin_data['location_id'];
			$show_id = $bookin_data['show_id'];
			$total_seats = $bookin_data['total_seats'];
			$reference_number = $this->getBookingNumber();

			$request->session()->put('reference_number', $reference_number);
			$request->session()->put('movie_id', $movie_id);
			$request->session()->put('location_id', $location_id);
			$request->session()->put('show_id', $show_id);
			$request->session()->put('total_seats', $total_seats);
			$request->session()->put('referrer-url', '/booking-confirmation');
		}

		if (!auth()->user()) {
			return redirect('/login');
		}

		return redirect('/booking-confirmation');

	}

	/**
	 * save current booking in DB and show confirmation
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function confirmation(Request $request) {

		//if there is no booking data redirect to home
		if (!$request->session()->has('reference_number')) {
			return redirect('/');
		}

		$reference_number = $request->session()->get('reference_number');
		$movie_id = $request->session()->get('movie_id');
		$location_id = $request->session()->get('location_id');
		$show_id = $request->session()->get('show_id');
		$total_seats = $request->session()->get('total_seats');

		$user = auth()->user();

		$booking = Booking::create([
			'reference_number' => $reference_number,
			'total_seats' => $total_seats,
			'show_id' => $show_id,
			'user_id' => $user->id,
			'status_id' => 1,
		]);

		$movie = $this->movieRepository->findMovieByShowId($show_id);

		$this->emptyBookingSession($request);

		return view('booking_confirmation', compact('booking', 'movie'));
	}

	/**
	 * Cancel booking
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Illuminate\Http\Request  $reference_number
	 * @return \Illuminate\Http\Response
	 */
	public function cancel(Request $request, $reference_number) {

		$booking = Booking::where('reference_number', $reference_number)->first();
		if ($booking) {
			$booking->status_id = 3;
			$booking_data = $booking->toArray();
			$booking->update($booking_data);
		}
		return redirect('/my-booking');
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
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
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
