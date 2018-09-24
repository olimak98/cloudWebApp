<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Company;
use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

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

    public function showRegistrationForm()
    {
        $companies = Company::all();    
        
        $cities = City::all();

        return view('auth.register', ['companies' => $companies, 'cities' => $cities]);
    }

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
        $this->middleware('guest');
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'company' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['confirmation_code'] = sha1(time());
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'company_id' => $data['company'],
            'phone' => $data['phone'],
            'confirmation_code' => $data['confirmation_code']
        ]);

        Mail::send('layouts.confirmation_email', $data, function($message) use ($data) {
            $message->to($data['email'], $data['first_name'])->subject('Por favor confirma tu correo');
        });

        return $user;
    }

    protected function verify($email, $code){
        $user = User::where('confirmation_code', $code)->first();

        if(!$user){
            return redirect('/');
        }

        $user->confirmed = true;
        $user->confirmation_code = null;

        $user->save();

        return redirect('/login')->with('notification', 'Has confirmado tu correo electrónico'); 
    }
}
