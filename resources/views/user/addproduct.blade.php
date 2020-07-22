@extends('admin/header')
@extends('admin/sidebar')

@section('content')

<style type="text/css">
  .select2-container--default .select2-selection--single {
height:37px;
  }
</style>

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
              <li class="breadcrumb-item ">Add Product</li>
               <li class="breadcrumb-item active">Add Product</li>
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
              <h1 class="card-title">Add Product</h1>
            </div>
            <!-- /.card-header -->

            <div class="card-body">

            	<div class="col-lg-12  alert-success">
		
            	</div>
         
			<div class="col-lg-12  alert-danger">

            	</div>
        
 
                <form id="form1"  method="POST" action="<?php echo url('admin/InsertProduct')?>" enctype="multipart/form-data">


                <div class="row">
 {{ csrf_field() }}          
           <!---Form Start-->

<input type="hidden" name="total">

<input type="hidden" name="total1">
                      <div class="col-lg-3">
                      <div class="form-group">
                   <label>Product Code</label>

              <input type="text" class="form-control" id="product_code" name=product_code placeholder="Enter Product Code" >

                </div>
                    </div>
                     <div class="col-lg-3">
                      <div class="form-group">
                   <label>Product Name</label>

              <input type="text" class="form-control" id="product_name" name=product_name placeholder="Enter Product Name" >

                </div>
                    </div>
                     <div class="col-lg-3">
                      <div class="form-group">
                   <label>Select Category</label>

              <select  class="form-control" id="category_id" name=category_id placeholder="Enter Category Name" >
                <option value="">
                  Select Category
                </option>

                     @php
                $qr=DB::table('categories')->where('is_deleted',0)->get();
                  @endphp
                @foreach($qr as $q )
               
                <option value="{{$q->id}}">{{$q->category_name}}</option>;
             
              @endforeach
              </select>

                </div>
                    </div>
                     <div class="col-lg-3">
                      <div class="form-group">
                   <label>Select Sub Category</label>

              <select  class="form-control" id="subcategory_id" name=subcategory_id >
               <option value="">
                  Select Sub Category
                </option>
            
              </select>

                </div>
                    </div> <div class="col-lg-3">
                      <div class="form-group">
                   <label>Dealer Name</label>

   <select  class="form-control" id="dealer_id" name=dealer_id >
               <option value="">
                  Select Dealer 
                </option>
                     @php
                $qr=DB::table('dealer')->where('is_deleted',0)->get();
                  @endphp
                @foreach($qr as $q )
               
                <option value="{{$q->id}}">{{$q->name}}</option>;
             
              @endforeach
              </select>
                </div>
                    </div>
                     <div class="col-lg-3">
                      <div class="form-group">
                   <label>Brand Name</label>
       <select  class="form-control" id="brand_name" name=brand_name >
               <option value="">
                  Select Brand
                </option>
            
              </select>
                </div>
                    </div>
                      <div class="col-lg-3">
                      <div class="form-group">
                   <label>Unit Price</label>

              <input type="number" class="form-control" id="price" name=price placeholder="Enter Unit Price  " >
          
                </div>
                    </div>
                     <div class="col-lg-3">
                      <div class="form-group">
                   <label>Short Desc</label>

              <input type="text" class="form-control" id="short_desc" name=short_desc placeholder="Enter Short Description" >

                </div>
                    </div>
                  
                   

                 
                     <div class="col-lg-3">
                      <div class="form-group">
                   <label>Available Size</label>

              <input type="number" class="form-control" id="available_size" name=available_size placeholder="Enter Available Size " >

                </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                   <label>Quantity /PC</label>

              <input type="number" class="form-control" id="quantity" name=quantity placeholder="Enter Quantity" >

                </div>
                    </div>
                           <div class="col-lg-3">
                      <div class="form-group">
                   <label>Tags(Optional )</label>

             <select  class="form-control" id="tags" name=tags >
               <option value="">
                  Select Tag 
                </option>
                   
                <option value="Featured">Featured</option>;
    
              </select>
                </div>
                    </div>

                     <div class="col-lg-3">
                      <div class="form-group">
                   <label>Product Location</label>

              <input type="text" class="form-control" id="product_location" name=product_location placeholder="Enter Product Location" >

                </div>
                    </div>
                     <div class="col-lg-12">
                      <div class="form-group">
                   <label>Image &nbsp;<span style="color:red;" id=imageerror></span></label>

              <input type="file" class="form-control" id="logo" name=logo >

                </div>
                    </div>
                       <div class="col-lg-12">
                      <div class="form-group">
                   <label>Long Description</label>

              <textarea type="text" class="textarea form-control" id="long_desc" name=long_desc placeholder="Enter Long Description " >
          </textarea>
                </div>
                    </div>

                      <div class="col-lg-3">
                      <div class="form-group">
                   <label>Seller SKU</label>

              <input type="text" class=" form-control" id="SKU" name=SKU placeholder="Enter SKU Code" >
     
                </div>
                    </div>

                  
                     <div class="col-lg-3">
                      <div class="form-group">
                   <label>Warranty Type</label>

              <select  class="form-control" id="warranty_type" name=warranty_type placeholder="Enter Category Name" >
                <option value="">
                  Select Warranty Type
                </option>

                     @php
                $qr=DB::table('warranty_type')->get();
                  @endphp
                @foreach($qr as $q )
               
                <option value="{{$q->id}}">{{$q->warranty_type}}</option>;
             
              @endforeach
              </select>
                </div>
                    </div>

                  
                     <div class="col-lg-3">
                      <div class="form-group">
                   <label>Warranty Period </label>

              <select  class="form-control" id="warranty_period" name=warranty_period placeholder="Enter Category Name" >
                <option value="">
                  Select Warranty Period
                </option>

                     @php
                $qr=DB::table('warranty_period')->get();
                  @endphp
                @foreach($qr as $q )
               
                <option value="{{$q->id}}">{{$q->warranty_period}}</option>;
             
              @endforeach
              </select>
                </div>
                    </div>

       <div class="col-lg-12">
                      <div class="form-group">
                   <label>Enter Warranty Policy </label>

              <textarea type="text" class=" textarea form-control" id="warranty_policy" name="warranty_policy" placeholder="Enter Warranty Policy"  >

</textarea>

                </div>
                    </div>

                                <div class="col-lg-6">
                      <div class="form-group">
                   <label>Package Weight</label>

              <input type="text" class="form-control" id="product_weight" name=product_weight placeholder="Enter Product Weight" >

                </div>
                    </div>
                         <div class="col-lg-6">
                      <div class="form-group">
                   <label>Package Dimensions(cm)</label>

              <input type="text" class="form-control" id="product_dimensions" name=product_dimensions placeholder="Enter Product Dimensions" >

                </div>
                    </div>
                      
                         <div class="col-lg-4">
                      <div class="form-group">
                   <label>Enter Discount Percentage(Optional)</label>

              <input type="number" class="form-control" id="discount_perc" name=discount_perc placeholder="Enter Discount Percentage" >

                </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                   <label>Start Discount Date</label>

              <input type="datetime-local" class="form-control" id="start_discount" name=start_discount placeholder="Enter Discount Percentage" >

                </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                   <label>End Discount Date</label>

              <input type="datetime-local" class="form-control" id="end_discount" name=end_discount placeholder="Enter Discount Percentage" >

                </div>
                    </div>
                  
                  </div>


<h4 style="margin-top: 30px;">Product Specification</h4>
                    <div class="row append1">

                         <div class="col-lg-12 row" id=0>
                     <div class="col-lg-5">
                      <div class="form-group">
                   <label>Specification Name </label>
  <select  class="form-control" id="spec0" name=spec[0] placeholder="Enter Category Name" >
                     @php
                $qr=DB::table('product_spec')->where('is_deleted',0)->get();
                  @endphp
                @foreach($qr as $q )
               
                <option value="{{$q->id}}">{{$q->name}}</option>;
             
              @endforeach
            </select>
            

                </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="form-group">
                   <label>Specification Value </label>

              <input type="text" class="form-control" id="specvalue0" name=specvalue[0] placeholder="Enter Specification Value"  >

                </div>
                    </div>
                  <div class="col-lg-2" style="margin-top:33px;">
                     <div class="form-group">
                  <input type="button" id="btnadd1"  value="+" class="btn btn-primary">
                </div>
                   </div>
                
          
                      </div>
                  
                   
</div>

                  <div class="" id=description  style="display: none;">
                           <div class="row">
                    <div class="col-lg-12">
                     <h4>Enter Further Details 
</h4>
                   </div>
                 </div>






               
                    <div class="row append">
                         <div class="col-lg-12 row" id=row0>
                     <div class="col-lg-5">
                      <div class="form-group">
                   <label>Size </label>

              <input type="text" class="form-control" id="size0" name=size[0] placeholder="Enter Size "  >

                </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="form-group">
                   <label>Quantity /PC</label>

              <input type="number" class="form-control" id="quantity10" name=quantity1[0] placeholder="Enter Quantity"  >

                </div>
                    </div>
                  <div class="col-lg-2" style="margin-top:33px;">
                     <div class="form-group">
                  <input type="button" id="btnadd" name=quantity value="+" class="btn btn-primary">
                </div>
                   </div>
                
          
                      </div>
                  
                   
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

$('#subcategory_id').select2();
$('#category_id').select2();
$('#dealer_id').select2();
$('#brand_name').select2();
$('#category_id').change(function(){

var id=$(this).val();
$.ajax({
method:'get',
data:{'id':id},
url:'<?php echo url('admin/GetSubcategory')?>',
dataType:'json',
success:function(res){
var html='';
html+='<option value="">Select Sub Category</option>';
for(var i=0;i<res.length;i++){
html+='<option value='+res[i].id+'>'+res[i].name+'</option>';
}
$('#subcategory_id').html(html);
},
error:function(){
  alert('not found');
}


});
});



$('#subcategory_id').change(function(){

var id=$(this).val();
$.ajax({
method:'get',
data:{'id':id},
url:'<?php echo url('admin/GetBrand')?>',
dataType:'json',
success:function(res){
var html='';
html+='<option value="">Select Brand</option>';
for(var i=0;i<res.length;i++){
html+='<option value='+res[i].id+'>'+res[i].brand+'</option>';
}
$('#brand_name').html(html);
},
error:function(){
  alert('not found');
}


});
});

var i=0;
  $('#available_size').keyup(function(){

if($(this).val()=='0' || $(this).val()=='' ){
  $('#description').attr('style','display:none');
 $('#quantity').removeAttr('disabled','true');
 for(var j=1;j<=i;j++){

 $('#row'+j).remove();  
}
i=0;
$('#size0').val('');
$('#quantity10').val('');


}else{
   $('#description').removeAttr('style','display:none');
    
        $('#quantity').attr('disabled','true');
}


  }); 

  $('#btnadd').unbind().on('click',function(){

    if($('#size'+i).val()=='' || $('#quantity1'+i).val()=='' ){

           if($('#quantity1'+i).val()=='' ){
        $('#quantity1'+i).addClass('is-invalid');
      }

      else{
         $('#quantity1'+i).removeClass('is-invalid');
      }

      if($('#size'+i).val()=='' ){
        $('#size'+i).addClass('is-invalid');
      }

      else{
         $('#size'+i).removeClass('is-invalid');
      }

    }
    else{
         $('#size'+i).removeClass('is-invalid');
             $('#quantity1'+i).removeClass('is-invalid');
i++;

 $('input[name=total]').val(i);

$('.append').append('  <div class="col-lg-12 row" id=row'+i+'>'+
                     '<div class="col-lg-5" style>'+
                     '<div class="form-group">'+
                  ' <label>Size </label>'+

             ' <input type="text" class="form-control" id="size'+i+'" name=size['+i+'] placeholder="Enter Size " >'+

               ' </div>'+
                 '   </div>'+
                   ' <div class="col-lg-5">'+
                   '   <div class="form-group">'+
                 '  <label>Quantity /PC</label>'+

             ' <input type="number" class="form-control" id="quantity1'+i+'" name=quantity1['+i+'] placeholder="Enter Quantity"   >'+

              '  </div>'+
                  '  </div>'+
                   ' <div class="col-lg-2" style="margin-top:33px;">'+
                   '   <div class="form-group">'+
                  '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>'+

              '  </div>'+
                  '  </div>'+
                
           
                  '    </div>');
  
}
  })













var m=0;


// For Product Specification

  $('#btnadd1').unbind().on('click',function(){

    if($('#spec'+m).val()=='' || $('#specvalue'+m).val()=='' ){

           if($('#specvalue'+m).val()=='' ){
        $('#specvalue'+m).addClass('is-invalid');
      }

      else{
         $('#specvalue'+m).removeClass('is-invalid');
      }

      if($('#spec'+m).val()=='' ){
        $('#spec'+ m).addClass('is-invalid');
      }

      else{
         $('#spec'+m).removeClass('is-invalid');
      }

    }
    else{
         $('#spec'+m).removeClass('is-invalid');
             $('#specvalue'+m).removeClass('is-invalid');
m++;

$('input[name=total1]').val(m);

$('.append1').append('  <div class="col-lg-12 row" id=row1'+m+'>'+
                     '<div class="col-lg-5" style>'+
                     '<div class="form-group">'+
                  ' <label>Specification Name </label>'+
' <select  class="form-control" id="spec'+m+'" name=spec['+m+']  placeholder="Enter Category Name" >'+
                     '@php $qr=DB::table("product_spec")->where("is_deleted",0)->get();'+
                 '@endphp @foreach($qr as $q )'+               
                '<option value="{{$q->id}}">{{$q->name}}</option>;'+
             '@endforeach </select>'+
          

               ' </div>'+
                 '   </div>'+
                   ' <div class="col-lg-5">'+
                   '   <div class="form-group">'+
                 '  <label>Specification Value </label>'+

             ' <input type="text" class="form-control" id="specvalue'+m+'" name=specvalue['+m+'] placeholder="Enter Specification Value"   >'+

              '  </div>'+
                  '  </div>'+
                   ' <div class="col-lg-2" style="margin-top:33px;">'+
                   '   <div class="form-group">'+
                  '<button type="button" name="remove1" id="'+m+'" class="btn btn-danger btn_remove1">X</button>'+

              '  </div>'+
                  '  </div>'+
                
           
                  '    </div>');
  
}
  })


    $(document).on('click', '.btn_remove1', function(){  
           var button_id = $(this).attr("id");   
           $('#row1'+button_id+'').remove();  

      });  








    $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  

      });  

$('#form1').unbind().on('submit',function (e) {
  e.preventDefault();
var d;

	var data=$('#form1').serialize();
  
	var url='<?php echo url('admin/InsertProduct')?>';

	$.ajax({

		method:'post',
	  data:new FormData(this),
       
          contentType:false,
              cache:false,

        processData:false,

                        url:url,
dataType:'json',
                      async:false,

		success:function(response){
 
			if(response.success){
 $('#select2-category_id-container').html('');
  $('#select2-subcategory_id-container').html('');
   $('#select2-brand_name-container').html('');
    $('#select2-dealer_id-container').html('');
    $('input[name=total1]').val(0);
    $('input[name=total]').val(0);
 $('.note-editable').html('');
$('input').removeClass('is-invalid');
$('textarea').removeClass('is-invalid');
$('#imageerror').html('');
for(var j=1;j<=i;j++){

 $('#row'+j).remove();  
}
for(var j=0;j<=m;j++){

 $('#row1'+j).remove();  
}
$('#description').attr('style','display:none');
$('#form1')[0].reset();
i=0;
m=0;
$('.alert-success').addClass('alert').html('Data Inserted Successfully').fadeIn().delay(4000).fadeOut();
			}
			if(response.error){
     
      if('product_code' in response.error){
  $('#product_code').addClass('is-invalid');

      }
      else{
       $('#product_code').removeClass('is-invalid');
      }


   if('product_name' in response.error){
       $('#product_name').addClass('is-invalid');

      }
      else{
       $('#product_name').removeClass('is-invalid');
      }
        if('price' in response.error){
       $('#price').addClass('is-invalid');

      }
      else{
       $('#price').removeClass('is-invalid');
      }


       if('brand_name' in response.error){
        $('#brand_name').addClass('is-invalid');

      }
      else{
       $('#brand_name').removeClass('is-invalid');
      }


       if('logo' in response.error){
        $('#imageerror').html(response.error.logo[0]);
         $('#logo').addClass('is-invalid');
      }
      else{
          $('#imageerror').html('');
       $('#logo').removeClass('is-invalid');
      }


       if('product_location' in response.error){
         $('#product_location').addClass('is-invalid');

      }
      else{
       $('#product_location').removeClass('is-invalid');
      }


       if('available_size' in response.error){
        $('#available_size').addClass('is-invalid');

      }
      else{
       $('#available_size').removeClass('is-invalid');
      }



       if('long_desc' in response.error){
        $('#long_desc').addClass('is-invalid');

      }
      else{
       $('#long_desc').removeClass('is-invalid');
      }


       if('short_desc' in response.error){
        $('#short_desc').addClass('is-invalid');

      }
      else{
       $('#short_desc').removeClass('is-invalid');
      }
             if('SKU' in response.error){
        $('#SKU').addClass('is-invalid');

      }
      else{
       $('#SKU').removeClass('is-invalid');
      }
        if('product_weight' in response.error){
        $('#product_weight').addClass('is-invalid');

      }
      else{
       $('#product_weight').removeClass('is-invalid');
      }


     if('warranty_type' in response.error){
        $('#warranty_type').addClass('is-invalid');

      }
      else{
       $('#warranty_type').removeClass('is-invalid');
      }


     if('product_dimensions' in response.error){
        $('#product_dimensions').addClass('is-invalid');

      }
      else{
       $('#product_dimensions').removeClass('is-invalid');
      }


     if('warranty_period' in response.error){
        $('#warranty_period').addClass('is-invalid');

      }
      else{
       $('#warranty_period').removeClass('is-invalid');
      }


     if('warranty_policy' in response.error){
        $('#warranty_policy').addClass('is-invalid');

      }
      else{
       $('#warranty_policy').removeClass('is-invalid');
      }








}

		},
		error:function(){
		$('.alert-danger').addClass('alert').html('Data not Inserted Successfully').fadeIn('slow').delay(4000).fadeOut('slow');
	
		}
	});
})

});
</script><script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
  
     @endsection('content')
 

@extends('admin/footer')