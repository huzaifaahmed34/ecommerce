@extends('layouts/app')
<div class=container>
	<div class=row>
		<div class="col-3">
		</div>
<div class="col-6 mt-3">
	<h3>Edit DATA</h3>

	@foreach($qry as $q)


<form action="{{url('update')}}/{{$q->id}}" method="post">
      <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
      <input type="text" value="{{$q->name}}" class="form-control mb-3" placeholder="Enter Name" name="name">
      <input type="text" value="{{$q->Fathername}}" class="form-control mb-3" placeholder="Enter FatherName" name="fname">
          <input type="text" value="{{$q->tel}}" class="form-control mb-3" placeholder="Enter FatherName" name="tel">
      <input type=submit value=Update class="btn btn-danger">
<br>
@endforeach;
    
</form>

</div>
