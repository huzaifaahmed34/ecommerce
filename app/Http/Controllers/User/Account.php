<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Account_model as m;
use Validator;
use Illuminate\Support\Facades\Mail;

class Account extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('Home.login');
    }



 public function CheckVerificationCode(Request $request)
    {    
     

  $res=m::CheckVerificationCode($request);

  if($res=='success'){     
            return response()->json(['success'=>'Added new records.']);
        }
        else{
            return response()->json(['invalid'=>'Dones not match']);
        }

    

    }


 public function UpdateCustomer(Request $request)

 {
 $res=m::UpdateCustomer($request);
 return response()->json(['success'=>'Added new records.']);

    }
 public function UpdatePassword(Request $request)

 {
   $validator = Validator::make($request->all(), [
        


            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
          
            
          
        ]);


        if ($validator->passes()) {

  $res=m::UpdatePassword($request);
  if($res=='error'){
       
            return response()->json(['invalid'=>'Old Password is incorrect.']);
  }
  else{  
    return response()->json(['success'=>'Added new records.']);

        }
  }

else{
        return response()->json(['error'=>$validator->getMessageBag()->toArray() ]);
    }


 }
    
 public function InsertSignup(Request $request)
    {      $validator = Validator::make($request->all(), [
        

   'fname' => 'required',
            'lname' => 'required',
            'phone1' => 'bail|required|digits:11',
            'phone2' => 'bail|required|digits:11',
             'username' => 'bail|required|unique:users,username',
             'address1' => 'required',
             'password' => 'bail|required|min:8',
             'dob' => 'required',
                 'postcode' => 'required',
             'city' => 'required',
             'postcode' => 'required',
              'email' => 'bail|email|required|unique:customers,email',


            
          
        ]);


        if ($validator->passes()) {
        $email="";
            $email=$request->email;
             $name=$request->fname;

             $verification=mt_rand(100000, 999999);

               $data = array('name'=>"Huzaifa Mart",'email'=>$email,'name'=>$name);
               $message='';
     Mail::send('Home.emailverification', ['verification' => $verification], function ($m) use ($data) {
            $m->from('hello@app.com', 'Your Application');


            $m->to($data['email'],$data['name'])->subject('Email Verification');
        });

  $res=m::InsertSignup($request,$verification);
       
            return response()->json(['success'=>$res]);
        }

else{
        return response()->json(['error'=>$validator->getMessageBag()->toArray() ]);
    }

    }


}