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
              <li class="breadcrumb-item ">Orders</li>
               <li class="breadcrumb-item active">View Confirmed Orders</li>
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
              <h1 class="card-title">View Confirmed Orders</h1>
            </div>
            <!-- /.card-header -->


            <div class="card-body">
       
              <div class="col-lg-12  alert-success">
     
              </div>
        
      <div class="col-lg-12  alert-danger">

              </div>
        
      
            <!-- Modal -->
                    <div class="modal fade" id="usermodal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal" type=
                                    "button">×</button>

                                    <h4 class="modal-title" id="myModalLabel">Profile Image.</h4>
                                </div>

                                <form action="/ecommerce/admin/user/controller.php?action=photos" enctype="multipart/form-data" method=
                                "post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="rows">
                                            <div class="col-md-12">
                                                <div class="rows">
                                                    <img title="profile image" width="500" height="360" src="/ecommerce/admin/user/photos/10329236_874204835938922_6636897990257224477_n.jpg">  
                          
                                                </div>
                                            </div><br/>
                                                <div class="col-md-12">
                                                    <div class="rows">
                                                        <div class="col-md-8">

                                                            <input type="hidden" name="MIDNO" id="MIDNO" value="126">
                                                              <input name="MAX_FILE_SIZE" type=
                                                            "hidden" value="1000000"> <input id=
                                                            "photo" name="photo" type=
                                                            "file">
                                                        </div>

                                                        <div class="col-md-4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-default" data-dismiss="modal" type=
                                        "button">Close</button> <button class="btn btn-primary"
                                        name="savephoto" type="submit">Upload Photo</button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
  

  <div id="page-wrapper">
               
            <div class="row" >
      
                <div class="col-lg-12"> 
                    
                    

                  
<div class="container">

          <form action="controller.php?action=delete" Method="POST">            
         <div class="table-responsive "> 
          <div id=fulltable>

                  <table id="example1" class="table  table-striped table-bordered table-hover dataTable"  style="font-size:12px" >
          <thead>
          <tr >
              <th>#</th>
                <th>#</th>
              <th>Product Code</th>
              <th>Product Name</th>
              <th>Brand</th>   
              <th >Category</th>
              <th >Sub Category</th> 
              <th>Actual Price</th>
              <th >Discount Available</th>
               <th >Discount Perc</th>
                <th >Status</th>
                 <th >Discount Expiry Date</th>
                
            </tr> 
            </thead>
            <tbody id=showdata>
          


         </tbody>
          
        </table>
      </div>
        <div class="btn-group">
        </div>
        </div>
        </form> 
<div class="row">
 <div class="col-md-3" style="margin-top: 20px;">
   <div class="form-group">
    <label>Discount Percentage</label>
    <input type="number" placeholder="Enter Discount Percentage" name="discount_perc"  class="form-control">
   </div>
 </div>
  
  <div class="col-md-3" style="margin-top: 20px;">
   <div class="form-group">
    <label>End Discount Date</label>
    <input type="datetime-local"name="end_discount_date"  class="form-control">
   </div>
 </div>

  <div class="col-md-3"  style="margin-top: 51px;">
   <div class="form-group">
 <button class="btn btn-primary  setdiscount" >Set Discount</button>
   </div></div>

   <div class="col-md-3 text-right"  style="margin-top: 51px;">
   <div class="form-group">
 <button class="btn btn-danger removediscount">Remove Discount</button>
   </div>
 </div>
</div>
  <div class="modal fade" id="myModal" tabindex="-1">
<div class="modal-dialog modal-lg" >
<div class="modal-content">
  <div class="modal-header">
       <h4 class="modal-title">View Product List</h4>
    <button class="close" id="btnclose" data-dismiss="modal" type="button">×</button>

  </div>

     <div class="modal-body">
<h5 style="margin-bottom: 10px"><b>Ordered Product List</b></h5>
    <table id="table" class="table  table-striped table-hovered">
      <thead class="thead thead-dark">
        <tr>
          <th>#</th>
           <th>CODE</th>
          <th>PRODUCT</th>
          <th>DESCRIPTION</th>
          <th>PRICE</th>
          <th>QUANTITY</th>
          <th>TOTAL PRICE</th> 
         
          <!-- <th></th>  -->
        </tr>
        </thead>
        <tbody id=showdetails>
 
     
      </tbody> 
       
       </table> 
    
       <hr>
       <div class="row">
  
 
      </div> 
    </div>   
    <div class="modal-footer">
      <button class="btn btn-default" id="btnclose" data-dismiss="modal" type="button">Close</button>  
    </div>


</div><!-- /.modal-content -->
</div>            
  </div><!-- /.modal -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div></div></div></div>
  </section>


</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script>
  $(function(){
    show_data();


$('.setdiscount').click(function(){
  var list=[];
var discount_perc=$('input[name=discount_perc]').val();
var end_discount_date=$('input[name=end_discount_date]').val();
if(discount_perc==''){
alert('Enter Discount Percentage');
}else{
$('.check:checked').each(function(){
list.push($(this).val());
});

$.ajax({
      method:'get',
      data:{'list':list,'discount_perc':discount_perc,'end_discount_date':end_discount_date},
      url:"{{url('admin/UpdateDiscountAll')}}",
      dataType:'json',
      async:false,
      success:function(){
     list=[];
          show_data();
      },
      error(){
        alert('Select Minimum One Product');
      }
    });
}
});

$('.removediscount').click(function(){
  var list=[];


$('.check:checked').each(function(){
list.push($(this).val());
});

$.ajax({
  type:'ajax',
      method:'get',
      data:{'list':list},
      url:"{{url('admin/RemoveDiscountAll')}}",
      dataType:'json',
      async:false,
      success:function(){
     list=[];
          show_data();


      },
      error(){
        alert('Select Minimum One Product');
      }
    });

});

$('#showdata').on('keyup','input[name=setdisc]',function(e){
  var id=$(this).attr('data');
  var price=$(this).attr('data2');
 
if(e.which==13){
  if($(this).val()==''){
    alert('Enter Discount First');
  }
  else{
  
    var discount_perc=$(this).val();
    $.ajax({
      method:'get',
      data:{'id':id,'discount_perc':discount_perc,'price':price},
      url:"{{url('admin/UpdateDiscount')}}",
      dataType:'json',
      async:false,
      success:function(){
     
          show_data();
      },
      error(){
        alert('error');
      }
    });
  }
}

});

function show_data(){

    $.ajax({
      type:'ajax',
      method:'get',
 
      url:'<?php echo url('admin/ProductView')?>',
      async:false,
      dataType:'json',
       
      success:function(res){
        var html='';
        

      var sno=1;
var i;
var row='';
 for ( i=0; i <res.length; i++) {
if(res[i].discount_available==1){
  
   dis='<td><input type=number class="form-control" data2="'+res[i].price+'" data="'+res[i].id+'" name=setdisc readonly placeholder="Discount %" value='+res[i].discount_perc+'></input></td>';
discount_available='Yes';
 row='<a href="#"  class="btn btn-success btn-xs" disabled>'+discount_available+'</a>';

}
else{ 
discount_available='No';
 dis='<td><input type=number class="form-control" data2="'+res[i].price+'" data="'+res[i].id+'" name=setdisc   placeholder="Discount %" ></input></td>'
 row='<a href="#"  class="btn btn-danger btn-xs" disabled  data='+res[i].id+'>'+discount_available+'</a>';
}
if(res[i].status==1){
  status='Available';
}
else{
  status='Not Available';
}
 html+='<tr>'+
 '<td width="3%" align="center"><input type=checkbox  value="'+res[i].id+'" name=check class="check"></td>'+
     '<td width="3%" align="center">'+sno+'</td>'+
     '<td>'+res[i].product_code+' </td>'+
     '<td>'+res[i].product_name+'</td>'+
     '<td>'+res[i].brand+'</a></td>'+
          '<td>'+res[i].category_name+'</td>'+
               '<td>'+res[i].name+'</td>'+
     '<td>Rs '+res[i].price+'</td>'+
     '<td>'+row+'</td>'+
     '<td >'+res[i].discount_perc+'</td>'+
     '<td>'+'<a href="#"  class="btn btn-success btn-xs" disabled>'+status+'</a>'+'</td>'+
       '<td>'+''+res[i].end_discount_date+''+'</td>'+
     '</tr>' ;
           sno++;

    
};

   $('#example1').DataTable().destroy();
 $('#showdata').html(html);
   $('#example1').DataTable().draw();
        },
        error:function(){
          alert('error');
        }
        });



      }



$('#showdata').on('click','.orders',function () {

$('#myModal').modal('show'); 
var id=$(this).attr('data');

  var url='<?php echo url('admin/CompletedOrderDetailsShow/')?>/'+id+'';

  $.ajax({
    type:'ajax',
    method:'get',

    url:url,
  
    async:false,
    success:function(response){

 var html='';

      var sno=1;
var i;
 
 $('#showdetails').html(response);

    },
    error:function(){
    $('.alert-danger').addClass('alert').html('Data not Found Successfully').fadeIn('slow').delay(4000).fadeOut('slow');
  
    }
  });
})



$('#showdata').on('click','.btncancel',function () {


var id=$(this).attr('data');

  var url='<?php echo url('admin/CancelOrder/')?>/'+id+'';

  $.ajax({
    type:'ajax',
    method:'get',

    url:url,
  
    async:false,
    success:function(response){
show_data();

    },
    error:function(){
    $('.alert-danger').addClass('alert').html('Data not Found Successfully').fadeIn('slow').delay(4000).fadeOut('slow');
  
    }
  });
})





  });
</script>

    @endsection('content')
 

@extends('admin/footer')