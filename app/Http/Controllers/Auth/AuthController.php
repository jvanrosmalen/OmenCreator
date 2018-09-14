<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Traits\CaptchaTrait;

use Illuminate\Routing\UrlGenerator;

class AuthController extends Controller
{
    use CaptchaTrait;
    
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Get the URL we should redirect to.
     * OVERRIDE for vendor/laravel/framework/src/Illuminate/Foundation/Validation/ValidatesRequests.php
     *
     * @return string
     */
    protected function getRedirectUrl()
    {
        return app(UrlGenerator::class)->previous();
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['captcha'] = $this->captchaCheck();

        return Validator::make($data, [
            'name'                  => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|min:6|max:20|confirmed',
            'g-recaptcha-response'  => 'required',
            'captcha'               => 'required|min:1'
        ],
        [   
            'name.required'                 => 'Je moet een naam invullen',
            'email.required'                => 'Je moet een email invullen',
            'email.email'                   => 'Dit is geen valide email-adres',
            'password.required'             => 'Je moet een wachtwoord invullen',
            'password.min'                  => 'Je wachtwoord moet minimaal 6 karaters lang zijn',
            'password.max'                  => 'Je wachtwoord mag maximaal 20 karaters lang zijn',
            'g-recaptcha-response.required' => 'Captcha is verplicht. Of ben je een robot?',
            'captcha.required'              => 'Je captcha is verkeerd. Probeert het nog een keer'            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        	'is_accepted' => false,
        	'is_admin'=> false,
        	'is_system_rep'=>false,
        	'is_story_telling'=>false,	
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect('/login_failed');
    }
}
