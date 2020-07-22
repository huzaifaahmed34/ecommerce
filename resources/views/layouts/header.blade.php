
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop | H-Shopper</title>
    <link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/css/responsive.css')}}" rel="stylesheet">
	
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('public/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('public/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('public/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('public/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('public/images/ico/apple-touch-icon-57-precomposed.png')}}">
<style type="text/css">
	.head1 a{
		color: white!important;
	}
</style>
</head><!--/head-->

<body>
	<header id="header" style=""><!--header-->
		<div class="header_top" style="
    background: #363432;;"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6 ">
						<div class="contactinfo">
							<ul class="nav nav-pills head1">
								<li><a href=""><i class="fa fa-phone"></i> <?php echo Session::get('cphone');?></a></li>
								<li><a href=""><i class="fa fa-envelope"></i> 
									<?php echo Session::get('cemail');?></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav head1">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="{{asset('public/images/home/logo.png')}}" alt="" /></a>
						</div>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
									@if(Auth::guard('customer')->check())
								<li><a href="{{url('/Profile')}}"><i class="fa fa-user"></i> Account</a></li>
								@endif
								<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="{{url('/Order')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="{{url('Cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>

								@if(Auth::guard('customer')->check())
			
								<li>       <a class="nav-link" href="{{ url('CustomerLogin') }}"

            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('Adminlogout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
								@else
								<li><a href="{{url('CustomerLogin')}}"><i class="fa fa-lock"></i> Log in</a></li>
						
@endif



							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{url('/home')}}">Home</a></li>
							

                                <li>
                                	
                                </li>
								<li class="dropdown"><a href="#">Categories<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                       <?php 
         
            $qry=DB::select("select * from categories where is_deleted=0");
            $r=$qry;

             

            foreach($r as $row1){
$m=$row1->id;
            ?>
             <li  class="dropdown  .dropdown-menu-right"><a  class="dropbtn "><?php echo $row1->category_name ?></a><?php
                $qry1=DB::select("select * from sub_categories as s,categories as c where s.category_id=c.id and s.is_deleted=0 and c.is_deleted=0 and s.category_id='$m'");
            $r1=$qry1; ?>
                   
             </li><br>
           <?php }
           ?>
                                    </ul>
                                </li> 
								<li><a href="{{url('/AboutUs')}}">About Us</a></li>
								<li><a href="contact-us.html">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="search_box pull-right" style="width: 100%">
						
							<input type="text" id="search-box" style="width: 100%;background-image:none!important; "  placeholder="Search Anything" />
	<div id="suggesstion-box"></div>
						</div>
					</div>
				</div>
				</div>
			</div>
	</header>
	    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


	<script type="text/javascript">
$(document).ready(function(){
	$("#search-box").keyup(function(e){
		$.ajax({
		type: "get",
		url: "<?php echo route('search')?>",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#B2B2B2; url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(res){
			html='';		
		html+='<ul id="country-list">';
for(var i=0;i<res.length;i++){

		html+='<li class=searchlist onClick="selectCountry(\''+res[i].product_name+'\');"><a href=javascript: class="searchbar"><img src="data:image/png;base64,'+res[i].logo+'" width=40px height=40px> '+res[i].product_name+'</a></li>';
		} 
		html+='</ul>';
	
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(html);
			$("#search-box").css("background","#B2B2B2;");
					$("#suggesstion-box").css("background","#B2B2B2;");
		}
		});
		if(e.which==13){
			if($(this).val()!=''){
			window.location.href='<?php echo url('Search')?>/'+$(this).val()+'';
		}
		}
	});
});

//To select country name
function selectCountry(val) {
$("#search-box").val(val)
$("#suggesstion-box").hide();
window.location.href='<?php echo url('Search')?>/'+val+'';
}
</script>
	@yield('content')






	@yield('footer')