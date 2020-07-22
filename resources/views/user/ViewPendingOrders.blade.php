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
               <li class="breadcrumb-item active">View Pending Orders</li>
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
              <h1 class="card-title">View Pending Orders</h1>
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
         <div class="table-responsive"> 
                  <table id="example1" class="table  table-striped table-bordered table-hover dataTable"  style="font-size:12px" cellspacing="0">
          <thead>
          <tr >
              <th>#</th>
              <th>Order#</th>
              <th>Customer</th>
              <th>DateOrdered</th>   
              <th >Price</th>
              <th >PaymentMethod</th> 
              <th>Status</th>
              <th >Action</th>
         
            </tr> 
            </thead>
            <tbody id=showdata>
          
      
         </tbody>
          
        </table>
        <div class="btn-group">
        </div>
        </div>
        </form> 

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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
  $(function(){
    show_data();
function show_data(){

    $.ajax({
      type:'ajax',
      method:'get',
 
      url:'<?php echo url('admin/PendingOrderShow')?>',
      async:false,
      dataType:'json',
       
      success:function(res){
        var html='';

      var sno=1;
var i;
 for ( i=0; i <res.length; i++) {

 html+='<tr>'+
     '<td width="3%" align="center">'+sno+'</td>'+
     '<td><a href="#" title="View list Of ordered" data-target="#myModal" data-toggle="modal" class="orders " data='+res[i].oid+'>'+res[i].oid+'</a> </td>'+
     '<td><a href="" title="View customer information">'+res[i].name+'</a></td>'+
     '<td>'+res[i].order_date+'</td><td>Rs '+res[i].total_price+'</td>'+
     '<td >'+res[i].payment_type+'</td><td >'+res[i].status+'</td>'+
     '<td><a href="javascript:" data='+res[i].oid+'  class="btn btn-danger btn-xs btncancel">Cancel</a>&nbsp'+
     '<a href="javascript:" data='+res[i].oid+'  class="btn btn-primary btn-xs btn-confirm">Confirm</a></td>'+
     '</tr>' ;
           sno++;
        
};
 $('#showdata').html(html);

        },
        });



      }



$('#showdata').on('click','.orders',function () {

$('#myModal').modal('show'); 
var id=$(this).attr('data');

  var url='<?php echo url('admin/PendingOrderDetailsShow/')?>/'+id+'';

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



$('#showdata').on('click','.btn-confirm',function () {


var id=$(this).attr('data');

  var url='<?php echo url('admin/ConfirmOrder/')?>/'+id+'';

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