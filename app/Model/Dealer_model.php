<?php

namespace App\Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Dealer_model extends Model
{
    
public static function InsertDealer($request){

        $data=array(
        	'name'=>$request->name,
        	'cnic'=>$request->cnic,
        	'phone'=>$request->phone,
        	'email'=>$request->email,
        	'address'=>$request->address,
        	'is_deleted'=>0,
        );
		$qry=DB::table('dealer')->insert($data);
		if($qry){
			return 1;
		}
		
	}
	public static function UpdateCategory($request){
$id=$request->id;
        $data=array('category_name'=>$request->name);
		$qry=DB::table('categories')->where('id',$id)->update($data);
		if($qry){
			return '1';
		}
		
	}
		public static function DeleteCategory($id){

$data=array('is_deleted'=>1);
     
  	$qry=DB::table('categories')->where('id',$id)->update($data);
		if($qry){
			return '1';
		}
		else{
			return '0';
		}
	}

public static function ShowCategory(){

      
		$qry=DB::table('categories')->where('is_deleted',0)->get();
		return $qry;
	}

public static function EditCategory($id){

      
		$qry=DB::table('categories')->where('id',$id)->where('is_deleted',0)->get()->first();
		return $qry;
	}
	


	}

?>