<?php

namespace App\Model;
use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Redirect;
class Home_model extends Model
{
    
public static function ShowProduct($slug){

	$qry=DB::table('product as p')->select('p.id as pid','pd.id as pdid','b.brand','w.warranty_period','wt.warranty_type','p.SKU','p.warranty_policy','p.discount_available','discount_perc','p.product_name','p.logo','p.end_discount_date','p.short_desc','p.long_desc','p.status','p.tags','pd.size','p.product_code','p.brand_name','pd.id as pdid','p.price as price','c.name as name')->join('sub_categories as c','c.id', '=', 'p.subcategory_id')->join('product_details as pd','p.id', '=', 'pd.product_id')->join('brand as b','p.brand_name','=','b.id')->join('warranty_type as wt','wt.id','=','p.warranty_type_id')->join('warranty_period as w','w.id','=','p.warranty_period_id')->where('p.is_deleted',0)->where('p.slug',$slug)->get();

		return $qry;
}
public static function ShowProductCart(){

    	$user_id=Auth::guard('customer')->id();
	$qry=DB::table('cart as c')->select('p.status','p.discount_available','discount_perc','pd.quantity as pquantity','p.price','p.logo','p.product_name','p.end_discount_date','p.product_code','pd.size','p.id as pid','c.id as cid','pd.id as pdid','c.quantity as cquantity')->join('product as p','c.product_id','=','p.id')->join('product_details as pd','c.product_detail_id','=','pd.id')->where('c.user_id',$user_id)->get();
$html='';
	$total=0;
	$price=0;
		$div='';
			
				foreach($qry as $p)	{
					if($p->discount_available==1 && $p->end_discount_date>date('Y-m-d H:i:s')){
						
				$price=$p->price-($p->price*($p->discount_perc/100));
					$div='<p>Rs '.$price.' &nbsp;<del id=discount> Rs'.$p->price.'</del></p>';

					}else{			
$div='<p>Rs'.$p->price.'</p>';
						$price=$p->price;

						}
if($p->status==0){
$html.='<tr><td>Product Not Available</td></tr>';
}			else{
	if($p->pquantity==0){
		$html.='<tr><td class="cart_product" style="margin-left: 0px;margin-right: 0px;">
								<a href="">	<img src="data:image/png;base64,'.chunk_split(base64_encode($p->logo)) .' " alt="" height="100px;" width=150px/></a>
							</td><td><h5 style=color:Red >'.$p->size.' Size Not Available of '.$p->product_name.'  </h5></td></tr>';
	}
	elseif($p->pquantity<$p->cquantity){

DB::table('cart')->where('user_id',$user_id)->where('product_id',$p->pid)->where('product_detail_id',$p->pdid)->decrement('quantity',$p->cquantity-$p->pquantity);

$total+=($price*$p->pquantity);
						$html.='<tr data='.$p->cid.' data1='.$price*$p->pquantity.' data2='.$p->pquantity.' data3='.$price.' data4='.$p->pdid.'>
							<td class="cart_product" style="margin-left: 0px;margin-right: 0px;">
								<a href="">	<img src="data:image/png;base64,'.chunk_split(base64_encode($p->logo)) .' " alt="" height="100px;" width=150px/></a>
							</td>
							<td class="cart_description">
								<a href=""><h5>'.substr($p->product_name,0,60).'</h5></a>
								<p>Code: '.$p->product_code.'</p>
							</td>
							<td class="cart_price">

								'.$div.'
							</td>
							<td>
							<p>'.$p->size.'</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<button class="cart_quantity_up btn " > + </button>
									<input class="text-center" readonly="" type="text" name="quantity" value="'.$p->pquantity.'" autocomplete="off" size="2">
									<button class="cart_quantity_down btn " > - </button>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">'.$price*$p->pquantity.'</p>
							</td>
							<td class="cart_delete ">
								<button class=" btn  btn-danger btn-delete "  href=""><i class="fa fa-times" ></i></button>
							</td>
						</tr>';
	}
	else{
				$total+=($price*$p->cquantity);

						$html.='<tr data='.$p->cid.' data1='.$price*$p->cquantity.' data2='.$p->cquantity.' data3='.$price.' data4='.$p->pdid.'>
							<td class="cart_product" style="margin-left: 0px;margin-right: 0px;">
								<a href="">	<img src="data:image/png;base64,'.chunk_split(base64_encode($p->logo)) .' " alt="" height="100px;" width=150px/></a>
							</td>
							<td class="cart_description">
								<a href=""><h5>'.substr($p->product_name,0,60).'</h5></a>
								<p>Code: '.$p->product_code.'</p>
							</td>
							<td class="cart_price">
							'.$div.'
							</td>
							<td>
							<p>'.$p->size.'</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<button class="cart_quantity_up btn " > + </button>
									<input class="text-center" readonly="" type="text" name="quantity" value="'.$p->cquantity.'" autocomplete="off" size="2">
									<button class="cart_quantity_down btn " > - </button>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">'.$price*$p->cquantity.'</p>
							</td>
							<td class="cart_delete ">
								<button class=" btn  btn-danger btn-delete "  href=""><i class="fa fa-times" ></i></button>
							</td>
						</tr>';
		}
					}
				}
						$html.='<tr   >
							<td></td><td></td>
							<td></td>
							<td></td>

							<td></td>
							<td class="text-right"><h4>Total :</h4></td>
							<td> <h4>Rs <Span id=total>'.$total.'</Span></h4></td>
					
						</tr>';

						return $html;
}





		public static function getFilter($request)
		    {		$brand_filter='';
		    $ptype_filter='';
		    $html='';
		    $slug=$request->slug;
		    $filter=$request->filter;
		    $type=$request->type;
		    $query='';
		    if($type=='Featured'){
$query="select DISTINCT(p.id),TO_BASE64(p.logo) as plogo,p.slug as pslug,p.product_name,p.price,p.category_id,p.product_code,p.short_desc,b.brand from product as p,brand as b,product_spec_values as psv,sub_categories as s where p.brand_name=b.id and psv.product_id=p.id and p.subcategory_id=s.id and p.tags='Featured' ";
		    }
		    elseif($type=='Sub_Category'){

		    	$query="select DISTINCT(p.id),TO_BASE64(p.logo) as plogo,p.slug as pslug,p.product_name,p.price,p.category_id,p.product_code,p.short_desc,b.brand from product as p,brand as b,product_spec_values as psv,sub_categories as s where p.brand_name=b.id and psv.product_id=p.id and p.subcategory_id=s.id and s.slug='$slug' ";
		    }
		    	$brand=$request->brand;
		    	$ptype=$request->ptype;
		    	$minprice=$request->minprice;
		    	$maxprice=$request->maxprice;

		
		  
			 if(isset($minprice) &&  isset($maxprice) && isset($ptype) && isset($brand)  && $filter==0){
		    	 $ptype_filter = implode('","', $ptype);
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and  psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')';
		    	}
		    	 else if(isset($minprice) &&  isset($maxprice) && isset($ptype) && isset($brand) && $filter==1 ){
		    	 $ptype_filter = implode('","', $ptype);
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and  psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.') order by p.price';
		    	}
		    	 else if(isset($minprice) &&  isset($maxprice) && isset($ptype) && isset($brand) && $filter==2){
		    	 $ptype_filter = implode('","', $ptype);
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and  psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')  order by p.price desc';
		    	}
		    	else if(isset($minprice) &&  isset($maxprice) && isset($ptype) && isset($brand) && $filter==3){
		    	 $ptype_filter = implode('","', $ptype);
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and  psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')  order by p.id desc';
		    	}

		    
			else if(isset($minprice) &&  isset($maxprice)  && isset($brand) && $filter==0){
		    
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')';
		    	}

		    			else if(isset($minprice) &&  isset($maxprice)  && isset($brand) && $filter==1){
		    
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')  order by p.price';
		    	}


		    			else if(isset($minprice) &&  isset($maxprice)  && isset($brand) && $filter==2){
		    
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')  order by p.price desc';
		    	}

		    			else if(isset($minprice) &&  isset($maxprice)  && isset($brand) && $filter==3){
		    
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')  order by p.id desc';
		    	}
	else if(isset($minprice) &&  isset($maxprice)  &&  isset($ptype)  && $filter==0){
		    	 $ptype_filter = implode('","', $ptype);
		    		$query.=' and   psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')';
		    	}
	else if(isset($minprice) &&  isset($maxprice)  &&  isset($ptype)  && $filter==1){
		    	 $ptype_filter = implode('","', $ptype);
		    		$query.=' and   psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.') order by p.price ';
		    	}
	else if(isset($minprice) &&  isset($maxprice)  &&  isset($ptype)  && $filter==2){
		    	 $ptype_filter = implode('","', $ptype);
		    		$query.=' and   psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.') order by p.price  desc';
		    	}
	else if(isset($minprice) &&  isset($maxprice)  &&  isset($ptype)  && $filter==3){
		    	 $ptype_filter = implode('","', $ptype);
		    		$query.=' and   psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.') order by p.id desc ';
		    	}



		    	else if(isset($minprice) &&  isset($maxprice)   && $filter==0){
		    	
		    		$query.=' and (p.price between '.$minprice.' and  '.$maxprice.')';
		    	}
		    	else if(isset($minprice) &&  isset($maxprice)   && $filter==1){
		    	
		    		$query.=' and (p.price between '.$minprice.' and  '.$maxprice.') order by p.price ';
		    	}
		    	else if(isset($minprice) &&  isset($maxprice)  && $filter==2){
		    	
		    		$query.=' and (p.price between '.$minprice.' and  '.$maxprice.') order by p.price  desc';
		    	}
		    	else if(isset($minprice) &&  isset($maxprice)  && $filter==3){
		    	
		    		$query.=' and (p.price between '.$minprice.' and  '.$maxprice.') order by p.id desc';
		    	}

		    	   else if(isset($brand) && isset($ptype)  && $filter==0){
		    		 $brand_filter = implode('","', $brand);
		    	  $ptype_filter = implode('","', $ptype);
		    	  $query.=' and psv.value In ("'.$ptype_filter.'") and b.brand In ("'.$brand_filter.'")';
		    	}
		    	 else if(isset($brand) && isset($ptype)  && $filter==1){
		    		 $brand_filter = implode('","', $brand);
		    	  $ptype_filter = implode('","', $ptype);
		    	  $query.=' and psv.value In ("'.$ptype_filter.'") and b.brand In ("'.$brand_filter.'") order by p.price ';
		    	}
		    	 else if(isset($brand) && isset($ptype)  && $filter==2){
		    		 $brand_filter = implode('","', $brand);
		    	  $ptype_filter = implode('","', $ptype);
		    	  $query.=' and psv.value In ("'.$ptype_filter.'") and b.brand In ("'.$brand_filter.'") order by p.price desc';
		    	}
		    	 else if(isset($brand) && isset($ptype)  && $filter==3){
		    		 $brand_filter = implode('","', $brand);
		    	  $ptype_filter = implode('","', $ptype);
		    	  $query.=' and psv.value In ("'.$ptype_filter.'") and b.brand In ("'.$brand_filter.'") order by p.id desc';
		    	}

		    	  else if(isset($brand) && $filter==0){
		    		 $brand_filter = implode('","', $brand);
		    		
		    		$query.=' and b.brand In ("'.$brand_filter.'")';
		    	}
		    	  else if(isset($brand) && $filter==1){
		    		 $brand_filter = implode('","', $brand);
		    		
		    		$query.=' and b.brand In ("'.$brand_filter.'") order by p.price';
		    	}
		    	  else if(isset($brand) && $filter==2){
		    		 $brand_filter = implode('","', $brand);
		    		
		    		$query.=' and b.brand In ("'.$brand_filter.'") order by p.price desc';
		    	}
		    	  else if(isset($brand) && $filter==3){
		    		 $brand_filter = implode('","', $brand);
		    		
		    		$query.=' and b.brand In ("'.$brand_filter.'") order by p.id desc';
		    	}

		    	else if(isset($ptype) && $filter==0){
		    		 $ptype_filter = implode('","', $ptype);
		    	
		    		$query.=' and psv.value In ("'.$ptype_filter.'") ';
		    	}
		    	else if(isset($ptype) && $filter==1){
		    		 $ptype_filter = implode('","', $ptype);
		    	
		    		$query.=' and psv.value In ("'.$ptype_filter.'") order by p.price ';
		    	}
		    	else if(isset($ptype) && $filter==2){
		    		 $ptype_filter = implode('","', $ptype);
		    	
		    		$query.=' and psv.value In ("'.$ptype_filter.'") order by p.price desc';
		    	}
		    	else if(isset($ptype) && $filter==3){
		    		 $ptype_filter = implode('","', $ptype);
		    	
		    		$query.=' and psv.value In ("'.$ptype_filter.'") order by p.id desc';
		    	}
		    
		    else if($filter==1){
		    	$query.=' order by p.price ';
		    }
		     else if($filter==2){
		    	$query.=' order by p.price desc';
		    }
		     else if($filter==3){
		    	$query.=' order by p.id desc ';
		    }
		    else{
		    	$query=DB::table('product as p')->select('*','c.slug as cslug','p.slug as pslug','p.logo as plogo')->join('sub_categories as c','c.id','=','p.subcategory_id')->where('c.slug',$slug)->where('p.is_deleted',0);
		    	return $query;
		    }
		    	

		    	$qry=DB::select($query);
		    
				return $qry;	


}








		public static function getFilterSearch($request)
		    {		$brand_filter='';
		    $ptype_filter='';
		    $html='';
		    $slug=$request->slug;
		    $filter=$request->filter;
		    
		    	$query="select DISTINCT(p.id),TO_BASE64(p.logo) as plogo,p.slug as pslug,p.product_name,p.price,p.category_id,p.product_code,p.short_desc,b.brand from product as p,brand as b,product_spec_values as psv where p.brand_name=b.id and psv.product_id=p.id and p.product_name like '%$slug%'";
		    	$brand=$request->brand;
		    	$ptype=$request->ptype;
		    	$minprice=$request->minprice;
		    	$maxprice=$request->maxprice;

		
		  
			 if(isset($minprice) &&  isset($maxprice) && isset($ptype) && isset($brand)  && $filter==0){
		    	 $ptype_filter = implode('","', $ptype);
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and  psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')';
		    	}
		    	 else if(isset($minprice) &&  isset($maxprice) && isset($ptype) && isset($brand) && $filter==1 ){
		    	 $ptype_filter = implode('","', $ptype);
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and  psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.') order by p.price';
		    	}
		    	 else if(isset($minprice) &&  isset($maxprice) && isset($ptype) && isset($brand) && $filter==2){
		    	 $ptype_filter = implode('","', $ptype);
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and  psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')  order by p.price desc';
		    	}
		    	else if(isset($minprice) &&  isset($maxprice) && isset($ptype) && isset($brand) && $filter==3){
		    	 $ptype_filter = implode('","', $ptype);
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and  psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')  order by p.id desc';
		    	}

		    
			else if(isset($minprice) &&  isset($maxprice)  && isset($brand) && $filter==0){
		    
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')';
		    	}

		    			else if(isset($minprice) &&  isset($maxprice)  && isset($brand) && $filter==1){
		    
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')  order by p.price';
		    	}


		    			else if(isset($minprice) &&  isset($maxprice)  && isset($brand) && $filter==2){
		    
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')  order by p.price desc';
		    	}

		    			else if(isset($minprice) &&  isset($maxprice)  && isset($brand) && $filter==3){
		    
		    	  $brand_filter = implode('","', $brand);
		    		$query.=' and  b.brand In ("'.$brand_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')  order by p.id desc';
		    	}
	else if(isset($minprice) &&  isset($maxprice)  &&  isset($ptype)  && $filter==0){
		    	 $ptype_filter = implode('","', $ptype);
		    		$query.=' and   psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.')';
		    	}
	else if(isset($minprice) &&  isset($maxprice)  &&  isset($ptype)  && $filter==1){
		    	 $ptype_filter = implode('","', $ptype);
		    		$query.=' and   psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.') order by p.price ';
		    	}
	else if(isset($minprice) &&  isset($maxprice)  &&  isset($ptype)  && $filter==2){
		    	 $ptype_filter = implode('","', $ptype);
		    		$query.=' and   psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.') order by p.price  desc';
		    	}
	else if(isset($minprice) &&  isset($maxprice)  &&  isset($ptype)  && $filter==3){
		    	 $ptype_filter = implode('","', $ptype);
		    		$query.=' and   psv.value In ("'.$ptype_filter.'") and (p.price between '.$minprice.' and  '.$maxprice.') order by p.id desc ';
		    	}



		    	else if(isset($minprice) &&  isset($maxprice)   && $filter==0){
		    	
		    		$query.=' and (p.price between '.$minprice.' and  '.$maxprice.')';
		    	}
		    	else if(isset($minprice) &&  isset($maxprice)   && $filter==1){
		    	
		    		$query.=' and (p.price between '.$minprice.' and  '.$maxprice.') order by p.price ';
		    	}
		    	else if(isset($minprice) &&  isset($maxprice)  && $filter==2){
		    	
		    		$query.=' and (p.price between '.$minprice.' and  '.$maxprice.') order by p.price  desc';
		    	}
		    	else if(isset($minprice) &&  isset($maxprice)  && $filter==3){
		    	
		    		$query.=' and (p.price between '.$minprice.' and  '.$maxprice.') order by p.id desc';
		    	}

		    	   else if(isset($brand) && isset($ptype)  && $filter==0){
		    		 $brand_filter = implode('","', $brand);
		    	  $ptype_filter = implode('","', $ptype);
		    	  $query.=' and psv.value In ("'.$ptype_filter.'") and b.brand In ("'.$brand_filter.'")';
		    	}
		    	 else if(isset($brand) && isset($ptype)  && $filter==1){
		    		 $brand_filter = implode('","', $brand);
		    	  $ptype_filter = implode('","', $ptype);
		    	  $query.=' and psv.value In ("'.$ptype_filter.'") and b.brand In ("'.$brand_filter.'") order by p.price ';
		    	}
		    	 else if(isset($brand) && isset($ptype)  && $filter==2){
		    		 $brand_filter = implode('","', $brand);
		    	  $ptype_filter = implode('","', $ptype);
		    	  $query.=' and psv.value In ("'.$ptype_filter.'") and b.brand In ("'.$brand_filter.'") order by p.price desc';
		    	}
		    	 else if(isset($brand) && isset($ptype)  && $filter==3){
		    		 $brand_filter = implode('","', $brand);
		    	  $ptype_filter = implode('","', $ptype);
		    	  $query.=' and psv.value In ("'.$ptype_filter.'") and b.brand In ("'.$brand_filter.'") order by p.id desc';
		    	}

		    	  else if(isset($brand) && $filter==0){
		    		 $brand_filter = implode('","', $brand);
		    		
		    		$query.=' and b.brand In ("'.$brand_filter.'")';
		    	}
		    	  else if(isset($brand) && $filter==1){
		    		 $brand_filter = implode('","', $brand);
		    		
		    		$query.=' and b.brand In ("'.$brand_filter.'") order by p.price';
		    	}
		    	  else if(isset($brand) && $filter==2){
		    		 $brand_filter = implode('","', $brand);
		    		
		    		$query.=' and b.brand In ("'.$brand_filter.'") order by p.price desc';
		    	}
		    	  else if(isset($brand) && $filter==3){
		    		 $brand_filter = implode('","', $brand);
		    		
		    		$query.=' and b.brand In ("'.$brand_filter.'") order by p.id desc';
		    	}

		    	else if(isset($ptype) && $filter==0){
		    		 $ptype_filter = implode('","', $ptype);
		    	
		    		$query.=' and psv.value In ("'.$ptype_filter.'") ';
		    	}
		    	else if(isset($ptype) && $filter==1){
		    		 $ptype_filter = implode('","', $ptype);
		    	
		    		$query.=' and psv.value In ("'.$ptype_filter.'") order by p.price ';
		    	}
		    	else if(isset($ptype) && $filter==2){
		    		 $ptype_filter = implode('","', $ptype);
		    	
		    		$query.=' and psv.value In ("'.$ptype_filter.'") order by p.price desc';
		    	}
		    	else if(isset($ptype) && $filter==3){
		    		 $ptype_filter = implode('","', $ptype);
		    	
		    		$query.=' and psv.value In ("'.$ptype_filter.'") order by p.id desc';
		    	}
		    
		    else if($filter==1){
		    	$query.=' order by p.price ';
		    }
		     else if($filter==2){
		    	$query.=' order by p.price desc';
		    }
		     else if($filter==3){
		    	$query.=' order by p.id desc ';
		    }
		    else{
		    	$query=DB::table('product as p')->select('*','c.slug as cslug','p.slug as pslug','p.logo as plogo')->join('sub_categories as c','c.id','=','p.subcategory_id')->where('c.slug',$slug)->where('p.is_deleted',0);
		    	return $query;
		    }
		    	

		    	$qry=DB::select($query);
		    
				return $qry;	


}





		public static function Search($request){

			if(!empty($request->keyword)) {
				$html='';
		$query ="SELECT distinct(p.product_name),p.slug,TO_BASE64(s.logo) as logo FROM product as p,sub_categories as  s  WHERE p.subcategory_id=s.id and p.product_name like '%$request->keyword%'  and p.status=1 ORDER BY p.product_name LIMIT 0,8";
		$result =DB::select($query);
		return $result;


		}

		}

	public static function SearchResults($slug){
$qry=DB::table('product as p')->where('p.product_name','like','%'.$slug.'%')->where('p.status',1)->paginate(20);

	return $qry;

	}

public static function ViewComments($id)
    	{
    		$qry=DB::table('review')->where('product_id',$id)->where('is_deleted',0)->orderBy('id','desc')->get();
    		return $qry;

    	}
    	public static function SubmitRating($request)
    	{
    		$data=array(
    			'name'=>$request->name,
    			'email'=>$request->email,
    			'product_id'=>$request->product_id,
    			'stars'=>$request->rate,
    			'review'=>$request->review,

    		);
    		DB::table('review')->insert($data);

    	}
	public static function ShowOrderDetails($request)
		{
			$id=$request->id;
			$qry=DB::table('order_details as od')
			->select('o.created_at','od.discount','o.payment_type','p.product_name','od.quantity as oquantity','p.price as pprice','od.total_price as oprice',)
			->join('orders as o','o.id','=','od.order_id')
			->join('product as p','p.id','=','od.product_id')
			->where('order_id',$id)
			->get();
			return $qry;

		}

    public static function ShowOrder(){

    	$user_id=Auth::guard('customer')->id();
    	$qry=DB::table('orders')->where('user_id',$user_id)->get();
    	return $qry;
    	}   
    

   	     public static function InsertOrder($Request){

    $user_id=Auth::guard('customer')->id();


	$qry=DB::select("select *,c.price as cprice,p.id as pid,pd.id as pdid,p.price as pprice,c.quantity as cquantity,(select sum(c.price*c.quantity) from cart as c,product_details as pd where pd.id=c.product_detail_id and user_id='$user_id' and c.quantity<=pd.quantity ) as total_price  from `cart` as `c` inner join `product` as `p` on `p`.`id` = `c`.`product_id` inner join `product_details` as `pd` on `pd`.`id` = `c`.`product_detail_id` where `p`.`status` = ? and `c`.`user_id` = ? and `p`.`is_deleted` = ? and `pd`.`is_available` = ? and `pd`.`is_deleted` = ? and `c`.`quantity` <= pd.quantity ",[1,$user_id,0,1,0]);



if(empty($qry)){

	return 'error';
}

if($Request->session()->has('data')){
	$paymentMethod= session('data')['payment'];
}
else{
	$paymentMethod=$Request->payment;
}



if($paymentMethod=='Credit Card'){

    \Stripe\Stripe::setApiKey('sk_test_bzzn1VwA9Pe5jMnKn3ByMHNH00K1nDHUi9');

  $charge=\Stripe\Charge::create([
  	'amount' => $qry[0]->total_price,
  	'currency' => 'usd',
  'source'=>$Request->stripeToken,
  	'receipt_email' => $Request->email,
  	 
]);


if(!isset($charge)){
	return 'error';
}

}
$price=0;
$discount=0;
	$data=array(
		'user_id'=>$user_id,
		'total_price'=>$qry[0]->total_price,
			'payment_type'=>$paymentMethod,
			'order_date'=>date('Y-m-d'),
			'is_deleted'=>0,
			'status'=>'Pending',
			'remarks'=>'Your Order is on process',
'address'=>'',
			);

	DB::table('orders')->insert($data);
	$id = DB::getPdo()->lastInsertId();
foreach ($qry as $q) {

	if($q->discount_available==1 && $q->end_discount_date>date('Y-m-d H:i:s')){
		$price=$q->price-($q->price*($q->discount_perc/100));
		$discount=$q->discount_perc;
	}
	else{
		$price=$q->price;
		$discount=0;
	}

$data2=array(
	'user_id'=>$user_id,
	'product_detail_id'=>$q->pdid,
	'product_id'=>$q->pid,
	'order_id'=>$id,
	'total_price'=>$q->cquantity*$price,
	'discount'=>$discount,
	'quantity'=>$q->cquantity,

	
	'is_deleted'=>0
	);
	DB::table('order_details')->insert($data2);



	DB::table('product_details')->where('id',$q->pdid)->decrement('quantity',$q->cquantity);
$run=DB::table('product_details')->where('id',$q->pdid)->first();

if($run->quantity==0){
	DB::table('product_details')->where('id',$q->pdid)->update(['is_available'=>0]);
	$product=DB::table('product_details')->where('product_id',$run->product_id)->get();

$result=0;

$count=0;
foreach ($product as $p) {
	if($p->quantity==0){
			$result++;
	}
	$count++;
}

if($count==$result){
	DB::table('product')->where('id',$run->product_id)->update(['status'=>0]);
}

}	DB::table('cart')->where('user_id',$user_id)->delete();

		}
$Request->session()->forget('data');
return 'success';

   	 }






public static function UpdateProfilePic($request,$path){
$user_id=Auth::guard('customer')->id();
DB::table('customers')->where('id',$user_id)->update(['photo'=>file_get_contents(storage_path('app/'.$path))]);

}
	public static function GetUserData()
	{
		$user_id=Auth::guard('customer')->id();
		$qry=DB::table('customers as u')
		
			->where('u.id',$user_id)
			->first();
		return $qry;
	}

public static function GetOrder(){
	
    	$user_id=Auth::guard('customer')->id();
	

	//$qry=DB::table('cart as c')->join('product as p','p.id','=','c.product_id')->join('product_details as pd','pd.id','=','c.product_detail_id')->where('p.status',1)->where('c.user_id',$user_id)->where('p.is_deleted',0)->where('pd.is_available',1)->where('pd.is_deleted',0)->get();
	$qry=DB::select("select *,c.price as cprice,p.price as pprice,c.quantity as cquantity from `cart` as `c` inner join `product` as `p` on `p`.`id` = `c`.`product_id` inner join `product_details` as `pd` on `pd`.`id` = `c`.`product_detail_id` where  `c`.`quantity` <= pd.quantity and `p`.`status` = ? and `c`.`user_id` = ? and `p`.`is_deleted` = ? and `pd`.`is_available` = ? and `pd`.`is_deleted` = ?  ",[1,$user_id,0,1,0]);

	
	return $qry;

}    
public static function SizeChange($request){
	$pdid=$request->pdid;
	$id=$request->id;
	$data=array(
		'product_detail_id'=>$pdid,
		'updated_at'=>date('Y-m-d H:i:s'),
	);
	$data=DB::table('cart')->where('id',$id)->update($data);
	}
public static function CartDelete($request){

	$id=$request->id;
	
	$data=DB::table('cart')->where('id',$id)->delete();
	}

	public static function QuantityUp($request){

	$id=$request->id;
$pdid=$request->pdid;
    	$user_id=Auth::guard('customer')->id();
	$d=DB::table('cart as c')->select('c.quantity as cq','pd.quantity as pq')->join('product_details as pd','pd.id','=','c.product_detail_id')->where('c.user_id',$user_id)->where('c.id',$id)->where('c.product_detail_id',$pdid)->first();
	if((($d->cq)+1)>$d->pq){
		return 'error';
	}
	else{
	$data=DB::table('cart')->where('id',$id)->increment('quantity',1);
	return $data;
	}
}



	public static function QuantityDown($request){

	$id=$request->id;
$user_id=Auth::guard('customer')->id();
	$d=DB::table('cart as c')->select('c.quantity as cq','pd.quantity as pq')->join('product_details as pd','pd.id','=','c.product_detail_id')->where('c.user_id',$user_id)->where('c.id',$id)->first();
	if($d->cq==1){
		return 'error';
	}
	else{
	$data=DB::table('cart')->where('id',$id)->decrement('quantity',1);
	return $data;
	}
}



    
public static function AddCart($request){
	$id=$request->id;
	$pid=$request->pid;
		$size=$request->size;
$price=0;
    	$user_id=Auth::guard('customer')->id();
    
	$count=DB::table('cart')->where('product_id',$id)->where('user_id',$user_id)->where('product_detail_id',$size)->count();
if($count>0){

}
else{
	$qry=DB::table('product as p')->select('p.id as pid','pd.id as pdid','p.discount_available','p.discount_perc','p.price as price','p.end_discount_date')->join('product_details as pd','p.id', '=', 'pd.product_id')->where('p.is_deleted',0)->where('p.id',$id)->where('pd.id',$size)->first();
	
	if($qry->discount_available==1 && $qry->end_discount_date>date('Y-m-d H:i:s')){
		$price=$qry->price-($qry->price*($qry->discount_perc/100));
	}
	else{
		$price=$qry->price;
	}

			$data=array(
				'product_id'=>$qry->pid,
				'product_detail_id'=>$qry->pdid,
				'price'=>$price,
				'quantity'=>1,
				'user_id'=>$user_id
				
			);
	
$qry=DB::table('cart')->insert($data);
	
}
}


}