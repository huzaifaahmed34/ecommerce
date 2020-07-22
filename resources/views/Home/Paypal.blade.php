

@extends('layouts.header')

@extends('layouts.footer')


@section('content')
<div class="container text-center">
           <form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form"  action="paywithpaypal">
  {{ csrf_field() }}
  <h2 class="text-primary">Payment Form</h2>
  <p>Demo PayPal form - Integrating paypal in laravel</p>
  <p>      
  <label class="text-primary"><b>Enter Amount</b></label>
  <input class="w3-input w3-border" name="amount" type="text"></p>      
  <button class="btn btn-primary">Pay with PayPal</button></p>
</form>
</div>
@endsection('content');