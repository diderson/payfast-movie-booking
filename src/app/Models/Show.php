<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model {
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'start_time',
		'end_time',
	];

	/**
	 * Get the movie that owns the show.
	 */
	public function movie() {
		return $this->belongsTo('App\Models\Movie');
	}

	/**
	 * Get the theatre that owns the show.
	 */
	public function theatre() {
		return $this->belongsTo('App\Models\Theatre');
	}
}
