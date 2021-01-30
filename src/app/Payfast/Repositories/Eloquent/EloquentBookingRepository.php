<?php

namespace App\Payfast\Repositories\Eloquent;

use App\Models\Booking;
use App\Payfast\Interfaces\BookingRepositoryInterface;
use DB;
use Exception;

class EloquentBookingRepository implements BookingRepositoryInterface {

	public function findAllByUserId($user_id, $limit = null) {
		$bookings = DB::table('bookings as b')
			->join('shows as s', 's.id', '=', 'b.show_id')
			->join('booking_status as bs', 'bs.id', '=', 'b.status_id')
			->join('movies as m', 'm.id', '=', 's.movie_id')
			->join('theatres as t', 't.id', '=', 's.theatre_id')
			->join('cinema_locations as l', 'l.id', '=', 't.location_id')
			->select('b.id', 'b.reference_number', 'm.title', 'm.image_url', 'b.total_seats', 's.start_time', 'l.name as location', 't.name as theatre', 'bs.name as status', 'bs.id as status_id')
			->where('b.user_id', $user_id)
			->orderBy('b.id', 'desc');

		if ($limit == null) {
			$bookings = $bookings->get();
		} else {
			$bookings = $bookings->paginate($limit);
		}

		return $bookings;
	}

	public function store($data) {
		$this->validate($data['Booking']);
		return Booking::create($data['Booking']);
	}

	public function update($id, $data) {
		$booking = $this->findById($id);
		$booking->fill($data);
		$this->validate($booking->toArray());
		$booking->save();
		return $booking;
	}

	public function validate($data) {
		$validator = Validator::make($data, Booking::$rules);
		if ($validator->fails()) {
			throw new Exception('Invalid input');
		}
		return true;
	}

	public function instance($data = array()) {
		return new Booking($data);
	}
}
