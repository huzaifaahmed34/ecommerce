<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
class AdminLoginController extends Controller
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
        $this->middleware(array('guest:customer'))->except('logout');
    }
    
    public function showLoginForm(Request $request)
    { 

            $link=url()->previous();
    
         $request->session()->put('link',$link);

     return view('Home.login');

    }


    protected function credentials(Request $request)
{


  
    return [
        'email' => $request->{$this->username()},
        'password' => $request->password,
        'email_verified' => '1'
    ];
}



    protected function attemptLogin(Request $request)
    {


        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }

    public function logout(Request $request)
    { $request->session()->forget('cemail');
                  $request->session()->forget('cphone');
        $this->guard()->logout();
           
        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }
        protected function authenticated(Request $request, $user)
    {
            $row=DB::table('customers')->where('id',Auth::guard('customer')->id())->first();
           
                $request->session()->put('cemail',$row->email );
                  $request->session()->put('cphone',$row->phone1 );
        return redirect($request->session()->get('link'));    }

}
