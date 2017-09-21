<?php

namespace App\Http\Controllers\Auth;

use App\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Only let Admin or above use this controller
        $this->middleware('App\Http\Middleware\AdminMiddleware');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:30|unique:staff',
            'first' => 'required|string|max:50',
            'last' => 'required|string|max:50',
            'street' => 'required|string|max:50',
            'suburb' => 'required|string|max:50',
            'postCode' => 'required|string|max:4',
            'phone' => 'string|max:15',
            'dob' => 'required|date',
            'Email_Add' => 'required|string|email|max:255|unique:staff',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration (Staff member).
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Staff::create([
            'username' => $data['username'],
            'First_Name' => $data['first'],
            'Last_Name' => $data['last'],
            'Street_Address' => $data['street'],
            'Suburb' => $data['suburb'],
            'Postcode' => $data['postCode'],
            'Phone_No' => $data['phone'],
            'Email_Add' => $data['Email_Add'],
            'Position' => $data['position'],
            'Date_Birth' => $data['dob'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Override the function from Illuminate/Foundation/Auth/RegistersUsers.php
     * Duplicates that function, but without the line that logs the user in
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request) {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request, $user) ? : redirect($this->redirectPath());
    }

}
