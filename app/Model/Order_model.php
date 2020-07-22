<?php

namespace App\Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Order_model extends Model
{
	    
	public static function PendingOrderShow(){
		$qry=DB::table('orders as o')->select('o.id as oid','c.firstname as name','o.order_date','o.total_price','o.payment_type','o.status','c.id as cid')->join('customers as c','o.user_id','=','c.id')->where('o.status','Pending')->where('o.is_deleted',0)->orderBy('o.id','desc')->get();
	
		return $qry;

		}






	public static function ConfirmOrder($id){
			$qry=DB::table('orders')->where('id',$id)->update(['status'=>'Completed','remarks'=>'Your Order is Delivered','updated_at'=>date('Y-m-d H:i:s')]);

		}

	public static function CancelOrder($id){
			DB::table('orders')->where('id',$id)->update(['status'=>'Cancelled','remarks'=>'Your Order is Cancelled','updated_at'=>date('Y-m-d H:i:s')]);
			$qry=DB::table('order_details')->where('order_id',$id)->get();
			foreach ($qry as $q) {
				DB::table('product_details')->where('id',$q->product_detail_id)->increment('quantity',$q->quantity);
				DB::table('product')->where('id',$q->product_id)->update(['status'=>1]);
			}



		}



	public static function PendingOrderDetailsShow($id){
		$qry=DB::table('order_details as o')->select('*','o.quantity as oq')->join('product as p','o.product_id','=','p.id')->where('o.order_id',$id)->get();

	$html='';

      $sno='1';
foreach ($qry as $q) {

 $html.='<tr>'.
      '<td>'.$sno.'</td>'.
      '<td>'.$q->product_code.'</td>'.
         '<td>		<img src="data:image/png;base64,'.chunk_split(base64_encode($q->logo)) .'" alt="" width="60" height="60px;" /></td>'.
         '<td>'.$q->short_desc.'</td>'.
         '<td>'.$q->price.'</td>'.
            '<td >'.$q->oq.'</td>'.
         '<td>'.$q->total_price.'</td>'.
      
       '</tr>' ;
           $sno++;
		}
return $html;

}

public static function CompletedOrderShow(){
		$qry=DB::table('orders as o')->select('o.id as oid','c.firstname as name','o.order_date','o.total_price','o.payment_type','o.status','c.id as cid','o.updated_at')->join('customers as c','o.user_id','=','c.id')->where('o.status','Completed')->where('o.is_deleted',0)->orderBy('o.id','desc')->get();
	
		return $qry;

		}


	public static function  CompletedOrderDetailsShow($id){
		$qry=DB::table('order_details as o')->select('*','o.quantity as oq')->join('product as p','o.product_id','=','p.id')->where('o.order_id',$id)->get();

	$html='';

      $sno='1';
foreach ($qry as $q) {

 $html.='<tr>'.
      '<td>'.$sno.'</td>'.
      '<td>'.$q->product_code.'</td>'.
         '<td>		<img src="data:image/png;base64,'.chunk_split(base64_encode($q->logo)) .'" alt="" width="60" height="60px;" /></td>'.
         '<td>'.$q->short_desc.'</td>'.
         '<td>'.$q->price.'</td>'.
            '<td >'.$q->oq.'</td>'.
         '<td>'.$q->total_price.'</td>'.
      
       '</tr>' ;
           $sno++;
		}
return $html;

}




public static function CancelOrderShow(){
		$qry=DB::table('orders as o')->select('o.id as oid','c.firstname as name','o.order_date','o.total_price','o.payment_type','o.status','c.id as cid','o.updated_at')->join('customers as c','o.user_id','=','c.id')->where('o.status','Cancelled')->where('o.is_deleted',0)->orderBy('o.id','desc')->get();
	
		return $qry;

		}


	public static function  CancelOrderDetailsShow($id){
		$qry=DB::table('order_details as o')->select('*','o.quantity as oq')->join('product as p','o.product_id','=','p.id')->where('o.order_id',$id)->get();

	$html='';

      $sno='1';
foreach ($qry as $q) {

 $html.='<tr>'.
      '<td>'.$sno.'</td>'.
      '<td>'.$q->product_code.'</td>'.
         '<td>		<img src="data:image/png;base64,'.chunk_split(base64_encode($q->logo)) .'" alt="" width="60" height="60px;" /></td>'.
         '<td>'.$q->short_desc.'</td>'.
         '<td>'.$q->price.'</td>'.
            '<td >'.$q->oq.'</td>'.
         '<td>'.$q->total_price.'</td>'.
      
       '</tr>' ;
           $sno++;
		}
return $html;

}




	}