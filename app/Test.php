<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    
public static function insertdata($request){
	 $data=array('name'=>$request->name,'Fathername'=>$request->fname,'tel'=>' ','D_O_B'=>' ');
	 DB::table('contact')->insert($data);
      return 1;
}

	public static function showdata(){

		
	//$qry=DB::table('contact')->select('name as n','tel as t')->where(['name'=>'sda','tel'=>'','id'=>DB::table('contact')->max('id')])->where('created_at','>','2020')->orWhere(function($qrt){
	//			$qrt->where(['name'=>'asd']);
	//		})->get();
$qry=DB::table('contact')->get();
		
			return $qry;
		}
public static function editdata($id){
		
			$qry=DB::select("select * from contact where id=?",[$id]);
			return $qry;
}

public static function updatedata($id,$request){
		$data=array('name'=>$request->name,'Fathername'=>$request->fname,'tel'=>$request->tel);
			DB::table('contact')->where('id',$id)->update($data);
			
}
public static function deletedata($id){
	DB::table('contact')->where('id',$id)->delete();
}


}
