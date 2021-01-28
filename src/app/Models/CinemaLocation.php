<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaLocation extends Model {
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'telephone',
		'email',
		'address',
		'total_theatre',
	];

	/**
	 *  Get the cinema that owns the location
	 */
	public function cinema() {
		return $this->belongsTo('App\Models\Cinema');
	}
}
