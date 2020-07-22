@extends('layouts.header')

@extends('layouts.footer')


@section('content')
<div class="container">
    <form action="{{route('checkout.paypal')}}" method="post" name="frmTransaction" id="frmTransaction">
        {{csrf_field()}}
  <input type="" name="price"  class="form-control">
  <input type="submit" name="" class="btn btn-paypal" value="Pay">
</form>
</div>
@endsection('content')