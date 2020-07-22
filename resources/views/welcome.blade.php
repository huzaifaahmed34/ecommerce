@extends('admin/header')
@extends('admin/sidebar')

@section('content')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
   
    </head>
    <body>
     <div class=container>
    <div class=row>
        <div class="col-md-3 mb-3">
        </div>
<div class="col-md-6 m-t-3">
    <h3>INSERT DATA</h3>
    

<form  method="post" id=form1 action=insert>
      <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
      <input type="text" class="form-control mb-3" placeholder="Enter Name" name="name">
      <input type="text" class="form-control mb-3" placeholder="Enter FatherName" name="fname">
      <input type=submit id=submit value=Submit class="btn btn-danger">
<br>
    
</form>

</div>

</div>
</div>
    </body>
    @endsection('content')
 

@extends('admin/footer')

