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
              <li class="breadcrumb-item ">Add Dealer</li>
               <li class="breadcrumb-item active">Add Dealer</li>
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
              <h1 class="card-title">Add Dealer</h1>
            </div>
            <!-- /.card-header -->

            <div class="card-body">

            	<div class="col-lg-12  alert-success">
		
            	</div>
         
			<div class="col-lg-12  alert-danger">

            	</div>
        
 
                <form id="form1"  method="POST" action="<?php echo url('admin/InsertDealer')?>">


                <div class="row">
 {{ csrf_field() }}                    <!---Form Start-->

                   

                       <div class="col-lg-6">
                      <div class="form-group">
                   <label> Dealer Name</label>

              <input type="text" class="form-control" id="name" name=name placeholder="Enter Category Name" value={{@$category}}>

                </div>
                    </div>


                       <div class="col-lg-6">
                      <div class="form-group">
                   <label> Cnic</label>

              <input type="text" class="form-control" id="cnic" name=cnic 
              data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"   >

                </div>
                    </div>


                       <div class="col-lg-6">
                      <div class="form-group">
                   <label>Mobile No</label>

              <input type="text" class="form-control" id="phone" name=phone placeholder="Enter Mobile No" >

                </div>
                    </div>

                       <div class="col-lg-6">
                      <div class="form-group">
                   <label> Email</label>

              <input type="email" class="form-control" id="email" name=email placeholder="Enter Email" >

                </div>
                    </div>


                       <div class="col-lg-12">
                      <div class="form-group">
                   <label> Address</label>

              <textarea type="text" class="form-control" id="address" name=address placeholder="Enter Address" >
</textarea>
                </div>
                    </div>



                    <div class="col-lg-12 text-right mt-2">
                     <input type="button" class="btn btn-info btn-md " id=add  value="Add" >
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

   // Read selected option
 
$('#add').unbind().click(function () {

	var data=$('#form1').serialize();
	var url='<?php echo url('admin/InsertDealer')?>';

	$.ajax({
		type:'ajax',
		method:'post',
		data:data,
		url:url,
		dataType:'json',
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
      if('cnic' in response.error){
  $('#cnic').addClass('is-invalid');

      }
      else{
       $('#cnic').removeClass('is-invalid');
      }

            if('address' in response.error){
  $('#address').addClass('is-invalid');

      }
      else{
       $('#address').removeClass('is-invalid');
      }
      if('email' in response.error){
  $('#email').addClass('is-invalid');

      }
      else{
       $('#email').removeClass('is-invalid');
      }
      if('phone' in response.error){
  $('#phone').addClass('is-invalid');

      }
      else{
       $('#phone').removeClass('is-invalid');
      }

		

}

		},
		error:function(){
		$('.alert-danger').addClass('alert').html('Data not Inserted Successfully').fadeIn('slow').delay(4000).fadeOut('slow');
	
		}
	});
})


       $("input[name=cnic]").inputmask();
});
</script>
  
     @endsection('content')
 

@extends('admin/footer')