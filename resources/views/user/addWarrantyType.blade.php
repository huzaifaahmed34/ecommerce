@extends('admin/header')
@extends('admin/sidebar')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item ">Add Warranty Type</li>
               <li class="breadcrumb-item active">Add Warranty Type</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h1 class="card-title">Add Warranty Type</h1>
            </div>
            <!-- /.card-header -->

            <div class="card-body">

            	<div class="col-lg-12  alert-success">
		
            	</div>
         
			<div class="col-lg-12  alert-danger">

            	</div>
        
 
                <form id="form1" action="<?php echo url('admin/InsertWarrantyType')?>"   method="POST" enctype="multipart/form-data">


                <div class="row">
 {{ csrf_field() }}                    <!---Form Start-->

                      <div class="col-lg-6">
                      <div class="form-group">
                   <label>Warranty Type Name</label>

              <input type="text" class="form-control" id="name" name=name placeholder="Enter Warranty Type Name" value={{@$category}}>

                </div>
                    </div>

                      <div class="col-lg-6">
                      <div class="form-group">
                   <label>Enter Description</label>

              <textarea type="text" class="form-control" id="Description" name=description placeholder="Enter Warranty Type Description" >
</textarea>
                </div>
                    </div>
            



                    <div class="col-lg-12 text-right mt-2">
                     <input type="submit" class="btn btn-info btn-md " id=add  value="Add" >
                    </div>

                </div>


                  </form>

                    <!---End Form-->
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        </div>

      </div>
    </section>
  </div>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>

  $(function(){
$('#form1').on('submit',function (e) {
  e.preventDefault(e);
	var data=$('#form1').serialize();
	var url='<?php echo url('admin/InsertWarrantyType')?>';

	$.ajax({
		type:'ajax',
		method:'post',
    data:new FormData(this),
       
          contentType:false,
              cache:false,

        processData:false,
		url:url,
		
		async:false,
		success:function(response){
			if(response.success){
$('input').removeClass('is-invalid');
$('.alert-success').addClass('alert').html('Data Inserted Successfully').fadeIn().delay(4000).fadeOut();
$('#form1')[0].reset();
			}
			if(response.error){
if('name' in response.error){
  $('#name').addClass('is-invalid');

      }
      else{
       $('#name').removeClass('is-invalid');
      }
      if('description' in response.error){
  $('#description').addClass('is-invalid');

      }
      else{
       $('#description').removeClass('is-invalid');
      }


}

		},
		error:function(){
		$('.alert-danger').addClass('alert').html('Data not Inserted Successfully').fadeIn('slow').delay(4000).fadeOut('slow');
	
		}
	});

});
})
</script>
  
     @endsection('content')
 

@extends('admin/footer')