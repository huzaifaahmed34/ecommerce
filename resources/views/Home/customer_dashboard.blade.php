

@extends('layouts.header')

@extends('layouts.footer')


@section('content')

          <section>
    <div class="container">
         <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Profile</li>
        </ol>
      </div>
        <div class="row">
          <div class="col-md-12">
            <div class="alert-success">
          </div>
           <div class="alert-danger">
          </div>
        </div>
    <div class="col-sm-3">
        <div class="panel">
            <div class="panel-body">
                <a data-target="#myModal" data-toggle="modal" href=
                ""><img src="data:image/png;base64,{{ chunk_split(base64_encode($userdata->photo)) }}" alt="Upload " width="60%" height="100px;" /></a>
            </div>
            <ul class="list-group">
            <!-- <li class="list-group-item text-muted">Profile</li> -->
                <li class="list-group-item text-right"><span class=
                "pull-left"><strong>Real name</strong></span>
                     {{$userdata->firstname}}</li>

                <li class="list-group-item text-right"> 
                <div class="panel-group" id="accordion">   
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"  >Change Password</a>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <form id=passwordform action="<?php echo url('UpdatePassword')?>" method="POST"> 
                          {{csrf_field()}}
                          <input type="password" class="form-control" id="oldpassword" name="oldpassword" required  placeholder="Old Password"><span id=passworderror></span><br/>
                          <input type="password" class="form-control" id="newpassword" name="newpassword" required placeholder="New Password" ><span id=newpassworderror></span><br/>
                          <input class="btn btn-sm btn-primary" type="submit" name="save"  value="Change">
                        </form>
                      </div>
                  </div>
                </div> 
                </li>
            </ul>
        </div>
    </div><!--/col-3-->
     @if(Session::has('message'))
       <div class="alert-success alert">Your Order Processed Succesfully</div> 
        
        @endif
    <div class="col-sm-9">
        <div class="panel">
            <div class="panel-body">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home">List of Orders</a>
                    </li> 
                    <li>
                        <a data-toggle="tab" href="#settings">Update
                        Account</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#wishlist">WishList</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                                                <div class="table-responsive" style="margin-top:5%;">
                            <form action=
                            "customer/controller.php?action=delete" method=
                            "post">
                                <table cellspacing="0" class=
                                "table table-striped table-bordered table-hover"
                                id="example" style="font-size:12px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order#</th>
                                            <th>Date Ordered</th>
                                            <th>TotalPrice</th>
                                            <th>PaymentMethod</th>
                                            <th>Status</th>
                                            <th width="150px">Remarks</th>
                                         <th></th>
                                        </tr>

                                      
                                    </thead>
                                    <tbody id=showdata>

                                      @if(isset($order_details))
                                         @php
                                        
                                      $sno=0;
                                      @endphp
                                      @foreach($order_details as $d)
                                      @php
                                      $sno++;
                                      @endphp
                                      <td>{{$sno}}</td>
                                        <td>{{$d->id}} </td>
                                            <td>
                                            
                                            <?php echo date('d-m-Y H:i:s',strtotime($d->created_at))?></td>
                                            <td>Rs {{$d->total_price}}</td>
                                            <td>{{$d->payment_type}}</td>
                                            <td>{{$d->status}}</td>
                                            <td>{{$d->remarks}}</td>
                                            <td class="tooltip-demo">
                                                <a class="orderid btn btn-pup btn-xs"
                                                data-id="{{$d->id}}"
                                                data-target="#myOrdered"
                                                data-toggle="modal" 
                                                title="View list Of ordered products">
                                                <i class="fa fa-info-circle fa-fw"
                                                data-placement="left"
                                                data-toggle="tooltip" title=
                                                "View Order"></i> <span class=
                                                "tooltip tooltip.top">view</span></a>
                                            
                                            </td>
                                        </tr>                                        <tr>
                                       
</tr>
@endforeach
                                      @endif
                                       
                                                                            </tbody>
                                </table>
                            </form> 
                        </div><!--/table-resp-->
                    </div><!--/tab-pane-->
                    <div class="tab-pane" id="settings">
                           
<h3>Your Account</h3>
  <form id=updateform class="form-horizontal span6" action="<?php echo url('updateCustomer')?>"  name="personal" method="POST" enctype="multipart/form-data"> 
    {{csrf_field()}}
          <div class="row">
             <div class="col-lg-6">
            <div class="form-group">
              <div class="col-md-12">
                <label class="col-md-4 control-label" for=
                "FNAME">First Name:</label>
                  <div class="col-md-8">
                   <input class="form-control input-sm" id="fname" name="fname" placeholder=
                      "First Name" type="text" value="{{$userdata->firstname}}">
                </div>
              </div>
            </div>
           </div>   
           
           <div class="col-lg-6"> 
            <div class="form-group">
              <div class="col-md-12">
                <label class="col-md-4 control-label" for=
                "LNAME">Last Name:</label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="lname" name="lname" placeholder=
                      "Last Name" type="text" value="{{$userdata->lastname}}">
                </div>
              </div>
            </div>
           </div>   

         
            <div class="col-lg-6">
             
             <div class="form-group">
              <div class="col-md-12">
                <label class="col-md-4 control-label" for=
                "CITYADD">Municipality/City:</label>

                <div class="col-md-8">
                   <input class="form-control input-sm" id="city" name="city" placeholder=
                      "Municipality/City Address" type="text" value="{{$userdata->city}}">
                </div>
              </div>
            </div>

           </div>  


       
  

            <div class="col-lg-6"> 
                <div class="form-group">
                <div class="col-md-12">
                  <label class="col-md-4 control-label" for=
                  "PHONE">Contact#:</label>

                  <div class="col-md-8">
                     <input class="form-control input-sm" id="phone" name="phone" placeholder=
                        "Contact Number" type="text" value="{{$userdata->phone1}}">
                  </div>
                </div>
              </div> 
           </div> 

             <div class="col-lg-6">
              <div class="form-group">
                <div class="col-md-12">
                  <label class="col-md-4 control-label" for=
                  "CUSUNAME">Shipping Address:</label>

                  <div class="col-md-8">
                     <input class="form-control input-sm" id="address" name="address" placeholder=
                        "Username" type="text" value="{{$userdata->address}}">
                  </div>
                </div>
              </div> 
           </div>  
                <div class="col-lg-6">
              <div class="form-group">
                <div class="col-md-12">
                  <label class="col-md-4 control-label" for=
                  "CUSUNAME">Postal Code:</label>

                  <div class="col-md-8">
                     <input class="form-control input-sm" id="postcode" name="postcode" placeholder=
                        "Username" type="text" value="{{$userdata->postcode}}">
                  </div>
                </div>
              </div> 
           </div>  
  
      
          </div>
          
           

          <div class="col-lg-6"> 
              <div class="form-group">
                <div class="col-md-12">
                   <label class="col-md-4" align = "right"for=
                  "btn"></label>
                  <div class="col-md-8">
                    <input type="submit"  name="save"  value="Save"  class="submit btn btn-primary btn-lg"  />
                      
                </div>
              </div>
            </div>
         </div>     
  </form>   
  
   
                
 
                  

                               
                





 
              








                   
        
        </form>                    </div><!--/tab-pane-->
                      <div class="tab-pane" id="wishlist">
                        <h3>Wish List</h3>  
             <form   method="POST" action="/ecommerce/cart/controller.php?action=add">           
                    <table id="example" class="table "  style="font-size:12px" cellspacing="0"  > 
                      
                    <tbody>
                                            
                      </tbody>
                      
                      
                    </table>
                 </form>
                         </div><!--/tab-pane-->
                </div><!--/tab-content-->
            </div>
        </div><!--/col-9-->
    </div><!-- Modal photo -->
    <div class="modal fade" id="myModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type=
                    "button">×</button>
                    <h4 class="modal-title" id="myModalLabel">Choose
                    Image.</h4>
                </div>
                <form id=imageform action='<?php echo url('UpdateProfilePic')?>' enctype=
                "multipart/form-data" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="rows">
                                <div class="col-md-12">
                                    <div class="rows">
                                        <div class="col-md-8">
              <input id="photo" name="photo"
                                            type="file">
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal"
                        type="button">Close</button> <button class=
                        "btn btn-pup" name="savephoto" type="submit">Upload
                        Photo</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </div></div>
</section>
  <div class="modal fade in" id="myOrdered" aria-hidden="false" >  
 

<div class="modal-dialog" style="width:60%">
  <div class="modal-content">
  <div class="modal-header">
    <button class="close" id="btnclose" data-dismiss="modal" type="button">×</button>
     <span id="printout">
 
    <table>
      <tbody><tr>
        <td align="center"> 
        <img src="/ecommerce/images/home/logo.png" alt="Image">
            </td> 
      </tr>
    </tbody></table>
    <!-- <h2 class="modal-title" id="myModalLabel">Billing Details </h2> -->
    
     
   <div class="modal-body"> 
<h5>Your order is on process. Please check your profile for notification of confirmation.</h5><hr>
 <h4><strong>Order Information</strong></h4>
    <table id="table" class="table">
      <thead>
        <tr>
          <!-- <th>PRODUCT</th>? -->
          <th>PRODUCT</th>
          <!-- <th>DATE ORDER</th>  -->
          <th>Product PRICE</th>
          <th>QUANTITY</th>
          <th>Discount Perc</th>
          <th>TOTAL PRICE</th>
          <th></th> 
        </tr>
        </thead>
        <tbody id=showdetails>
 
    
      </tbody>
    <tfoot>
    
   </tfoot>
       </table> <hr>
    <div class="row">
        <div class="col-md-6 pull-left">
         <div>Ordered Date : <span id="createdon"></span></div> 
          <div>Payment Method : <span id="pm"></span></div>

        </div>
        <div class="col-md-6 pull-right">
          <p align="right">Total Price : Rs <span id="price"></span></p>
          <p align="right">Delivery Fee :  0.00</p>
          <p align="right">Overall Price : Rs <span id="total_price"></span></p>
        </div>
      </div>
     
        </div> 

</span>

    <div class="modal-footer">
     <div id="divButtons" name="divButtons">
     
     
                <button onclick="tablePrint();" class="btn btn_fixnmix pull-right "><span class="glyphicon glyphicon-print"></span> Print</button>     
             
              <button class="btn btn-pup" id="btnclose" data-dismiss="modal" type="button">Close</button> 
     </div> 
    <!-- <button class="btn btn-primary"
      name="savephoto" type="submit">Upload Photo</button> -->
    </div>
  <!-- </form> -->
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
 </div>
  <script>
function tablePrint(){ 
 // document.all.divButtons.style.visibility = 'hidden';  
    var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
    display_setting+="scrollbars=no,width=1000, height=1000, left=100, top=25";  
    var content_innerhtml = document.getElementById("printout").innerHTML;  
    var document_print=window.open("","",display_setting);  
    document_print.document.open();  
    document_print.document.write('<body style="font-family:verdana; font-size:12px;" onLoad="self.print();self.close();" >');  
    document_print.document.write(content_innerhtml);  
    document_print.document.write('</body></html>');  
    document_print.print();  
    document_print.document.close(); 
     // document.all.divButtons.style.visibility = 'Show';  
   
    return false; 

    } 
 
</script>

 <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
  $(function(){




$('#updateform').on('submit',function (e) {
  e.preventDefault(e);

  var url='<?php echo url('updateCustomer')?>';

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
$('.alert-success').addClass('alert').html('User Updated Successfully').fadeIn().delay(4000).fadeOut();
      }
     

    },
    error:function(){
alert('Update Error');
  
    }
  });

});





$('#imageform').on('submit',function (e) {
  e.preventDefault(e);

  var url='<?php echo url('UpdateProfilePic')?>';

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
        $('#myModal').modal('hide');
$('input').removeClass('is-invalid');
$('.alert-success').addClass('alert').html('Image Updated Successfully').fadeIn().delay(4000).fadeOut();
      }
      if(response.error){

      if('photo' in response.error){
  $('#photo').addClass('is-invalid');

      }
      else{
       $('#photo').removeClass('is-invalid');
      }


}

    },
    error:function(){
alert('Image Upload Error');
  
    }
  });

});







$('#passwordform').on('submit',function (e) {
  e.preventDefault(e);

  var url='<?php echo url('UpdatePassword')?>';

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
      $('#passwordform')[0].reset();
$('input').removeAttr('style','border: 1px solid #c74d4d');
   $('#passworderror').html('');
   $('#newpassworderror').html("");
   $('.alert-success').addClass('alert').html('Password Updated Successfully').fadeIn().delay(4000).fadeOut();
      }
      if(response.invalid){
        $('#passworderror').html('');
          $('#passworderror').html('Old Password does not match');

      }
      if(response.error){

      if('oldpassword' in response.error){
  $('#oldpassword').attr('style','border: 1px solid #c74d4d');
$('#passworderror').html(response.error.oldpassword);
      }
      else{
      $('#oldpassword').removeAttr('style','border: 1px solid #c74d4d');
      $('#passworderror').html("");
      }
 if('newpassword' in response.error){
  $('#newpassword').attr('style','border: 1px solid #c74d4d');
$('#newpassworderror').html(response.error.oldpassword);
      }
      else{
        $('#newpassworderror').html("");
      $('#newpassword').removeAttr('style','border: 1px solid #c74d4d');
      }


}

    },
    error:function(){
alert('Password Update Error');
  
    }
  });

});







$('#showdata').on('click','.orderid',function(){
var id=$(this).attr('data-id');

$.ajax({
  method:'get',
  data:{'id':id},
  url:"{{url('/ShowOrderDetails')}}",
  dataType:'json',
  async:false,
  success:function(res){
    var html='';
    var price=0;      

 var total=0;
    for(var i=0;i<res.length;i++){
        html+='<tr>'+
                '<td>'+res[i].product_name+'</td>'+
                '<td>'+res[i].pprice+'</td>'+
                '<td align="center">'+res[i].oquantity+'</td>'+
                   '<td align="center">'+res[i].discount+'</td>'+
                '<td>Rs '+res[i].oprice+'</td>'+ 
              '</tr>'; 
              total=parseInt(total)+parseInt(res[i].oprice);
$('#pm').html(res[i].payment_type);

$('#createdon').html(res[i].created_at);
};
$('#price').html(total);
$('#total_price').html(total);

              $('#showdetails').html(html);
  },
  error:function(){
    alert('404 error');
  }
});
})
  });
  
</script>
</div>

  @endsection('content')