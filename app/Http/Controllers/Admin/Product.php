<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Model\Product_model as m;

class Product extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function AddProduct()
    {
        return view('user.addproduct');
    }

    public function addWarrantyType()
    {
        return view('user.addWarrantyType');
    }


    public function addWarranty()
    {
        return view('user.addWarranty');
    }

    public function ProductDiscount()
    {
        return view('user.ProductDiscount');
    }
       public function ViewProduct()
    {
       $res=m::ViewProduct();
      return response()->json($res);
    }



  public function AddSpecification()
    {
        return view('user.addProductSpec');
    }

    public function InsertSpecification(Request $request)
    {      $validator = Validator::make($request->all(), [
            'name' => 'required|unique:product_spec,name',
     
          
        ]);


        if ($validator->passes()) {

          $res=m::InsertSpecification($request);
       
            return response()->json(['success'=>'Added new records.']);
        }

else{
        return response()->json(['error'=>$validator->getMessageBag()->toArray() ]);
    }

    }


    
 public function GetBrand(Request $request)
    {   $res=m::GetBrand($request);
       
            return response()->json($res);
        

    }
    
    
 public function GetSubcategory(Request $request)
    {   $res=m::GetSubcategory($request);
       
            return response()->json($res);
        

    }


  public function AddBrand()
    {
        return view('user.addBrand');
    }

    public function InsertBrand(Request $request)
    {      $validator = Validator::make($request->all(), [
            'name' => 'required',
     
          'subcategory_id'=>'required'
        ]);


        if ($validator->passes()) {

          $res=m::InsertBrand($request);
       
            return response()->json(['success'=>'Added new records.']);
        }

else{
        return response()->json(['error'=>$validator->getMessageBag()->toArray() ]);
    }

    }
    
     public function EditCategory($id=null)
    {   $data=m::EditCategory($id);
        
        return response()->json($data);
    }
      

        public function ShowCategory()
    {
        $res=m::ShowCategory();
        return response()->json($res);
    }

        public function UpdateDiscount(Request $request)
    {
        $res=m::UpdateDiscount($request);
        return response()->json($res);
    }

        public function RemoveDiscountAll(Request $request)
    {
        $res=m::RemoveDiscountAll($request);
        return response()->json($res);
    }


        public function UpdateDiscountAll(Request $request)
    {
        $res=m::UpdateDiscountAll($request);
        return response()->json($res);
    }

    
     public function UpdateCategory(Request $request)
    {      
       $res=m::UpdateCategory($request);
       
              return response()->json(['success'=>'Update record.']);
      
    }


 public function DeleteCategory($id)
    {
        $res=m::DeleteCategory($id);
     return response()->json(['success'=>'Delete record.']);
    }



     public function InsertWarrantyType(Request $request)
    {    
            $validator = Validator::make($request->all(), [
            'name' => 'required',
             'description' => 'required',
        ]);
 
          if ($validator->passes()) {
                $res=m::InsertWarrantyType($request);
                return response()->json(['success'=>'Added new records.']); 
            }
    else
    {
      return response()->json(['error'=>$validator->getMessageBag()->toArray() ]);
    }

    }



   public function InsertWarranty(Request $request)
    {    
            $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);
 
          if ($validator->passes()) {
                $res=m::InsertWarranty($request);
                return response()->json(['success'=>'Added new records.']); 
            }
    else
    {
      return response()->json(['error'=>$validator->getMessageBag()->toArray() ]);
    }

    }



      public function InsertProduct(Request $request)
    {    
          $validator = Validator::make($request->all(), [
                  'product_code' => 'required',
             'product_name' => 'required',
              'brand_name' => 'required',
               'long_desc' => 'required',
                'category_id' => 'required',
                 'subcategory_id' => 'required',
                  'dealer_id' => 'required',
                    'price' => 'required',
                   'short_desc' => 'required',
                'available_size' => 'required',
                'logo' => 'bail|required|max:2048',
                  'product_location' => 'required',
                   'SKU'=> 'required',
                  'warranty_type'=> 'required',
                      'warranty_period'=> 'required',
                        'warranty_policy'=> 'required',
                       'product_weight'=> 'required',
                        'product_dimensions'=> 'required',
                    
            
            
          
        ]);
 
 

        if ($validator->passes()) {
            
 $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();

$path = $request->file('logo')->storeAs('products', $imageName);
          
  $res=m::InsertProduct($request,$path);
       
                return response()->json(['success'=>'Added new records.']);
      
    }

else{
        return response()->json(['error'=>$validator->getMessageBag()->toArray() ]);
    }

    }

    
}
