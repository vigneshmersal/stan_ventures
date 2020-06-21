<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /**
     * login
     * @param  [string]  [description]
    */
    public function login() {
    	return view("auth.login");
    }

    /**
     * register
     * @param  [string]  [description]
    */
    public function register() {
    	return view("auth.register");
    }

    /**
     * userLogin
     * @param  [string]  [description]
    */
    public function userLogin(Request $request) {
    	// dd([ $request->all() ]);

    	$data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
    	]);

    	if (\Auth::attempt(array_merge($request->only('email', 'password'), ['status' => 1]))) {
    		return redirect()->route('home');
    	} else {
    		return redirect()->route('login');
    	}
    }

    /**
     * userRegister
     * @param  [string]  [description]
    */
    public function userRegister(Request $request)
    {
    	$data = $request->validate([
    		'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
    	]);

    	$user = User::create($request->only('name', 'email', 'password'));

		auth()->login($user);

		return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        \Auth::logout();
        return redirect('/login');
    }
}
