<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session,Hash;

class AuthController extends Controller
{
	public function v_login()
	{
		return view('auth.login');
	}

	public function login(Request $request)
	{
		$cek = user::where([
			'username'	=>	$request->username,
		])->first();
		if (!empty($cek)) {
			if (Hash::check($request->password, $cek->password)) {
				Session::put([
					'id_user'	=>	$cek->id,
					'level'		=>	$cek->level
				]);
				return back();
			}else{
				return back()->with('error','Akun tidak ditemukan');
			}
		}else{
			return back()->with('error','Akun tidak ditemukan');
		}
	}

	public function logout()
	{
		session::flush();
		return back();
	}

	public function dashboard()
	{
		return view(session('level').'.dashboard');
	}
}
