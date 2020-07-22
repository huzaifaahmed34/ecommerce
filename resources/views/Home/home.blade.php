@extends('layouts.header')

@extends('layouts.footer')


@section('content')	
<style type="text/css">
	.item{
		padding-left: 0px;
	}
		.fa-star{
		color: silver;
	}
	.checked{
		color: orange!important;
	}
	.overlay{
	position: absolute;
	height: 100%;
	width: 100%;
	background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.9));
	bottom: 1px;

	
}h4{
	color:#FE980F;
}

.text{bottom: 15%;
width: 100%;

	color: white;
	position: absolute;
}
.text h1{
	font-size: 70px;
	font-weight: bold;
	margin-top: -5px;
	 font-family: initial;
	margin-bottom: 5px;	
	}
.contr {
    position: relative;
    text-align: center;
}
</style>


	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner" style="padding-left: 0px!important;">
							<div class="item active">
								<div class="row" >
								<div class="col-sm-6">
									<h1><span>H</span>-SHOPPER</h1>
									<h2>Every Day Essentials</h2>
									<p>Your One Time Solutions. </p>
									
								</div>
								<div class="col-sm-6">
									<img src="{{asset('public/images/home/girl2.jpg')}}" width="100%" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
						</div>
						<div class="item ">
								<div class="row" >
								<div class="col-sm-6">
									<h1><span>H</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									
								</div>
								<div class="col-sm-6">
									<img src="{{asset('public/images/home/girl1.jpg')}}" width="100%" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
						</div>
						<div class="item ">
								<div class="row" >
								<div class="col-sm-6">
									<h1><span>H</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								
								</div>
								<div class="col-sm-6">
									<img src="{{asset('public/images/home/girl3.jpg')}}" width="100%" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>
						</div>
							
						</div>

						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
												</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
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
					
									
				<div class="shipping text-center"><!--shipping-->
              <img src="{{asset('public/images/home/shipping.jpg')}}"   height=130px  alt="">
                   <img src="{{asset('public/images/home/shipping.jpg')}}"   alt="">
            </div>
						
					
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Featured Items</h2>
						@php 
				$qry=DB::select("SELECT p.discount_available,p.end_discount_date,p.discount_perc,p.id,p.product_code,p.category_id,p.subcategory_id,p.price,p.tags,p.brand_name,p.short_desc,p.long_desc,AVG(r.stars) ,CASE
   					 WHEN AVG(r.stars) >= 1 and AVG(r.stars) <1.5 THEN 1
   				     WHEN AVG(r.stars) >= 1.5 and AVG(r.stars) <2 THEN 2
        			 WHEN AVG(r.stars) >= 2 and AVG(r.stars) <2.5 THEN 2
         			 WHEN AVG(r.stars) >= 2.5 and AVG(r.stars) <3 THEN 3
           			 WHEN AVG(r.stars) >= 3 and AVG(r.stars) <3.5 THEN 3
            		 WHEN AVG(r.stars) >= 3.5 and AVG(r.stars) <4 THEN 4
             		 WHEN AVG(r.stars) >= 4 and AVG(r.stars) <4.5 THEN 4
              		 WHEN AVG(r.stars) >= 4.5  THEN 5
					END AS stars,p.logo,p.product_name,p.slug  FROM `product` as p left JOIN review as r
						ON r.product_id = p.id where p.tags='Featured' GROUP by p.id,p.product_code,p.logo,p.product_name,p.slug,p.category_id,p.discount_perc,p.discount_available,p.subcategory_id,p.price,p.tags,p.brand_name,p.short_desc,p.end_discount_date,p.long_desc order by rand(p.id) desc limit 8");
						foreach($qry as $q){
			
						@endphp
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="data:image/png;base64,{{ chunk_split(base64_encode($q->logo)) }}" alt="" width="100%" height="150px;" />
			<?php							
			if($q->discount_available==1 && $q->end_discount_date>date('Y-m-d H:i:s')){
				?>
												<h4 style="margin-bottom: -0px;">Rs {{$q->price-($q->price*($q->discount_perc/100))}}</h4>
												<p style="margin-bottom: -0px"><del>Rs {{$q->price}}</del> <small id=discount>{{$q->discount_perc}}% Off</small></h4>
												<?php }
												else{
													?>
												<h4 style="margin-top: 20px;">Rs {{$q->price}}</h4>

									<?php 
								}?>

											<p style="font-size: 17px;"><b><?php echo substr($q->product_name,0,21)?></b></p>
											<p>	
					@if($q->stars==1)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star"></span>
						<span class="fa fa-star"></span>
			
				@elseif($q->stars==2)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star"></span>
						<span class="fa fa-star"></span>

				
				@elseif($q->stars==3)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star"></span>
						<span class="fa fa-star"></span>

				@elseif($q->stars==4)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star"></span>
					
				
				@elseif($q->stars==5)
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
									</p>				<a href="{{url('/ProductDetail')}}/{{$q->slug}}" class="btn btn-default 5 add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>
											
										
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>{{$q->price}}</h2>
												<p><?php echo substr($q->product_name,0,30)?></p>
													<a href="{{url('/ProductDetail/')}}/{{$q->slug}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>
												

											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									
									</ul>
								</div>
							</div>
						</div>
						@php
				}
				@endphp
					</div>
						<div class="row " style="margin-bottom: 40px;">
	<div class="col-sm-12 text-right">
		<h4 class="title"><a href="{{url('Featured')}}"><u>More Items >>></u></a></h4>
	</div>
	
</div>
					</div><!--features_items-->






<div class="col-sm-12" style="margin-top: 50px;margin-bottom: 40px;">


	
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Most Ordered Products</h2>
				
				@if (count($data) > 0)
<section class="books" id="tag_container" >
        @include('Home.presult')
  </section>

@endif</div>
				
					</div>



<div class="col-sm-12" style="margin-top: 50px;margin-bottom: 40px;">

			<div class="contr" >
			<img src="{{asset('public/images/slider/k.webp')}}" style="object-fit:cover;" width="100%" height="240px;">
			<div class="overlay">
			</div>
			<div class="text">
					<p>SAVE UP TO</p>
					<h1>50%</h1>
					<p>ON OUR GALLA DRESSES</p>
								<button class="btn addt">Buy now</button>

				</div>
		</div>
	
</div>







								<div class="col-sm-12 padding-right ">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Latest Items</h2>

						<div class=row>
						@php 
						$qry=DB::select("SELECT p.discount_available,p.end_discount_date,p.discount_perc,p.id,p.product_code,p.category_id,p.subcategory_id,p.price,p.tags,p.brand_name,p.short_desc,p.long_desc,AVG(r.stars) ,CASE
   					 WHEN AVG(r.stars) >= 1 and AVG(r.stars) <1.5 THEN 1
   				     WHEN AVG(r.stars) >= 1.5 and AVG(r.stars) <2 THEN 2
        			 WHEN AVG(r.stars) >= 2 and AVG(r.stars) <2.5 THEN 2
         			 WHEN AVG(r.stars) >= 2.5 and AVG(r.stars) <3 THEN 3
           			 WHEN AVG(r.stars) >= 3 and AVG(r.stars) <3.5 THEN 3
            		 WHEN AVG(r.stars) >= 3.5 and AVG(r.stars) <4 THEN 4
             		 WHEN AVG(r.stars) >= 4 and AVG(r.stars) <4.5 THEN 4
              		 WHEN AVG(r.stars) >= 4.5  THEN 5
					END AS stars,p.logo,p.product_name,p.slug  FROM `product` as p left JOIN review as r
						ON r.product_id = p.id where p.tags='' and p.status=1  GROUP by p.id,p.product_code,p.logo,p.product_name,p.slug,p.category_id,p.subcategory_id,p.price,p.discount_available,p.discount_perc,p.tags,p.brand_name,p.end_discount_date,p.short_desc,p.long_desc order by p.id desc");
						foreach($qry as $q){
					
						@endphp
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
										<img src="data:image/png;base64,{{ chunk_split(base64_encode($q->logo)) }}" alt="" width="100%" height="200" />
									<?php		
									if($q->discount_available==1  && $q->end_discount_date>date('Y-m-d H:i:s')){?>
												<h4 style="margin-bottom: -0px;">Rs {{$q->price-($q->price*($q->discount_perc/100))}} </h4>
												<p style="margin-bottom: -0px"><del>Rs {{$q->price}}</del> <small id=discount>{{$q->discount_perc}}% Off</small></h4>
												
										<?php
									}else{
									?>
												<h4 style="margin-top: 20px;">Rs {{$q->price}}</h4>

											<?php } ?>
											<p style="font-size: 17px;"><b><?php echo substr($q->product_name,0,30)?></b></p>
												<p>	
					@if($q->stars==1)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star"></span>
						<span class="fa fa-star"></span>
			
				@elseif($q->stars==2)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star "></span>
						<span class="fa fa-star"></span>
						<span class="fa fa-star"></span>

				
				@elseif($q->stars==3)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star"></span>
						<span class="fa fa-star"></span>

				@elseif($q->stars==4)
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star"></span>
					
				
				@elseif($q->stars==5)
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
											<a href="{{url('/ProductDetail/')}}/{{$q->slug}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>
										
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
									
											@if($q->discount_available==1)
												<h4 style="margin-bottom: -0px;">Rs {{$q->price-($q->price*($q->discount_perc/100))}}</h4>
												<p style="margin-bottom: -0px"><del>Rs {{$q->price}} </del> <small id=discount>{{$q->discount_perc}}% Off</small></h4>
												
												@else
												<h4 style="margin-top: 20px;">Rs {{$q->price}}</h4>

											@endif
												<p><?php echo substr($q->product_name,0,30)?></p>
												<a href="{{url('/ProductDetail/')}}/{{$q->slug}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>
												
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										
									</ul>
								</div>
							</div>
						</div>

						@php
				}
				@endphp
					</div>

				</div>
						</div>
</div>

			
				
						
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>


@endsection('content')

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('body').on('click', '.pagination a', function (e) {
            e.preventDefault();
         
            var url = $(this).attr('href');
            window.history.pushState("", "", url);
            loadBooks(url);
        });

        function loadBooks(url) {
      
            $.ajax({
                url: url,

            }).done(function (data) {

                $('.books').html(data);

            }).fail(function () {
                console.log("Failed to load data!");
            });
        }
    });
</script>