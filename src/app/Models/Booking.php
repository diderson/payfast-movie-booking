<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'reference_number',
		'total_seats',
	];

	/**
	 * Get the show that owns the booking.
	 */
	public function show() {
		return $this->belongsTo('App\Models\Show');
	}

	/**
	 * Get the user that owns the booking.
	 */
	public function user() {
		return $this->belongsTo('App\Models\User');
	}
}
