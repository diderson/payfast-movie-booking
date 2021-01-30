<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Movie extends Model {
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'image_url',
		'slug',
		'description',
		'duration',
		'genre',
	];

	/**
	 * Generate a URL friendly string from the brief's slug.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setSlugAttribute($value) {
		$this->attributes['slug'] = Str::slug($value);
	}

	/**
	 *  Get the shows that has movie
	 */
	public function movie_shows() {
		return $this->hasMany('App\Models\Show');
	}

}
