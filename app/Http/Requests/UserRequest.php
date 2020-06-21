<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if ($this->method() == "POST")
        {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'role' => 'required|string|max:255',
                'status' => 'required|integer'
            ];
        }
        else // PATCH
        {
            // dd($request->all());
            $rule = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
                'role' => 'required|string|max:255',
                'status' => 'required|integer'
            ];

            if ($request->filled('password')) {
                $rule['password'] = 'required|string|min:6|confirmed';
            }

            return $rule;
        }
    }
}
