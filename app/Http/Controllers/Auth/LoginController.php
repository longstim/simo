<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    function authenticated(Request $request, $user)
    {   
        //Absen dicatat ketika login!
        /*$data = array(
          'username' => $user->username,
          'waktu_login' => Carbon::now()->toDateTimeString(),
        );

        $insertID = DB::table('td_login_history')->insertGetId($data);*/

        if($user->hasRole('admin'))
        {
            return redirect()->route('home');
        }

        return redirect('home');
    }

    protected function loggedOut(Request $request) 
    {
        return redirect('login');
    }
}
