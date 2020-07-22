<?php

namespace App\Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Category_model extends Model
{
    
public static function InsertCategory($request,$path){
	$slug=str_slug($request->name, '-');

$count=DB::table('categories')->where('slug',$slug)->count();
if($count>0){

$id=DB::table('categories')->max('id');

$id+=1;
$slug=$slug.'-'.$id;
}
else{
	$slug=$slug;
}

        $data=array(
        	'category_name'=>$request->name,
        	'slug'=>$slug,
        	'logo'=>file_get_contents(storage_path('app/'.$path)),
        );
		$qry=DB::table('categories')->insert($data);
		if($qry){
			return 1;
		}
		
	}
	public static function UpdateCategory($request){
$id=$request->id;
        $data=array(
        	'category_name'=>$request->name,
       			'updated_at'=>date('Y-m-d H:i:s'),
       		);
		$qry=DB::table('categories')->where('id',$id)->update($data);
		if($qry){
			return '1';
		}
		
	}
		public static function DeleteCategory($id){

$data=array(
	'is_deleted'=>1,
	'deleted_at'=>date('Y-m-d H:i:s'),);
     
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