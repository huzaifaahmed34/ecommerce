
@section('sidebar') 
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{asset('public/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><span style="color:#FED189;">HUZAIFA</span><span style="color:#058ABF;">AHMED</span>
    </span></a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('public/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->id}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Dashboard
               
              </p>
            </a>

          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-copy"></i>
              <p>

      Category
 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

               <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-copy"></i>
              <p>

      Categories
 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/CategoryAdd')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Categories</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="{{url('admin/CategoryView')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Categories</p>
                </a>
              </li>
               
            </ul>
          </li>

               <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-copy"></i>
              <p>

     Sub Categories
 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/SubCategoryAdd')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Sub Categories</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Sub Categories</p>
                </a>
              </li>
               
            </ul>
          </li>
               
            </ul>
          </li>
        
         <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-table"></i>
              <p>

     Products
 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
               <li class="nav-item">
                <a href="{{url('admin/ProductAdd')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="{{url('admin/ViewProduct')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product</p>
                </a>
              </li>
             
            </ul>
          </li>

                <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-table"></i>
              <p>

     Products Specification
 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
               <li class="nav-item">
                <a href="{{url('admin/SpecificationAdd')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product Specification</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="{{url('admin/addWarrantyType')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Warranty Type</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{url('admin/addWarranty')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Warranty Period</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/BrandAdd')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Brand</p>
                </a>
              </li>
             
            </ul>
          </li>
        


                <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-table"></i>
              <p>

     Discounts And Coupons
 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
               <li class="nav-item">
                <a href="{{url('admin/ProductDiscount')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product Discount</p>
                </a>
              </li>
             
        
             
            </ul>
          </li>
        






         <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-table"></i>
              <p>

     Dealer
 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
               <li class="nav-item">
                <a href="{{url('admin/DealerAdd')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Dealer</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Dealer</p>
                </a>
              </li>
             
            </ul>
          </li>
        

         <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-table"></i>
              <p>

     Orders
 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
               <li class="nav-item">
                <a href="{{url('admin/ViewCompletedOrders')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Completed Orders</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="{{url('admin/ViewPendingOrders')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Pending Orders </p>
                </a>
              </li>
                   <li class="nav-item">
                <a href="{{url('admin/ViewCancelOrders')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Cancelled Orders </p>
                </a>
              </li>
             
            </ul>
          </li>
        



           <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-copy"></i>
              <p>

      Reports
 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

     

               
            </ul>
          </li>







        






        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
@endsection('sidebar')