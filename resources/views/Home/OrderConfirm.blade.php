

@extends('layouts.header')

@extends('layouts.footer')


@section('content')

<head>
  <title>Checkout</title>
  
</head>
           


<form  method="post" id="payment-form" action="{{url('InsertOrder')}}" >   
{{csrf_field()}}
  @php


  @endphp

<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Order Details</li>
        </ol>
      </div>
      <div class="row">
      <div class="col-md-12">
        @if(Session::has('error'))
       <div class="alert-danger alert">Your Order Not Processed</div> 
        
        @endif
         @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        
      </div>
      </div>
      <div class="row ">
 
      <div class="col-md-1 " >
        <b>Name:</b>
      </div>
      <div class="col-md-11" >
     {{$userdata->firstname}}    </div>
       <div class="col-md-1 " >
        <b>Address:</b>
      </div>
      <div class="col-md-10 ">
           {{$userdata->address}}</div>
    

 
 </div>
      <div class="table-responsive cart_info"> 
 
              <table class="table table-condensed table-striped" id="table">
                <thead >
                 
                <tr class="cart_menu "> 
                  <th  >Product</th>
                  <th >Description</th>
                  <th >Unit Price</th>
                  <th >Quantity</th>
                  <th style=" align:center; ">Discount</th>
                  <th style=" align:center; ">Total</th>
                  </tr>

                </thead>
                <tbody>    
                      @php
                      $total=0;
                      @endphp 
               @foreach($res as $res)
               @php

  if($res->discount_available==1 && $res->end_discount_date>date('Y-m-d H:i:s')){
    $price=$res->pprice-($res->pprice*($res->discount_perc/100));
    $discount=$res->discount_perc;
  }
  else{
    $price=$res->pprice;
    $discount=0;
  }
               $total+=$price*$res->cquantity;


    
               @endphp
                         <tr>
                         <!-- <td></td> -->
                          <td><img src="data:image/png;base64,{{ chunk_split(base64_encode(@$res->logo)) }}" alt="" width="100" height="60px;" /></td>
                          <td>{{$res->product_name}}</td>
                           <td>Rs {{$res->price}}</td>
                          <td align="cente">{{$res->cquantity}}</td>
                             <td align="cente">{{$discount}}%</td>

                     
                          <td>Rs {{$price*$res->cquantity}}</td>
                        </tr>
                          
                          @endforeach

                </tbody>
                
              </table>  
                <div class="  pull-right">
                  <p align="right">
                  <div > Total Price :  <b>Rs <span id="sum">{{$total}}</b></span></div>
                   <div > Delivery Fee : <b> Rs <span id="fee">0.00</span></b></div>
                   <div> Overall Price :<b> Rs <span id="overall">{{$total}}</span></b></div>
                   <input type="hidden" name="alltot" id="alltot" value="{{$total}}"/>
                  </p>  
                </div>
 
      </div>
    </div>
  </section>
 
 <section id="do_action">
    <div class="container">
      <div class="heading">
        <h3>What would you like to do next?</h3>
        <p>Confirm your Shipping Details :</p>

      </div>
      <div class="row">
     <div class="col-md-3">
    <label >
      Phone 1 
    </label>
    <input type="number" class="form-control" name="phone1" value="{{$userdata->phone1}}">
  </div>
     <div class="col-md-3">
    <label >
     Phone 2
    </label>
    <input type="number" class="form-control" name="phone2" value="{{$userdata->phone2}}">
  </div>
</div>
<div class="row" style="margin-top: 20px">
      <div class="col-md-3">
    <label >
      City
    </label>
    <input type="" class="form-control" name="city" value="{{$userdata->city}}">
  </div>
   <div class="col-md-3">
    <label >
      Post Code 
    </label>
    <input type="" class="form-control" name="postcode" value="{{$userdata->postcode}}">
  </div>
</div>
<div class=row style="margin-top: 20px;margin-bottom: 20px">
  <div class="col-md-6">
    <label >
      Shipping Address 
    </label>
    <input type="" class="form-control" name="address" value="{{$userdata->address}}">
  </div>
 
</div>
<div class="row hiddencard"  style="display:none" style="margin-bottom: 20px;" >
  <div class="col-md-12" style="margin-bottom: 10px;">
    <h4>Credit Card Details</h4>
  </div>
  <div class="col-md-6">
 <div class="form-row">
    <label for="card-element">
      Credit or debit card
    </label>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>
  </div>
</div>
</div>

<div class="row" style="margin-top: 20px">
                   <div class="col-md-7">
              <div class="form-group">
                  <label> Payment Method : </label> 
           <br>
           <blockquote>
                      <label >
                          <input type="radio"  class="paymethod" name="payment" id="cashondelivery" value="Cash On Delivery" checked="true" data-toggle="collapse"  data-parent="#accordion" data-target="#collapseOne" > Cash on Delivery 
                        
                      </label><br>
                       <label >
                          <input type="radio"  class="paymethod" name="payment" id="creditcard" value="Credit Card" data-toggle="collapse"  data-parent="#accordion" data-target="#collapseOne" > Via Credit Card
                        
                      </label><br>
                       <label >
                          <input type="radio"  class="paymethod" name="payment" id="paypal" value="Paypal"  data-toggle="collapse"  data-parent="#accordion" data-target="#collapseOne" > Paypal 
                        
                      </label>
                      </blockquote>
           
              </div> 
              <input type="hidden" name="email" value="{{$userdata->email}}">
                        <div class="panel"> 
                                <div class="panel-body">
                                    <div class="form-group ">
                                      <label>Address where to deliver :</label> <span>{{$userdata->address}}</span>

                                        <p><a href="{{url('Profile')}}">You Can Change Address From Account Settings</a></p>
                                    
                                      
                                    </div>
    
                                </div>
                            </div> 
      

                   </div>  
    
             
         
             
<br/>
              <div class="row">
                <div class="col-md-6">
                    <a href="{{url('Cart')}}" class="btn btn-default pull-left"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>View Cart</strong></a>
                   </div>
                  <div class="col-md-6">
                      <button type="submit" class="btn btn-pup  pull-right " name="btn" id="btn"   /> Submit Order <span class="glyphicon glyphicon-chevron-right"></span></button> 
                </div>  
              </div>
             
      </div>
    </div>
  </section><!--/#do_action-->
</form> 




  </div>
  </div>
  <script src="https://js.stripe.com/v3/"></script>

 <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script type="text/javascript">
// Create a Stripe client.
var stripe = Stripe('pk_test_Gp8kCDdH3NdutrdRuEMG9Qtn00eBAtACju');

// Create an instance of Elements.
var elements = stripe.elements();
  var form = document.getElementById('payment-form');
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
var method='';
 


$('input[name=payment]').change(function(){
 
  method=$(this).val();



if(method=="Credit Card"){
  $('#payment-form').attr('action','{{url('InsertOrder')}}');

$('.hiddencard').removeAttr('style','display:none;');


card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});


var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server

  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
    form.submit();
}
});
}
else if(method=='Paypal'){
$('#payment-form').attr('action','{{route('checkout.paypal')}}');
}


else{
$('#payment-form').attr('action','{{url('InsertOrder')}}');
$('.hiddencard').attr('style','display:none;');
$('#payment-form').click(function(){
$('#payment-form').unbind('submit');
});

$('#btn').unbind().on('click',function(){

    if(method=='Cash On Delivery'){

  $('#payment-form').unbind('submit').submit();
  }

})
}

});

  </script>

  @endsection('content')