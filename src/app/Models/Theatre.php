<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theatre extends Model {
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'total_seats',
	];

	/**
	 * Get the location that owms the theatre.
	 */
	public function location() {
		return $this->belongsTo('App\Models\CinemaLocation');
	}

	/**
	 *  Get all the shows for the theatre
	 */
	public function shows() {
		return $this->belongsToMany('App\Models\Show');
	}
}
