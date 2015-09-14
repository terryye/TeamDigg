<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
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


    public $maxLoginAttempts = 10;

    public $redirectAfterLogout = null;


    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        $this->redirectAfterLogout = route("login");

        $trimedArray = array_map('trim', $request->only(['name','email']));
        $request->merge($trimedArray);



    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $result = Validator::make($data, [
            'name' => 'required|between:6,60',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        return $result;

    }

    /*
    protected function validateLogin(array $data)
    {
        $result = Validator::make($data, [
            //$this->loginUsername() => 'required',
            'email' => 'required',
            'password' => 'required',
        ], array(), array(
            'email' => '邮箱',
            'password' => '密码',
        ));
        return $result;
    }
    */


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
        ]);
    }

    public function forget(){
        return view("auth.forget");
    }
}
