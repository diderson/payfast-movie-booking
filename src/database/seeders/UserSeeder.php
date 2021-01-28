<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		$role_1 = Role::create(['name' => 'super-admin', 'guard_name' => 'web']);
		$role_2 = Role::create(['name' => 'admin', 'guard_name' => 'web']);
		$role_3 = Role::create(['name' => 'customer', 'guard_name' => 'web']);

		$user_0 = User::create([
			'name' => 'Diderson Baka',
			'password' => Hash::make('passowrd'),
			'email' => 'ddiderson@gmail.com',
			'telephone' => '0722208700',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		])->roles()->attach(1);

		$user_1 = User::create([
			'name' => 'didi Baka',
			'password' => Hash::make('123456'),
			'email' => 'didi@gmail.com',
			'telephone' => '0722208701',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		])->roles()->attach(2);

		$user_2 = User::create([
			'name' => 'Larry George',
			'password' => Hash::make('123456'),
			'email' => 'larry@gmail.com',
			'telephone' => '0722208702',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		])->roles()->attach(3);

		// DB::table('users')->insert([
		// 	'name' => 'Larry George',
		// 	'email' => 'larry@gmail.com',
		// 	'password' => Hash::make('12password34'),
		// ]);
	}
}
