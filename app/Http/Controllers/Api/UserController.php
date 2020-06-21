<?php

namespace App\Http\Controllers\Api;

use Helper;
use App\User;
use Exception;
use Throwable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
	 * users
	 * @param  [string]  [description]
	*/
	public function users(Request $request)
	{
		try {
		    $validator = Validator::make($request->all(),[
		    	'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            	'password' => ['required', 'string', 'min:8'],
		    ]);

		    $user = User::whereEmail($request->email)->first();

		    if (!$validator->fails()) {

		    	if (\Auth::attempt($request->only('email', 'password'))) {

		        	return \Helper::send_success_response([
		        		'name' => $user->name,
		        		'email' => $user->email,
		        		'role' => $user->role,
		        		'status' => $user->active
		        	]);

		    	} else {
                    $data = [
                    	'error' => [
	                        'user_message' => 'These credentials do not match our records.',
	                        'internal_message' => 'Email or Password is wrong.',
	                        'code' => '1003'
	                    ]
	                ];

		        	return \Helper::send_fail_response($data, $message='Unauthorized', $status="fail", 401);
		    	}

		    } else {
		        return \Helper::send_input_error_response($validator->messages()->first());
		    }

		} catch (Exception | Throwable $ex) {
		    return \Helper::exception_handling($ex);
		}
	}
}
