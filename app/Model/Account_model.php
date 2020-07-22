<?php

namespace App\Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Hash;
class Account_model extends Model
{
    
    
public static function InsertSignup($request,$verification)
{
			
			$data1=array(
				'password'=> bcrypt($request->password),
			
				'firstname'=>$request->fname,
				'lastname'=>$request->lname,
				'phone1'=>$request->phone1,
				'phone2'=>$request->phone2,
				'address'=>$request->address1,
				'address2'=>$request->address2,
				'city'=>$request->city,
				'postcode'=>$request->postcode,
				'gender'=>$request->gender,
				'doj'=>date('Y-m-d'),
				'dob'=>$request->dob,
				'email'=>$request->email,
				'email_verified'=>0,
				'verification_code'=>$verification,
				'is_deleted'=>0,
				
			);
				DB::table('customers')->insert($data1);
				$id = DB::getPdo()->lastInsertId();
				return $id;

}



public static function UpdateCustomer($request)
{

$user_id=Auth::guard('customer')->id();
$data=array(
			'firstname'=>$request->fname,
			'lastname'=>$request->lname,
			'city'=>$request->city,
			'phone1'=>$request->phone,
			'address'=>$request->address,
			'postcode'=>$request->postcode,
			'updated_at'=>date('Y-m-d H:i:s'),

				);

	DB::table('customers')->where('id',$user_id)->update($data);;



}



public static function UpdatePassword($request)
{
	
$user_id=Auth::guard('customer')->id();
	$oldpassword=$request->oldpassword;
	$qry=DB::table('customers')->where('id',$user_id)->first();

if (Hash::check($oldpassword, $qry->password)) {

				DB::table('customers')->where('id',$user_id)->update(['password'=>bcrypt($request->newpassword)]);


return 'success';
	}
	else{
		return "error";
		}
	}

public static function CheckVerificationCode($request)
{	  	$user_id=$request->user_id;
	

	$ver=$request->ver;
	$qry=DB::table('customers')->where('id',$user_id)->first();

	if($ver==$qry->verification_code){

		
			DB::table('customers')->where('id',$user_id)->update(['email_verified'=>1]);
		

return 'success';
	}
	else{
		return "error";
		}
	}


    }
    ?>