@extends('layouts.header')

@extends('layouts.footer')


@section('content')	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
									<td class="Size">Size</td>
							<td class="quantity">Quantity</td>
					
							<td class="total">Total</td>
							<td>Remove </td>
						</tr>
					</thead>
					<tbody id=showdata>
				@if(isset($product))
				@php
				$price=0;
				$total=0;
				@endphp
				@foreach($product as $p)	
				@php
					if($q->discount_available==1 && $p->end_discount_date>date('Y-m-d H:i:s')){
											
				$price=$q->price-($q->price*($q->discount_perc/100));
				$div='<p>'.$price.' &nbsp;<del> Rs'.$p->$price.'</del></p>';
					}else{			

						$price=$q->price;
	$div='<p> Rs'.$p->$price.'</p>';
						}
				$total+=($price*$p->cquantity);
				@endphp
						<tr data="{{$p->cid}}" data1="{{($price*$p->cquantity)}}" data2="{{$p->cquantity}}" data3="{{$price}}" data4="{{$p->pdid}}">
							<td class="cart_product" style="margin-left: 0px;margin-right: 0px;">
								<a href="">	<img src="data:image/png;base64,{{ chunk_split(base64_encode($p->logo)) }}" alt="" height="100px;" width=150px/></a>
							</td>
							<td class="cart_description">
								<a href=""><h5><?php echo substr($p->product_name,0,60)?></h5></a>
								<p>Code: {{$p->product_code}}</p>
							</td>
							<td class="cart_price">
								<p>{{$price}}</p>
							</td>
							<td>
							<p>{{$p->size}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<button class="cart_quantity_up btn " > + </button>
									<input class="text-center" readonly="" type="text" name="quantity" value="{{$p->cquantity}}" autocomplete="off" size="2">
									<button class="cart_quantity_down btn " > - </button>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?php echo $price*$p->cquantity?></p>
							</td>
							<td class="cart_delete ">
								<button class=" btn  btn-danger btn-delete "  href=""><i class="fa fa-times" ></i></button>
							</td>
						</tr>
						@endforeach
						<tr   >
							<td></td><td></td>
							<td></td>
							<td></td>

							<td></td>
							<td class="text-right"><h4>Total :</h4></td>
							<td> <h4>Rs <Span id=total>{{$total}}</Span></h4></td>
					
						</tr>
				@endif
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
	<div class="container">
      <div class="heading">
        <h3>What would you like to do next?</h3>
        <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
      </div>
      <div class="row">
     <form action="index.php?q=orderdetails" method="post">
   <a href="index.php?q=product" class="btn btn-default check_out pull-left ">
   <i class="fa fa-arrow-left fa-fw"></i>
   Add New Order
   </a>

     <a class="btn btn-default check_out signup pull-right" href="{{url('Order')}}">
                              Proceed And Checkout
                              <i class="fa  fa-arrow-right fa-fw"></i>
                              </a> </form>
      </div>
    </div>
	</section><!--/#do_action-->


    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>


  $(function(){

showdata();
  	function showdata(){

var url="{{url('/ShowProductCart')}}";

$.ajax({
	type:'ajax',
		method:'get',
		url:url,
		dataType:'html',
		async:'false',

	success:function(res){
		var html='';
		var total=0;
		var s=0;


 //  		html+='	<tr data='+res[i].cid+' data1='+res[i].price*res[i].cquantity+' data2='+res[i].cquantity+' data3='+res[i].price+' data4='+res[i].pdid+'>'+
	// 						'<td class="cart_product" style="margin-left: 0px;margin-right: 0px;">'+
	// '<a href=""><img src='+src+' height=100px width=150px/></a>'+
	// 						'</td>'+
	// 						'<td class="cart_description">'+
	// 							'<a href=""><h5>'+res[i].product_name+'</h5></a>'+
	// 							'<p>Code: '+res[i].product_code+'</p>'+
	// 						'</td>'+
	// 						'<td class="cart_price">'+
	// 							'<p>'+res[i].price+'</p>'+
	// 					'	</td>'+
	// 						'<td>'+
	// 						'<p>'+res[i].size+'</p>'+
	// 						'</td>'+
	// 						'<td class="cart_quantity">'+
	// 							'<div class="cart_quantity_button">'+
	// 								'<button class="cart_quantity_up btn " > + </button>'+
	// 								'<input class="text-center" readonly="" type="text" name="quantity" value="'+res[i].cquantity+'" autocomplete="off" size="2">'+
	// 								'<button class="cart_quantity_down btn " > - </button>'+
	// 							'</div>'+
	// 						'</td>'+
	// 						'<td class="cart_total">'+
	// 							'<p class="cart_total_price">'+res[i].price*res[i].cquantity+'</p>'+
	// 						'</td>'+
	// 						'<td class="cart_delete ">'+
	// 							'<button class=" btn  btn-danger btn-delete "  href=""><i class="fa fa-times" ></i></button>'+
	// 						'</td>'+
	// 					'</tr>';
	// }
	$('#showdata').html(res);
}
,error:function(){
	alert('error');
}
})
  	}

$('#showdata').on('change','#size',function(){
	var val=$(this).val();
	var id=$(this).parent().parent().attr('data');

	$.ajax({
			method:'get',
			data:{'pdid':val,'id':id},
			url:"{{url('/SizeChange')}}",
			dataType:'json',
			async:false,
			success:function(response){

			},
			error:function(){

			}
	});
})


$('#showdata').on('click','.cart_quantity_up',function(){

	var id=$(this).parent().parent().parent().attr('data');
	var pdid=$(this).parent().parent().parent().attr('data4');
   var total=$('#total').html();
	   var price=$(this).parent().parent().parent().attr('data3');
 var quan=$(this).next('input').val();
 
var check='';
	$.ajax({
			method:'get',
			data:{'id':id,'pdid':pdid},
			url:"{{url('/QuantityUp')}}",
			dataType:'json',
			async:false,
			success:function(response){
				if(response.success){
			check='ok';	
	  
}
else{
	alert('you exceeded the available stock');
}

			},
			error:function(){

			}
	});
	if(check=='ok'){
		
		 quan=parseInt(quan)+parseInt(1);
	 
				total=parseInt(total)+parseInt(price);
		$(this).next('input').val(quan);
		$(this).parent().parent().next().find('.cart_total_price').html(price*quan);
				$('#total').html(total);
			
				$(this).parent().parent().parent().attr('data1',price*quan);
	}

});







$('#showdata').on('click','.cart_quantity_down',function(){

	var id=$(this).parent().parent().parent().attr('data');

	   var total=$('#total').html();
	   var price=$(this).parent().parent().parent().attr('data3');

 var quan=$(this).prev('input').val();
 
var check='';
	$.ajax({
			method:'get',
			data:{'id':id},
			url:"{{url('/QuantityDown')}}",
			dataType:'json',
			async:false,
			success:function(response){
				if(response.success){
			check='ok';	
	  
}
else{
	alert('Atleast 1 Quantity ');
}

			},
			error:function(){

			}
	});
	if(check=='ok'){
	
		 quan=parseInt(quan)-parseInt(1);
	 
				total=parseInt(total)-parseInt(price);
		$(this).prev('input').val(quan);
		$(this).parent().parent().next().find('.cart_total_price').html(price*quan);
				$('#total').html(total);
			
				$(this).parent().parent().parent().attr('data1',price*quan);
	}

});
$('#showdata').on('click','.btn-delete',function(){

	var id=$(this).parent().parent().attr('data');
   $(this).closest("tr").remove();
   var total=$('#total').html();
   

   var t=$(this).parent().parent().attr('data1');
     total=total-t;
	$.ajax({
			method:'get',
			data:{'id':id},
			url:"{{url('/CartDelete')}}",
			dataType:'json',
			async:false,
			success:function(response){
				$('#total').html(total);
   $(this).closest("tr").remove();

			},
			error:function(){

			}
	});
})




  });

</script>

	@endsection('content')