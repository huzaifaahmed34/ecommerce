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
              <li class="breadcrumb-item ">Add Category</li>
               <li class="breadcrumb-item active">Add Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" id=app>
        <!-- Small boxes (Stat box) -->
        <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h1 class="card-title">Add Category</h1>
            </div>
            <!-- /.card-header -->

            <div class="card-body">

            	<div class="col-lg-12  alert-success">
		
            	</div>
         
			<div class="col-lg-12  alert-danger">

            	</div>
 

                <form id="form1" action="<?php echo url('admin/InsertCategory')?>"   method="POST" enctype="multipart/form-data">
			

      
   <div class="row">
            <div class="col-md-6" id=customerdiv>
              <label>Select Customer</label>
    <select name="customer" id="customer" class="form-control">
        <option value="">Select</option>
        
    </select>
    </div>
 
      <div class="col-md-6">
        <label>Date</label>
    <input type="input" value="<?php echo date('Y-m-d')?>" class="form-control" name="date" readonly/>

    </div>
      <div class="col-md-3">
         <label>Description</label>
    <input type="text" :class="[descinvalid?'is-invalid':'','form-control']" v-model='description' placeholder="Add Description" name="description"/>
    </div>
       <div class="col-md-1">
         <label>Unit</label>
    <input type="text" :class="[unitinvalid?'is-invalid':'','form-control']" v-model="unit"  placeholder="Unit" name="unit"/>
    </div>
    <div class="col-md-1">
       <label>Rate</label>
    <input type="text" id=rate class="form-control" @keyup="changerate;changetotal()" v-model=rate placeholder="Rate" name="rate">
    </div>
     <div class="col-md-1">
       <label>Qty</label>
   <input type="text" class="form-control" placeholder="Qty" @keyup="changerate;changetotal()"  v-model=qty id=qty name="qty">
    
    </div>

<div class="col-md-1">
       <label>D%</label>
      <input type="text" id=discount class="form-control" @keyup="changerate();changetotal()"  placeholder="Discount"  v-model=dpercent name="discount" value=0>
    </div>   
<div class="col-md-2">
       <label>D Amt</label>
    <input type="text" class="form-control" placeholder="D amount" name="damnt" v-model=discoutnamount readonly> 
    </div>  
    <div class="col-md-2">
       <label>Total</label>
    <input type="text" class="form-control" :class="Invalid"  placeholder="Total" name="total" readonly v-model=total>
    </div>  <div class="col-md-1" style="margin-top: 24px;">   
            <button type=button class="btn bg-olive" id=btnSave1 @click='checkform();'>Add</button> 
            </div>
	
          </div>
    
  
    </form>
  <div class="row" style="margin-top: 50px;">
  		<div class="col-lg-12">
  			<table class="table table-stiped">
  				<thead class="thead thead-dark">
  					<tr>
  					<th>#</th>
  					<th>Description</th>
  					<th>Unit</th>
  					<th>Rate</th>
  					<th>Qty</th>
  					<th>Discount %</th>
  					<th>Discount Amount</th>
  					<th>Total</th>
  					<th>Delete</th>
  				</tr>
  				</thead>
  				
  				<tbody>
  					<tr v-for="i,index in list">
  				<td>@{{i.sno}}</td>
  					<td>@{{i.description}}</td>	
  					<td>@{{i.unit}}</td>	
  					<td>@{{i.rate}}</td>	
  					<td>@{{i.qty}}</td>	
  					<td>@{{i.dpercent}}</td>	
  					<td>@{{i.discoutnamount}}</td>	
  					<td>@{{i.total}}</td>	
  					<td><button class="btn btn-danger" @click=deleterow(index)>Remove</button></td>
  					</tr>
  			
  					<tr class="bg-info">
  						<td class="text-right" colspan="9"><h5>Total : @{{totalamount}}</h5></td>
  					</tr>

  				</tbody>
  			
  			</table>

  		</div>
  </div>  
</div>
</div>
</div>
</div>
</div>
</section>
</div> 
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script type = "text/javascript">
	
var app=new Vue({
	el:'#app',
	data:{
		formdata:[],
		rate:0,
		qty:0,
		totalamount:0,
		sno:0,
		dpercent:0,
		discoutnamount:0,
		total:0,
		unit:'',
		description:'',
		i:0,
		name:'',
		hello:'2',
		TInvalid:false,
		descinvalid:false,
		unitinvalid:false,
 	Invalid:'',

 	
		list:[],
		liststyle:'text-danger',
		listst:{
			'color':'black',

		},

	},
	methods:{
		show:function () {

			this.Invalid=true;
		},
		changetextred:function(){
				this.listst.color='red';
		},
		changetextblack:function(){
				this.listst.color='black';
		},
		changerate:function(){
			this.discoutnamount=(this.rate*this.qty)*this.dpercent/100;
		
		},
			changetotal:function(){
			this.total=(this.rate*this.qty)-this.discoutnamount;
		
		},
		add:function(){
			

					this.list.push({sno:++this.sno,unit:this.unit,description:this.description,rate:this.rate,qty:this.qty,dpercent:this.dpercent,discoutnamount:this.discoutnamount,total:this.total});
					this.totalamount+=Math.round(this.total);
		
		},
		checkform:function(){
			let result='';
			if(this.description!=''){
			
		result+='1';
				this.descinvalid=false;
			}else{
				
				this.descinvalid=true;
			}

			if(this.unit!=''){
		
				result+='1';
				this.unitinvalid=false;

			}
			else{
				this.unitinvalid=true;
			}
	

	if(result=='11'){
		this.add();
result='';
		}
	},
			deleterow(id){
				this.totalamount=Math.round(this.totalamount-Math.round(this.list[id].total));
				this.list.pop(id);

	
			}
}
});
</script>

@endsection
