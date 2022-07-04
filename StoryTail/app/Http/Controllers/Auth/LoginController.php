<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
   /* protected $redirectTo = RouteServiceProvider::HOME;*/
    /*protected $redirectTo = route('master');*/
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, User $user)
    {
        Auth::logoutOtherDevices($request->password);

        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
        ]);

       if($user->hasVerifiedEmail()&&$user->active){
           return redirect()->route('home');
       } elseif ($user->hasVerifiedEmail()&&!$user->active) {
           return redirect()->route('validation');
       }




    }
}
