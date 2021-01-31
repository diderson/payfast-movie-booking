<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller {
	/**
	 * Handle an authentication attempt.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function authenticate(Request $request) {
		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();

			$referrer = $request->session()->get('referrer-url');
			if ($referrer) {
				return redirect($referrer);
			}

			if (auth()->user()->hasRole(['super-admin', 'admin'])) {
				return redirect('/admin/dashboard');
			}

			return redirect()->intended('/');
		}

		return back()->withErrors([
			'email' => 'The provided credentials do not match our records.',
		]);
	}
}