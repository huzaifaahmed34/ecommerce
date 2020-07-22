@extends('layouts.header')

@extends('layouts.footer')


@section('content')	

         <style type="text/css">
           #gif{
                z-index: 1000;
    top: 41%;
    left: 47%;
    position: absolute;
           }
         </style>
              <!-- Nav tabs -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 ">
              <ul class="nav nav-pills text-center">
                  <li class=" ">
                  </li>
                  <li class="">
                  </li>
                  
              </ul>
          </div>
</div>
<img src="{{asset('public/images/404/gif.gif')}}" style="display: none" width="70px;" id=gif>
              <!-- Tab panes  login panel-->
              <div class="row">
              	<div class="col-lg-12 ">
              <div class="tab-content">
                  <div class="tab-pane fade active in" id="home">
                      <!-- <h4>Login Tab</h4>  -->
                       <div class="panel panel-pup">
                        <div class="panel-heading text-center">
                           <h3>Already Have an Account?<br>Login</h3>
                        </div>
                        <div class="panel-body">

    <form class="form-horizontal" role="form" method="POST" action="{{ url('CustomerLogin') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
@if(Session::has('message'))
                                    <span class="help-block">
                                        <strong style="color:red">{{ Session::get('message') }}</strong>
                                    </span>
                                    @endif
                        
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-4">
                                <input id="password" type="password" class="form-control" name="password" required>

                                    <span class="help-block">
                                        <strong>{{old('message') }}</strong>
                                    </span>
                              
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" value="{{ old('remember') ? 'checked' : ''}}"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                     
                                    <a class="btn "  style="background:#428bca;color:white" href="#profile" data-toggle="tab">Or Sign Up</a>
                                    </div>
                               
                                </div>
                            </form>

                       </div>
                      
                    </div> 
                  </div>
                  <!-- end login panel -->



      <a class="btn t"  style="visibility: hidden;" href="#verification" data-toggle="tab">Verification</a>



   <div class="tab-pane fade  in" id="verification">
                      <!-- <h4>Login Tab</h4>  -->
                       <div class="panel panel-pup">
                        <div class="panel-heading text-center">
                           <h3>Email Verification</h3>
                        </div>
                        <div class="panel-body">

                           <form class="form-horizontal span6" name="" action="login.php" method="POST">
                           	<div class="row">
                              <input class="proid" type="hidden" name="proid" id="proid" value="">
                              <div class="col-md-4">
                              </div>
                                      <div class="col-md-4">
                                <div class="form-group ">
                          
                                    <label >Enter Verfication Code <span id=verror style="color: red"></span></label>
                          
                     <input id="verification_code" name="verification_code" placeholder="6 Digits" type="text" class="form-control " max=6> 
                             
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                              </div>
                                </div>
                                <div class="row">
 <div class="col-md-4">
                              </div>
                                      <div class="col-md-4">
                                <div class="form-group">
                             <p>Verification Code has been sent to your email <span id=emailverification></span></p>
                             <input type="hidden" name="user_id" >
                            
                                    </div>
                                  </div>
                                   <div class="col-md-4">
                              </div>
                                    </div>

                                    <div class="col-md-12 text-center ">
                                  <div class="form-group ">
                              
                                    <button type="button" id="verify" name="verify" class="btn btn-pup" id=verify>   Verify and Continue Shopping</button> 
                                   
                                    </div>
                               
                                </div>
                            </form>

                       </div>
                      
                    </div> 
                  </div>

                  <!-- sign in panel -->
                  <div class="tab-pane fade" id="profile">
                      <!-- <h4>Customer Details</h4>  --> 

                           <form id=signupform class="form-horizontal span6"  action='<?php echo url('InsertSignup')?>' method="POST" enctype="multipart/form-data">
                           	{{csrf_field()}}
                                <div class="panel panel-pup">
                                    <div class="panel-heading text-center">
                                       <h3>Complete the following Requirements to Proceed</h3>
                                    </div>
                                     <div class="panel-body">
                                      <input class="proid" type="hidden" name="proid" id="proid" value="">
                               

                                        <div class="col-md-12">

                                     <div class=row>
										<div class="col-md-2">
										</div>
                                          <div class="col-md-4">
                                          	  <label >First Name: <span style="color:red" id="fnameerror"></span></label>
                                             <input class="form-control" id="fname" name="fname" placeholder="First Name" type="text" value="">
                                          </div>
                                          		
                                         <div class="col-md-4">
                                          <label  for="LNAME">Last Name: <span style="color:red" id="lnameerror"></span></label>

                                             <input class="form-control " id="lname" name="lname" placeholder="Last Name" type="text" value="">
                                          </div>
                                          	<div class="col-md-2">
										</div>

                                     
                                       </div>
          				   <div class=row>
										<div class="col-md-2">
										</div>
                                            <div class="col-md-4">
                                              <label > Phone 1: <span style="color:red" id="phone1error"></span></label>

                                                 <input class="form-control " id="phone1" name="phone1" placeholder="Enter Phone Number" type="number" value="">
                                              </div>
                                         
                                            <div class="col-md-4">
                                              <label class="control-label" for="CITYADD">
                                              Phone 2: <span style="color:red" id="phone2error"></span></label>
                                                 <input class="form-control " id="phone2" name="phone2" placeholder="Phone 2" type="number" value="">
                                              </div>
                                              <div class="col-md-2">
                                              </div>
                                           </div>

                                             


                                              <div class=row>
										<div class="col-md-2">
										</div>

                                            <div class="col-md-4">
                                              <label class="control-label" for="CITYADD">Address 1: <span style="color:red" id="address1error"></span></label>
                                                 <textarea class="form-control " id="address1" name="address1" placeholder="Enter Your Shipping Address" type="text" value=""></textarea>
                                              </div>

                                               

                                               <div class="col-md-4">
                                              <label class=" control-label" for="CITYADD">Address 2(Optional): <span style="color:red" id="fnameerror"></span></label>

                                                 <textarea class="form-control " id="address2" name="address2" placeholder="Enter Your Shipping Address " type="text" value=""></textarea>
                                              </div>
                                               <div class="col-md-2">
                                              </div>
                                           </div>


 <div class=row>
										<div class="col-md-2">
										</div>
  
                                            <div class="col-md-4">
                                              <label class="control-label" for="CITYADD">Municipality/City: <span style="color:red" id="cityerror"></span></label>
                                                 <input class="form-control " id="city" name="city" placeholder="Municipality/City " type="text" value="">
                                              </div>




                                           
                                            <div class="col-md-4">
                                              <label class="control-label" for="CITYADD">Postal Code: <span style="color:red" id="postcodeerror"></span></label>
                                                 <input class="form-control " id="postcode" name="postcode" placeholder="Enter Postal Code" type="text" value="">
                                              </div>
                                         
										<div class="col-md-2">
										</div>
  												</div>

  												 <div class=row>
										<div class="col-md-2">
										</div>
  
                                           
                                            <div class="col-md-4">
                                              <label class=" control-label" for="CITYADD">Email: <span style="color:red" id="emailerror"></span></label>
                                                 <input class="form-control " id="email" name="email" placeholder="Enter Your Email" type="email" value="">
                                              </div>
                                           
                                            <div class="col-md-4">
                                              <label class="control-label" for="CITYADD">Date Of Birth: <span style="color:red" id="doberror"></span></label>
                                                 <input class="form-control" id="dob" name="dob" placeholder="Date Of Birth " type="date" value="">
                                              </div>
                                              	<div class="col-md-2">
										</div>
  
                                          </div>

  											
  												 <div class=row>
										<div class="col-md-2">
										</div>
  
                                          
                                        <div class="col-md-4">
                                          <label class="control-label" for="CUSUNAME">Username: <span style="color:red" id="usernameerror"></span></label>
                                             <input class="form-control" id="username" name="username" placeholder="Username" type="text" value="">
                                          </div>
                                        <div class="col-md-4">
                                          <label class="control-label" for="CUSPASS">Password: <span style="color:red" id="passworderror"></span></label>

                                             <input class="form-control " id="password" name="password" placeholder="Password" type="password" value=""><span></span>
                                          </div>
										</div>
											 <div class=row>
										<div class="col-md-2">
										</div>
  
                                               <div class="col-md-4 " style="margin-top: 30px;">
                                          <label class=" control-label" for="GENDER">Gender: <span style="color:red" id="gendererror"></span></label>

                                            <input id="gender" name="gender" placeholder="Gender" type="radio" checked="true" value="Male"><b> Male </b>
                                                <input id="gender" name="gender" placeholder="Gender" type="radio" value="Female"> <b> Female </b>
                                          </div>
                                       </div>
                                    
                                     

                                         
                                        </div>
                                      

                          
                                 
                                          <div class="col-md-12 text-center">
                                              <button type="button" id="signup" name="signup" class="btn btn-pup"><span class="glyphicon glyphicon-log-in "></span>   Signup</button> 
                                          <a class="btn btn-default " style="background:#428bca;color:white" href="#home" data-toggle="tab">Or Login </a>                                          </div>
                                        </div>
                                      </div> 

                                        

                                     </div>
                                    
                            </div> 
                            <!-- end panel sign up -->
                        </form>  
                   </div> 
               </div>
         </div>
              </div>
     
</div>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>


  $(function(){
 $('#verify').unbind().click(function(){
var ver=$('#verification_code').val();
var user_id=$("input[name=user_id]").val();

var url='<?php echo url('CheckVerificationCode')?>';
	$.ajax({
		type:'ajax',
		method:'get',
		data:{'ver':ver,'user_id':user_id},
		url:url,
		dataType:'json',
		async:false,
		success:function(response){
			if(response.success){
				$('#signupform')[0].reset();
			window.location.replace('{{url("http://localhost/blog/login/customer")}}');
				$('#verror').html('');
			}
			else{
					$('#verror').html('Invalid Verification Code');
			}
		},
		error:function(){
alert('error');
		}

 });
}); 
$('#signup').unbind().click(function(){


	var data=$('#signupform').serialize();

	var url='<?php echo url('InsertSignup')?>';

	$.ajax({
		type:'ajax',
		method:'post',
		data:data,
		url:url,
		dataType:'json',
		cache:false,
        beforeSend: function(){
 $("#gif").removeAttr('style','display:none');
    },      complete: function(){
      $("#gif").attr('style','display:none');
      },
    
		success:function(response){
		  $("#gif").attr('style','display:none');
			if(response.success){
				
				$('input[name=user_id]').val(response.success);

$('input').removeClass('is-invalid');
$('.alert-success').addClass('alert').html('Data Inserted Successfully').fadeIn().delay(4000).fadeOut();

$('.t').trigger('click');
			}
			if(response.error){



if('fname' in response.error){
	  $('#fnameerror').html(response.error.fname[0]);
  $('#fname').parent().parent().addClass('is-invalid');

      }
      else{
      	$('#fnameerror').html('');
       $('#fname').removeClass('is-invalid');
      }


      if('city' in response.error){
	  $('#cityerror').html(response.error.city[0]);
  $('#fname').parent().parent().addClass('is-invalid');

      }
      else{
      	$('#cityerror').html('');
       $('#city').removeClass('is-invalid');
      }


      if('lname' in response.error){
  $('#lname').addClass('is-invalid');
  $('#lnameerror').html(response.error.lname[0]);
      }
      else{
      		$('#lnameerror').html('');
       $('#lname').removeClass('is-invalid');
      }

            if('phone1' in response.error){
  $('#phone1').addClass('is-invalid');
  $('#phone1error').html(response.error.phone1[0]);
      }
      else{
      		$('#phone1error').html('');
       $('#phone1').removeClass('is-invalid');
      }
      if('phone2' in response.error){
      	  $('#phone2error').html(response.error.phone2[0]);
  $('#phone2').addClass('has-error');

      }
      else{
      		$('#phone2error').html('');
       $('#phone2').removeClass('has-error');
      }

   if('email' in response.error){
   	  $('#emailerror').html(response.error.email[0]);
  $('#email').addClass('is-invalid');

      }
      else{
      		$('#emailerror').html('');
       $('#email').removeClass('is-invalid');
      }

      if('username' in response.error){
      	  $('#usernameerror').html(response.error.username[0]);
  $('#username').addClass('is-invalid');

      }
      else{
      		$('#usernameerror').html('');
       $('#username').removeClass('is-invalid');
      }

      if('address1' in response.error){
      	  $('#address1error').html(response.error.address1[0]);
  $('#address1').addClass('is-invalid');

      }
      else{
      		$('#address1error').html('');
       $('#address1').removeClass('is-invalid');
      }
           if('password' in response.error){
           	  $('#passworderror').html(response.error.password[0]);
  $('#password').addClass('is-invalid');

      }
      else{
      		$('#passworderror').html('');
       $('#password').removeClass('is-invalid');
      }

          if('dob' in response.error){
          	  $('#doberror').html(response.error.dob[0]);
  $('#dob').addClass('is-invalid');

      }
      else{
      		$('#doberror').html('');
       $('#dob').removeClass('is-invalid');
      }
          if('dob' in response.error){
          	  $('#doberror').html(response.error.doberror[0]);
  $('#city').addClass('is-invalid');

      }
      else{
      		$('#doberror').html('');
       $('#city').removeClass('is-invalid');
      }

           if('postcode' in response.error){
           	  $('#postcodeerror').html(response.error.postcode[0]);
  $('#postcode').addClass('is-invalid');

      }
      else{
      		$('#postcodeerror').html('');
       $('#postcode').removeClass('is-invalid');
      }

		

}

		},

		error:function(){
		$('.alert-danger').addClass('alert').html('Data not Inserted Successfully').fadeIn('slow').delay(4000).fadeOut('slow');
	
		}
	});
})



  });
</script>
@endsection('endcontent')