<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind(
			'App\Payfast\Interfaces\BookingRepositoryInterface',
			'App\Payfast\Repositories\Eloquent\EloquentBookingRepository'
		);

		$this->app->bind(
			'App\Payfast\Interfaces\MovieRepositoryInterface',
			'App\Payfast\Repositories\Eloquent\EloquentMovieRepository'
		);
	}
}
