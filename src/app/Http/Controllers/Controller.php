<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function emptyBookingSession($request) {
		$request->session()->forget('reference_number');
		$request->session()->forget('movie_id');
		$request->session()->forget('location_id');
		$request->session()->forget('show_id');
		$request->session()->forget('total_seats');
		$request->session()->forget('booking-next-step');
	}
}
