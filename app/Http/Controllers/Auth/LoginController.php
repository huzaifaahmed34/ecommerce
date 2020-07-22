<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Validator;
use Auth;
use Session;
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
protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
             $this->middleware(['guest:web'])->except('logout');
        
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect('/login');
    }

//       public function showCustomerLoginForm()
     
//     { 

//        session(['link' => url()->previous()]); 
//      return view('Home.Login', ['url' => 'customer']);

//     }

//     public function CustomerLogin(Request $request)
//     {
//         $this->validate($request, [
//             'email'   => 'required|email',
//             'password' => 'required|min:8'
//         ]);


 

//         if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password,'email_verified'=>1], $request->get('remember'))) {

//             return redirect(session('link'));
        
//         }
//         return back()->withInput($request->only('email', 'remember'));
//     }

// // protected function redirectTo()
// // {

// // if(Auth::user()->role_id=='3') {
// // // do your magic here
// //     return redirect('/home');
// // }
// // else{

// //  return redirect('/admin');
// // }
// // }

    
}
