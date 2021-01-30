<?php

namespace App\Traits;

trait GenerateBookingNumber {

	protected function getBookingNumber() {
		$or_num = 'PFS';

		$or_num .= rand(100, 999);

		$or_num .= date('idmY');

		return $or_num;
	}
}