@extends('layouts.header')

@extends('layouts.footer')


@section('content')	
		<style type="text/css">
									ul{
										background: none!important;

									}
									.checked {
  color: orange;
}
								</style>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@php 
							$r=DB::select('select * from categories as c where c.is_deleted=0 ');
							$i=0;foreach($r as $r){
							
							$cid=$r->id;
								$i++; 
							@endphp 
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
	<a  data-parent="#accordian" href="{{url('CategoriesSearch/')}}/{{$r->slug}}">
										@php

									$row1=DB::table('sub_categories')->where('is_deleted',0)->where('category_id',$cid)->count();
									 

								
													@endphp
															@if($row1>0)
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
			
					</div>
				</div>
	
				@if(isset($product_detail))
				@php
	$pdid=0;
	$price=0;
	@endphp
	@foreach($product_detail as $p)
	@php
	$product_name=$p->product_name;
	$subcategory=$p->name;

$brand_id=$p->brand_name;	
@endphp
@if($loop->first)
@php
	$pdid=$p->pdid;
	@endphp
@endif
@endforeach
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="data:image/png;base64,{{ chunk_split(base64_encode($p->logo)) }}" alt="" width="100%" height="200px;" />
								<h3>ZOOM</h3>
							</div>
						
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$product_name}}</h2>
								<p>Product Code: {{$p->product_code}}</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>

							<?php							
			if($p->discount_available==1 && $p->end_discount_date>date('Y-m-d H:i:s')){
				?>
												<h4 style="margin-bottom: -0px;">Rs {{$p->price-($p->price*($p->discount_perc/100))}}</h4>
												<p style="margin-bottom: -0px"><del>Rs {{$p->price}}</del> <small id=discount>{{$p->discount_perc}}% Off</small></h4>
												<?php }
												else{
													?>
												<h2 style="margin-top: 20px;">Rs {{$p->price}}</h2 >

									<?php 
								}?>
									
									<form method="post" action="{{url('/AddCart')}}">
									 {{csrf_field()}} 
										<input type="hidden" name=id value="{{$p->pid}}">
											
											<div class="form-group">
													<?php if($p->size=='')
							{?>
										
						
								<input name="size" type="hidden" value="{{$p->pdid}}">
							<?php }
							else{
								?>

								<label>Select Size</label>
								<select name=size >
								<?php

							$pd=DB::table('product_details')->where('product_id',$p->pid)->where('quantity','>',0)->get();
							foreach ($pd as $pd) {
					
								?>
							
							<option  value="{{$pd->id}}">{{$pd->size}}</option>
							<?php 
							
						}
						}
							?>

								</select>
</div>
<?php 

if($p->status==0){
	echo "<h4 style='color:red;'>Product Not Available</h4>";
}
else{?>
									<button type=submit class="btn btn-fefault cart" style="margin-left: 0px;">Add To Cart
										<i class="fa fa-shopping-cart"></i>
</button>		
<?php 
}?>								
									</form>
								</span>
							
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> {{$p->brand}}</p>
								<p><b>Warranty Type:</b> {{$p->warranty_type}}</p>
								<p><b>Warranty Period:</b> {{$p->warranty_period}}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Details</a></li>
								
								<li><a href="#tag" data-toggle="tab">Specifications</a></li>
						<li><a href="#refund" data-toggle="tab">Refund Policy</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class=col-md-12
								>

								<p>{{$p->short_desc}}</p>
								{!!$p->long_desc!!}
							</div>
								
							</div>
							
							<div class="tab-pane fade" id="refund" >
								<div class=col-md-12
								>

								
								{!!$p->warranty_policy!!}
							</div>
								
							</div>
							
						
							
							<div class="tab-pane fade" id="tag" >
							
							<table class="table table-bordered">
								
								<thead>
									<tr>
										<th>Name</th>
										<th>Specification</th>
									</tr>
								</thead>
								<tbody>
									<?php 
	$run=DB::table('product_spec_values as psv')->join('product_spec as ps','psv.product_spec_id','=','ps.id')->where('psv.product_id',$p->pid)->get();
									foreach($run as $r){?>
									<tr>
										<td>{{$r->name}}</td>
										<td>{{$r->value}}</td>
									</tr>
								<?php }?>
								</tbody>
							</table>
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i></a></li>
										<li><a href=""><i class="fa fa-clock-o"></i><?php echo date('H:i:s')?></a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i><?php echo date('d-m-Y')?></a></li>
									</ul>
									<p></p>
									<p><b>Write Your Review About this Product</b></p>
									
									<form id=form1 action='<?php echo url('SubmitRating')?>' method="post">
										<span>
											<input type="hidden" name="product_id" value="{{$p->pid}}">
											<input type="text" name=name placeholder="Your Name"/>
											<input type="email" name=email placeholder="Email Address"/>
										</span>
										<textarea name="review" ></textarea>
										<div class="col-sm-12 ml-0">
										 <div class="rate " style="margin-left: -15px;">
    <input type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text"  name="rate"  value="5" >5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text"  name="rate"  value="4">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text"  name="rate"  value="3">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text"  name="rate"  value="2">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text"  name="rate"  value="1">1 star</label>

  </div> 
</div>
  <div class="">
  	<span style="color:red" id=errorrating></span>
  	<b>Rate this Product</b>
  </div>

										<button type="button" class="btnsubmit btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
					
								<div class="col-sm-12">
									
									<p><b>People Reviews about the product</b><br>Total Comments : <span id="reviewlength"></span></p>
									
									
								</div>
								<div class="comments">
								</div>
								       <!-- First Comment -->
      
							</div>
									</div>
							
						</div>
					</div><!--/category-tab-->
			</div>
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">People Also Search For</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
							

									@php 

							$r=DB::select("select *,p.logo as logo from product as p,brand as b where p.is_deleted=0 and p.brand_name=b.id and p.status=1 and  b.id='$brand_id' limit 12 ");
							$i=0;
						
							@endphp
							@foreach($r as $r)	
								@if($loop->first)
								<div class="item active">
								@endif
									@if($loop->index<=3)
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="data:image/png;base64,{{ chunk_split(base64_encode($r->logo)) }}"  style=width:100px!important; alt=""  height="100px;" />
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
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									@endif
									@if($loop->index==3)
								</div>
								<div class="item ">
									@endif




										
									@if($loop->index>3 && $loop->index<=7)
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="data:image/png;base64,{{ chunk_split(base64_encode($r->logo)) }}" style=width:100px!important; alt=""  height="100px;" />
													<h2>{{$r->price}}</h2>
													<p><?php echo substr($r->product_name,0,30)?></p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									@endif
									@if($loop->index==7)
								</div>
								<div class="item">
									@endif
								


										
									@if($loop->index>7 && $loop->index<=11)
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
												<img src="data:image/png;base64,{{ chunk_split(base64_encode($r->logo)) }}" alt="" style=width:100px!important; height="100px;" />
													<h2>{{$r->price}}</h2>
													<p><?php echo substr($r->product_name,0,30)?></p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									@endif
									@if($loop->index==11)
								</div>
							
									@endif




											
								@endforeach
								
						</div>
 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>		

							</div>
								
						</div>
					</div><!--/recommended_items-->
					
				</div>
				@endif
			</div>
		</div>
	</section>
	@endsection('content')


 <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
  $(function(){
var rate='';
$('input[name=rate]').unbind().click(function(){
rate=$(this).attr('value');

});
showdata();
function showdata(){
var id=$('input[name=product_id]').val();

var url='<?php echo url('ViewComments')?>/'+id;
	$.ajax({
		type:'ajax',
		method:'get',
	
		url:url,
		dataType:'json',
		async:false,
		success:function(res){
			var html='';
var star='';
$('#reviewlength').html(res.length);
			for(var i=0;i<res.length;i++){
				if(res[i].stars==1){
						star='<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star "></span>'+
						'<span class="fa fa-star "></span>'+
						'<span class="fa fa-star"></span>'+
						'<span class="fa fa-star"></span>';
				}
				else if(res[i].stars==2){
						star='<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star "></span>'+
						'<span class="fa fa-star"></span>'+
						'<span class="fa fa-star"></span>';

				}
				else if(res[i].stars==3){
						star='<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star"></span>'+
						'<span class="fa fa-star"></span>';

				}

				else if(res[i].stars==4){
						star='<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star"></span>';
					
				}
				else if(res[i].stars==5){
						star='<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>';
					
				}
	    html+='<article class="row">'+
            '<div class="col-md-2 col-sm-2 hidden-xs">'+
             ' <figure class="thumbnail">'+
                '<img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />'+
               '<figcaption class="text-center">'+star+'</figcaption>'+
             '</figure>'+
           '</div>'+
           ' <div class="col-md-10 col-sm-10">'+
            '  <div class="panel panel-default arrow left">'+
             '   <div class="panel-body">'+
                 '<header class="text-left">'+
                    '<div class="comment-user"><i class="fa fa-user"></i><span id=commentname> '+res[i].name+'</span>'+'</div>'+
                   '<time class="comment-date" ><i class="fa fa-clock-o"></i><span id=comment> '+res[i].created_at+'</span></time>'+
                  '</header>'+
                  '<div class="comment-post">'+
                    '<p id=commentreview>'+res[i].review+'</p>'+
                 ' </div>'+
                 ' <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>'+
                '</div>'+
             ' </div>'+
           '</div>'+
          '</article>';
			};
			$('.comments').html(html);
		},
		error:function(){

		}

 });
}; 

$('.btnsubmit').unbind().click(function(){

var data=$('#form1').serialize();
var name=$('input[name=name]');
var address=$('input[name=email]');
var review=$('textarea[name=review]');

var result='';
if(name.val()==""){
name.attr('style','border:1px solid #ca4f4f;');
}else{
name.removeAttr('style','border:1px solid #ca4f4f;');
result+='1';
}
if(address.val()==""){
address.attr('style','border:1px solid #ca4f4f;');
}else{
address.removeAttr('style','border:1px solid #ca4f4f;');
result+='1';
}
if(review.val()==""){
review.attr('style','border:1px solid #ca4f4f;');

}else{
review.removeAttr('style','border:1px solid #ca4f4f;');
result+='1';
}
if(rate==''){

$('#errorrating').html('Please Give Rating');
}else{
$('#errorrating').html("");
result+='1';
}

if(result=='1111'){
var url='<?php echo url('SubmitRating')?>';
	$.ajax({
		type:'ajax',
		method:'post',
		data:data,
		url:url,
		dataType:'json',
		async:false,
		success:function(response){
		
				$('#form1')[0].reset();
				showdata();
		
			
		},
		error:function(){
alert('Plz Give Rating');
		}

 });
}
}); 
});
</script>