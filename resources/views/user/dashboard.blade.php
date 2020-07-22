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
            <h1 class="m-0 text-dark">Ecommerce</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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

       
             <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner pt-4 pb-4">
                <h3>65</h3>

                <p>Total Pax</p>
              </div>
              <div class="icon ">
                <i class="fa fa-users mt-3"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
                <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="background-color: #F4B162;color: white;">
              <div class="inner pt-4 pb-4">
                <h3>65</h3>

                <p>Vouchers</p>
              </div>
              <div class="icon ">
                <i class="fa fa-print mt-3"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
                <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner pt-4 pb-4" style="background-color: #E65097;color: white;">
                <h3>65</h3>

                <p>Invoiced</p>
              </div>
              <div class="icon ">
               <i class="fas fa-file-invoice mt-3"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
                <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner pt-4 pb-4" style="background-color: #97D3C5;color: white;">
                <h3>65</h3>

                <p>Done</p>
              </div>
              <div class="icon ">
                <i class="fa fa-thumbs-up mt-3"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
                <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner pt-4 pb-4" style="background-color: #556877;color: white;">
                <h3>65</h3>

                <p>Arrival</p>
              </div>
              <div class="icon ">
                <i class="fas fa-plane mt-3"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
                <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner pt-4 pb-4" style="background-color: #D95043;color: white;">
                <h3>65</h3>

                <p>In Makkah</p>
              </div>
              <div class="icon ">
                <i class="fa fa-home mt-3"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
                <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box ">
              <div class="inner pt-4 pb-4" style="background-color: #26C281;color: white;">
                <h3>65</h3>

                <p>In Madina</p>
              </div>
              <div class="icon ">
                <i class="fa fa-heart mt-3"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
                <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box ">
              <div class="inner pt-4 pb-4" style="background-color: #57889C;color: white;">
                <h3>65</h3>

                <p>Departure</p>
              </div>
              <div class="icon ">
                <i class="fa fa-car mt-3"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
                <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box ">
              <div class="inner pt-4 pb-4" style="background-color: #D1B993;color: white;">
                <h3>65</h3>

                <p>Tickets</p>
              </div>
              <div class="icon ">
                <i class="fas fa-ticket-alt mt-3"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
                <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner pt-4 pb-4" style="background-color: #4C4F53;color: white;">
                <h3>65</h3>

                <p>Pasport Verified</p>
              </div>
              <div class="icon ">
                <i class="fa fa-barcode mt-3"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->      <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box ">
              <div class="inner pt-4 pb-4" style="background-color: #A8DB43;color: white;">
                <h3>65</h3>

                <p>Hotel Status</p>
              </div>
              <div class="icon ">
                <i class="fa fa-check mt-3"></i>
              </div>
             
            </div>
          </div>

          <!-- ./col -->
</div>
<div class="row">
<div class="col-lg-9">
   <table  class="table table-bordered table-striped ">
    
                <thead>
                  <tr class="bg-info">
                    <th >
                      <div class="row">
                        <div class="col-lg-3 ">
                      <span><h4>Hotel Status</h4>
                     </span> 
                   </div>
                    <div class=" col-lg-4 px-0">
                     <input type="date" class="form-control" id="inputSuccess" >
                   </div>
                   </div>
                    </th>
                  </tr>
           
              
                </thead>
                
              </table>
</div>
<div class="col-lg-3">
     <table  class="table table-bordered table-striped ">
    
                <thead>
                  <tr class="bg-info">
                    <th colspan=2>Vouchers Need to be Verified
                    </th>
                  </tr>
           
                <tr>
                  <tr>
                  <th>Client</th>
                  <th>Voucher No</th>
                
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>13123</td>
                  <td>HV6516
                  </td>
               
                </tr>
            </tbody>
             
              </table>
            </div>
  </div>
</div>
  
        <!-- /.row -->
      </div>
        <!-- Main row -->
    
              <!-- /.card-header -->
            
              <!-- /.card-body -->
           
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
     @endsection('content')
 

@extends('admin/footer')