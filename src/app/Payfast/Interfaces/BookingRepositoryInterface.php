<?php

namespace App\Payfast\Interfaces;

interface BookingRepositoryInterface {

	public function findByUserId($user_id);

	public function findAllByUserId($user_id, $limit = null);

	public function store($data);

	public function update($id, $data);

	public function validate($data);

	public function instance();
}