@extends('layouts/app')
<div class=container>
	<div class=row>
		<div class="col-3">
		</div>
<div class="col-6 mt-3">
	<h3>INSERT DATA</h3>

@if(isset($success))
{{$success}}
@endif
<div class="col-lg-3">
<form action="insert" method="post">
      <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
      <input type="text" class="form-control mb-3" placeholder="Enter Name" name="name">
      <input type="text" class="form-control mb-3" placeholder="Enter FatherName" name="fname">
      <input type=submit value=Submit class="btn btn-danger">
<br>
    
</form>


</div>
</div>


<div class="col-lg-12 mt-2">
<table class="table">
	<thead>
		<th>S no</th>
		<th>Name</th>
		<th>Father Name</th>
		<th>Telephone</th>
		<Th>Action</Th>
	</thead>
	<tbody>
		<?php $sno=1;?>
		@if(isset($qry))
	@foreach($qry as $q)
	<tr>

		<td>{{$sno}}</td>
		<td>{{$q->name}}</td>
		<td>{{$q->Fathername}}</td>
		<td>{{$q->tel}}</td>
		<td><a href="edit/{{$q->id}}" class="btn btn-primary" >Edit</a> 
			<a href="delete/{{$q->id}}" class="btn btn-danger">Delete</a>
		</td>
</tr>
<?php $sno++;?>
	@endforeach
	@endif
	</tbody>
</table>
</div>
</div>
</div>