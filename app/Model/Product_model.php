<?php

namespace App\Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Product_model extends Model
{
    
public static function InsertProduct($request,$path){


$slug=str_slug($request->product_name, '-');

$count=DB::table('product')->where('slug',$slug)->count();
if($count>0){

$id=DB::table('product')->max('id');

$id+=1;
$slug=$slug.'-'.$id;
}
else{
	$slug=$slug;
}

if($request->discount_perc==''){
	$discount_perc=0;
	$start_discount_date=NULL;
	$end_discount_date=NULL;
	$discount_available=0;
}
else{
		$discount_perc=$request->discount_perc;
	$start_discount_date=$request->start_discount;
	$end_discount_date=$request->end_discount;
$discount_available=1;
}
        $data=array(
        	'SKU'=>$request->SKU,
			'warranty_type_id'=>$request->warranty_type,
			'warranty_period_id'=>$request->warranty_period,
			'warranty_policy'=>$request->warranty_policy,
			'package_weight'=>$request->product_weight,
			'package_dimensions'=>$request->product_dimensions,
			'discount_perc'=>$discount_perc,
			'discount_available'=>$discount_available,
			'start_discount_date'=>$start_discount_date,
			'end_discount_date'=>$end_discount_date,
        	'product_code'=>$request->product_code,
        	'slug'=>$slug,
        	'product_name'=>$request->product_name,
        	'brand_name'=>$request->brand_name,
        	'long_desc'=>$request->long_desc,
        	'short_desc'=>$request->short_desc,
        	'price'=>$request->price,
        	'tags'=>$request->tags,
        	'long_desc'=>$request->long_desc,
        


        	'available_size'=>$request->available_size,
        	'logo'=>file_get_contents(storage_path('app/'.$path)),
        	'category_id'=>$request->category_id,
        	'subcategory_id'=>$request->subcategory_id,
        	     'dealer_id'=>$request->dealer_id,
        	     'status'=>1,
        	     'is_deleted'=>0,
        	
       
        	'product_location'=>$request->product_location,
        );
		DB::table('product')->insert($data);
$id = DB::getPdo()->lastInsertId();
		$totalsize=$request->total;
	$totalsize1=$request->total1;

		if($totalsize>0){
		for ($i=0;$i<=$totalsize ;$i++) {
	
	if(isset($request->quantity1[$i])){
		$data2=array(
			'product_id'=>$id,
			'size'=>$request->size[$i],
			'quantity'=>$request->quantity1[$i],
			'is_available'=>1,
			   'is_deleted'=>0,
		);
$qry=DB::table('product_details')->insert($data2);

		}
	}
		}
	if($request->quantity!=''){
				$data3=array(
			'product_id'=>$id,
			
			'quantity'=>$request->quantity,
			'is_available'=>1,
		);
$qry1=DB::table('product_details')->insert($data3);



		}


for ($j=0;$j<=$totalsize1 ;$j++) {
	
	if(isset($request->spec[$j])){
		$data3=array(
			'product_id'=>$id,
			'product_spec_id'=>$request->spec[$j],
			'value'=>$request->specvalue[$j],
			'is_deleted'=>0,
		);
$qry=DB::table('product_spec_values')->insert($data3);

		}
	}

return 1;	
		
	}


	public static function InsertWarrantyType($request)
	{
		$data=array(
			'warranty_type'=>$request->name,
			'description'=>$request->description
		);
			$qry=DB::table('warranty_type')->insert($data);
	}

		public static function InsertWarranty($request)
	{
		$data=array(
			'warranty_period'=>$request->name,
		
		);
			$qry=DB::table('warranty_period')->insert($data);
	}

	

	public static function ViewProduct(){	
		$qry=DB::table('product as p')->select('p.id','p.end_discount_date','p.product_name','p.product_code','s.name','c.category_name','p.discount_available','p.price','p.discount_perc',DB::raw('To_Base64(p.logo)'),'p.status','p.tags','b.brand')->join('sub_categories as s','s.id','=','p.subcategory_id')->join('categories as c','c.id','=','p.category_id')->join('brand as b','b.id','=','p.brand_name')->where('p.is_deleted',0)->orderBy('p.id','desc')->get();
return $qry;

	}

public static function UpdateDiscount($request){
		$id=$request->id;
		$price=$request->price;
		
		$discount_perc=$request->discount_perc;
		$discount=$price-($price*($discount_perc/100));
		DB::table('product')->where('id',$id)->update(['discount_perc'=>$discount_perc,'discount_available'=>1]);
		DB::table('cart')->where('product_id',$id)->update(['price'=>$discount]);
		}

public static function UpdateDiscountAll($request){
		$list=$request->list;
$discount_perc=$request->discount_perc;
$end_discount_date=$request->end_discount_date;
		DB::table('product')->whereIn('id',$list)->update(['discount_perc'=>$discount_perc,'end_discount_date'=>$end_discount_date,'discount_available'=>1]);
$qry=DB::table('product')->whereIn('id',$list)->get();
foreach ($qry as $q) {
	DB::table('cart')->where('product_id',$q->id)->update(['price'=>$q->price-($q->price*$q->discount_perc/100)]);
}

		}
	


public static function RemoveDiscountAll($request){
		$list=$request->list;
		DB::table('product')->whereIn('id',$list)->update(['discount_perc'=>0,'discount_available'=>0,'end_discount_date'=>NULL]);
$qry=DB::table('product')->whereIn('id',$list)->get();
foreach ($qry as $q) {
	DB::table('cart')->where('product_id',$q->id)->update(['price'=>$q->price]);
}

		}
	


	public static function UpdateProduct($request){
$id=$request->id;
        $data=array('category_name'=>$request->name);
		$qry=DB::table('categories')->where('id',$id)->update($data);
		if($qry){
			return '1';
		}
		
	}
		public static function DeleteProduct($id){

$data=array('is_deleted'=>1);
     
  	$qry=DB::table('categories')->where('id',$id)->update($data);
		if($qry){
			return '1';
		}
		else{
			return '0';
		}
	}



public static function GetSubcategory($request){
$id=$request->id;
$res=DB::table('sub_categories')->select('id','name')->where('category_id',$id)->get();
return $res;

}
public static function GetBrand($request){
$id=$request->id;
$res=DB::table('brand')->select('id','brand')->where('subcategory_id',$id)->get();
return $res;

}


public static function InsertBrand($request){
	$slug=str_slug($request->name, '-');

$count=DB::table('brand')->where('slug',$slug)->count();
if($count>0){

$id=DB::table('brand')->max('id');

$id+=1;
$slug=$slug.'-'.$id;
}
else{
	$slug=$slug;
}

        $data=array(
        	'brand'=>$request->name,
        	'slug'=>$slug,
        	'subcategory_id'=>$request->subcategory_id
        
        );
		$qry=DB::table('brand')->insert($data);
		if($qry){
			return 1;
		}
		
	}


	


public static function InsertSpecification($request){
	$slug=str_slug($request->name, '-');

$count=DB::table('product_spec')->where('slug',$slug)->count();
if($count>0){

$id=DB::table('product_spec')->max('id');

$id+=1;
$slug=$slug.'-'.$id;
}
else{
	$slug=$slug;
}

        $data=array(
        	'name'=>$request->name,
        	'slug'=>$slug,
        
        );
		$qry=DB::table('product_spec')->insert($data);
		if($qry){
			return 1;
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