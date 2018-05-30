<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/register/thanks';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('front.register.index');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'lastName' => 'required|string',
            'firstName' => 'required|string',
            'lastNameKana' => 'required|string',
            'firstNameKana' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'mobileOne' => '',
            'mobileTwo' => '',
            'mobileThree' => '',
            'telOne' => '',
            'telTwo' => '',
            'telThree' => '',
            'zipCodeOne' => ['required', 'regex:/^[0-9]{3}$/'],
            'zipCodeTwo' => ['required', 'regex:/^[0-9]{4}$/'],
            'prefecture' => 'required|numeric|between:0,47',
            'addressOne' => 'required',
            'addressTwo' => '',
            'password' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['lastName'] .$data['firstName'],
            'name_kana' => $data['lastNameKana'] .$data['firstNameKana'],
            'zip_code' => $data['zipCodeOne'] .$data['zipCodeTwo'],
            'pref_id' => $data['prefecture'],
            'address1' => $data['addressOne'],
            'address2' => $data['addressTwo']||'',
            'tel' => $data['mobileOne'] .$data['mobileTwo'] .$data['mobileThree'],
            'fax' => $data['telOne'] .$data['telTwo'] .$data['telThree'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
