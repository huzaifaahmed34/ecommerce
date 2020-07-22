@extends('layouts.header')

@extends('layouts.footer')


@section('content')
<style type="text/css">
	#slider12b .slider-track-low, #slider12c .slider-track-low {
	background: red;
}
.fa-star{
		color: silver;
	}
	.checked{
		color: orange!important;
	}
label{
	color:black;
}#loadMore {
    padding: 10px;
    text-align: center;
    background-color: #33739E;
    color: #fff;
    border-width: 0 1px 1px 0;
    border-style: solid;
    border-color: #fff;
    box-shadow: 0 1px 1px #ccc;
    transition: all 600ms ease-in-out;
    -webkit-transition: all 600ms ease-in-out;
    -moz-transition: all 600ms ease-in-out;
    -o-transition: all 600ms ease-in-out;
}
#loadMore:hover {
    background-color: #fff;
    color: #33739E;
}
  #gif{
              z-index: 1000;
    top: 50%;
    left: 50%;
    position: fixed;
           }
</style>
@php
$type='';
$row1='';
$header='';
$subcategory='';
if(isset($Featured)){
$type='Featured';
$header='Featured Products';

		$row1=DB::table('product as p')->select('*','p.slug as pslug','p.logo as plogo','p.id as pid')->where('p.tags','Featured')->where('p.is_deleted',0)->where('p.status',1)->paginate(15);

}

elseif(isset($category_slug)){

			$row1=DB::table('product as p')->select('*','c.slug as cslug','p.slug as pslug','p.logo as plogo')->join('categories as c','c.id','=','p.category_id')->where('c.slug',$category_slug)->where('p.is_deleted',0)->paginate(15);

				}
						

elseif(isset($subcategory_slug)){
						$subcategory=$subcategory_slug;
							$type='Sub_Category';
							$sub=DB::table('sub_categories')->where('slug',$subcategory)->first();
					$header=$sub->name;
			$row1=DB::table('product as p')->select('*','c.slug as cslug','p.slug as pslug','p.logo as plogo','p.id as pid','c.logo as clogo')->join('sub_categories as c','c.id','=','p.subcategory_id')->where('c.slug',$subcategory_slug)->where('p.is_deleted',0)->paginate(15);

			
					}	
			
@endphp


	
	<section id="advertisement">
		<div class="container">
			<img src="data:image/png;base64,{{ chunk_split(base64_encode($sub->logo)) }}"  height=200px alt="" />

		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<img src="{{asset('public/dist/img/gif.gif')}}" style="display:block;" width="125px;" id=gif>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@php 
							$r=DB::select('select * from categories as c where c.is_deleted=0 ');
							$i=0;
							foreach($r as $r){
							
							$cid=$r->id;
						$slug=$r->slug;

								$i++; 
							@endphp 
							<div class="panel panel-default">
											<div class="panel-heading">
									<h4 class="panel-title">
	<a  data-parent="#accordian" href="{{url('CategoriesSearch/')}}/{{$slug}}">
										@php

									$categ=DB::table('sub_categories')->where('is_deleted',0)->where('category_id',$cid)->count();
									 

								
													@endphp
															@if($categ>0)
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear{{$i}}" href="{{url('Home')}}">
												
										

											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
										
										
						@endif
						

											{{$r->category_name}}
										</a>
									</h4>
								</div>
								@php
	$row=DB::select("select * from sub_categories as s where s.is_deleted=0 and s.category_id=$cid");
						

							@endphp
								<div id="sportswear{{$i}}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>

							@foreach($row as $r)

											<li><a  href="{{url('SubCategoriesSearch/')}}/{{$r->slug}}">{{$r->name}} </a></li>
											@endforeach
										</ul>
									</div>
								</div>

							</div>
							@php
							
						}
						@endphp
						
						</div><!--/category-products-->






						<h2>Brand</h2>
										<div class="panel-group category-products" id="accordian">
							<div class="panel panel-default">
											<div class="panel-heading">
									
											<div class="row">
												@php 
												$run=DB::table('brand as b')->select('b.id as bid','brand as brand')->join('sub_categories as s','b.subcategory_id','=','s.id')->where('s.slug',@$subcategory_slug)->get();
												@endphp
												@foreach($run as $run)
						<div class="col-sm-12">
							
	<input type="checkbox" class="common-selector brand" id=brand value="{{$run->brand}}" name="brand"/><label>{{$run->brand}}</label>
								
								</div>
								@endforeach
									
								</div>
									
								</div>
		</div>				

						
						</div><!--/category-products-->
								<div class="row" style="margin-bottom: 20px;">
<div class="col-sm-12">
		<p><b>Price Range</b></p>
</div>
								<div class="col-sm-5">

						<input type="number" name=minprice min="0" class="form-control" placeholder="Min"  pattern="[0-9]*" value="0">
					</div>
						<div class="col-sm-5"><input type="number" min="0"  class="form-control"placeholder="Max" value="999999" pattern="[0-9]*" id=price name=maxprice>
						</div>
<div class="col-sm-2 text-left" style="margin-top: -16px;">
						<button type="button" class=" btn btn-primary searchprice" >Go</button>
					</div>
						</div>

<div class="row" style="margin-bottom: 30px;">
	<div class="col-sm-12">

	@php 
	$coun=0;
	$run='';
	if($type=='Sub_Category'){

					$run=DB::select("SELECT distinct(ps.name) as psname,ps.id as psid FROM `product_spec_values` as psv,product_spec as ps,product as p,sub_categories as s where psv.product_id=p.id and psv.product_spec_id=ps.id and p.subcategory_id=s.id and s.slug='$subcategory_slug' limit 8");
					

												@endphp
						@foreach($run as $run)
									<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse{{$coun}}">{{$run->psname}}<i class="fa fa-angle-down push-right "></i></a>
      </h4>
    </div>
    <div id="collapse{{$coun}}" class="panel-collapse collapse">
      <ul class="list-group">
      		@php	
							$coun++;			$r=DB::select("SELECT distinct(psv.value) as psvname FROM `product_spec_values` as psv,product_spec as ps,product as p where psv.product_id=p.id and psv.product_spec_id=ps.id  and ps.id='$run->psid' ");
@endphp
@foreach($r as $r)
        <li class="list-group-item"><input type="checkbox" class="common-selector ptype" name="ptype" id=ptype value="{{$r->psvname}}" />&nbsp;&nbsp;&nbsp;<label>{{$r->psvname}}</label></li>
        	@endforeach
      
      </ul>
    
    </div>
  </div>
</div>
						

											
				
				@endforeach

				@php
			}
			@endphp
						</div></div >
					
					</div>
				
					
				</div>
				
				<div class="col-lg-9 " >
				<div class="col-lg-3" style="float:right;">
<select class="form-control " id="filter" >
	<option value="0">Relevance</option>
	<option value="1">Price-Low To High</option>
		<option value="2">Price-High To Low</option>
			<option value="3">Newest First</option>
				<option value="4">Popularity</option>
</select>

</div>
</div>


<div id="image" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"><br>Loading..</div>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">{{$header}}</h2>
<div id=showdata>

						@foreach($row1 as $r)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
									<img src="data:image/png;base64,{{ chunk_split(base64_encode($r->plogo)) }}" alt="" width="100%" height="200px;" />
								<?php							
			if($r->discount_available==1 && $r->end_discount_date>date('Y-m-d H:i:s')){
				?>
												<h4 style="margin-bottom: -0px;">Rs {{$r->price-($r->price*($r->discount_perc/100))}}</h4>
												<p style="margin-bottom: -0px"><del>Rs {{$r->price}}</del> <small id=discount>{{$r->discount_perc}}% Off</small></h4>
												<?php }
												else{
													?>
												<h4 style="margin-top: 20px;">Rs {{$r->price}}</h4>

									<?php 
								}?>
											<p><?php echo substr($r->product_name,0,30)?></p>
												<a href="{{url('/ProductDetail/')}}/{{$r->pslug}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>
							<?php 

							$s=DB::select("select CASE
   					 WHEN AVG(r.stars) >= 1 and AVG(r.stars) <1.5 THEN 1
   				     WHEN AVG(r.stars) >= 1.5 and AVG(r.stars) <2 THEN 2
        			 WHEN AVG(r.stars) >= 2 and AVG(r.stars) <2.5 THEN 2
         			 WHEN AVG(r.stars) >= 2.5 and AVG(r.stars) <3 THEN 3
           			 WHEN AVG(r.stars) >= 3 and AVG(r.stars) <3.5 THEN 3
            		 WHEN AVG(r.stars) >= 3.5 and AVG(r.stars) <4 THEN 4
             		 WHEN AVG(r.stars) >= 4 and AVG(r.stars) <4.5 THEN 4
              		 WHEN AVG(r.stars) >= 4.5  THEN 5
					END  as stars from review as r,product as p where p.id=r.product_id and p.id='$r->pid'");

					?>
								<p>	
					@if($s[0]->stars==1)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star"></span>
						<span class="fa fa-star"></span>
			
				@elseif($s[0]->stars==2)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star"></span>
						<span class="fa fa-star"></span>

				
				@elseif($s[0]->stars==3)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star"></span>
						<span class="fa fa-star"></span>

				@elseif($s[0]->stars==4)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star"></span>
					
				
				@elseif($s[0]->stars==5)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
				@else
					<span class="fa fa-star"></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star"></span>
			
				@endif
	</p>


									</div>
									<div class="product-overlay">
										<div class="overlay-content">
												<?php							
			if($r->discount_available==1 && $r->end_discount_date>date('Y-m-d H:i:s')){
				?>
												<h4 style="margin-bottom: -0px;">Rs {{$r->price-($r->price*($r->discount_perc/100))}}</h4>
												<p style="margin-bottom: -0px"><del>Rs {{$r->price}}</del> <small id=discount>{{$r->discount_perc}}% Off</small></h4>
												<?php }
												else{
													?>
												<h4 style="margin-top: 20px;">Rs {{$r->price}}</h4>

									<?php 
								}?>
											<p>{{$r->product_name}}</p>
												<a href="{{url('/ProductDetail/')}}/{{$r->pslug}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>
										
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
					
						@endforeach
<div class="col-sm-12 text-center">
<ul class="pagination " >
						{{$row1->links()}}
					
						</ul>
						

</div>
					</div>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
	
	@endsection('content')


 <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<script type="text/javascript">
	$(function(){


		var slug='<?php echo $subcategory ?>';
		var type='<?php echo $type ?>';

$('#filter').unbind().change(function(){
filter();
});

		function select(value){
				var array=[];

		 $('#'+value+':checked').each(function(){
        		array.push($(this).val());
        });
		
		return array;
		}

  
    $("#showdata").on('click','#loadMore', function () {
     
        $(".coloum:hidden").slice(0, 10).slideDown();
        if ($(".coloum:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }
      
    });



			$('.common-selector').unbind().click(function(){
				filter();
			});
			$('.searchprice').unbind().click(function(){
			
filter();
});
				function filter(){
					var minprice=$('input[name=minprice]').val();
					var maxprice=$('input[name=maxprice]').val();
					var filter=$('#filter').val();	
					var brand=select('brand');
					var ptype=select('ptype');

	
			$.ajax({
					method:'get',
					data:{'brand':brand,'ptype':ptype,'slug':slug,'minprice':minprice,'maxprice':maxprice,'filter':filter,'type':type},
					url:'<?php echo url('getFilter')?>',
					dataType:'json',
					async:'false',
			cache:false,
        beforeSend: function(){
 $("#gif").removeAttr('style','display:none');
    },      complete: function(){
      $("#gif").attr('style','display:none');
      },

					success:function(res){
						 $("#gif").removeAttr('style','display:none');
						var html='';

					for(var i=0;i<res.length;i++){
		    
		   html+='<div class="col-sm-4 coloum" id=coloum style="display:none">'+
							'<div class="product-image-wrapper">'+
								'<div class="single-products">'+
									'<div class="productinfo text-center">'+
									'<img src="data:image/png;base64,'+res[i].plogo+'" alt="" width="100%" height="200px;" />'+
											'<h2>'+res[i].price+'</h2>'+
											'<p>'+(res[i].product_name).slice(0,20)+'</p>'+
						'<a href="<?php echo url('ProductDetail/')?>/'+res[i].pslug+'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>'+
									
									'</div>'+
									'<div class="product-overlay">'+
										'<div class="overlay-content">'+
											'<h2>'+res[i].price+'</h2>'+
											'<p>'+res[i].product_name+'</p>'+
							'<a href="<?php echo url('ProductDetail/')?>/'+res[i].pslug+'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>'+
											
										'</div>'+
									'</div>'+
								'</div>'+
								'<div class="choose">'+
									'<ul class="nav nav-pills nav-justified">'+
										'<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>'+
										'<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>'+
									'</ul>'+
								'</div>'+
							'</div>'+
						'</div>';

		   	}
		   	if(res.length>20){
		html+='<div class="col-sm-12 text-center" style="margin-bottom:20px;"><a href="javascript:" id="loadMore">Load More</a><p class="totop"> </div>';
				
				}
				else{

				}$('#showdata').html(html);
						$('.coloum').slice(0, 19).show();
				
					},
					error:function(){
alert('error');
					}
			});
				
			};
		
	});
	</script>