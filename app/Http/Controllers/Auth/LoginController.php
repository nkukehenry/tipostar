<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

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

    use
     AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    // check: https://laracasts.com/discuss/channels/laravel/how-to-override-auth-login-function-in-laravel
    // check: https://stackoverflow.com/questions/50474763/overridden-authenticated-method-in-login-controller-doesnt-work

    public function login(Request $request)
    {
        $this->validateLogin($request);
        
        // This section is the only change
       // if($this->guard()->validate($this->credentials($request)))
        //{
            // $user = $this->guard()->getLastAttempted();

            // // Make sure the user is active
            // if($user->is_active && $this->attemptLogin($request))
            // {
            //     // send the normal succesful login response
            //     return $this->sendLoginResponse($request);
            // }
            // else
            // {
            //     // login form with an error message
            //     return redirect()
            //         ->back()
            //         ->withInput($request->only($this->username(), 'remember'))
            //         ->withErrors(['active' => 'You must be active to login']);
            // }
            
            $this->attemptLogin($request);
            return $this->sendLoginResponse($request);
       // }
       // return $this->sendFailedLoginResponse($request);
    }


    
    public function authenticated($request, $user)
    {
        //if($user->hasRole('administrator'))  {
            return redirect()->route('admin.dashboard');
        // }
        // elseif($user->hasRole('user'))
        // {
        //     return redirect()->route('home');
        // }
    }
}
