<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Model\SubCategory_model as m;

class Subcategory extends Controller
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
    public function AddSubCategory()
    {
        return view('user.addsubcategory');
    }
     public function EditSubCategory($id=null)
    {   $data=m::EditSubCategory($id);
        
        return response()->json($data);
    }
      

        public function ShowSubCategory()
    {
        $res=m::ShowSubCategory();
        return response()->json($res);
    }

      public function ViewSubCategory()
    {
      
        return view('user.viewsubcategory');
    }
    
     public function UpdateSubCategory(Request $request)
    {      
       $res=m::UpdateSubCategory($request);
       
              return response()->json(['success'=>'Update record.']);
      
    }


 public function DeleteSubCategory($id)
    {
        $res=m::DeleteSubCategory($id);
     return response()->json(['success'=>'Delete record.']);
    }


      public function InsertSubCategory(Request $request)
    {      $validator = Validator::make($request->all(), [
            'name' => 'required',
              'category_id' => 'required',
                 'logo' => 'bail|required|max:2048',
   
        
        ]);


        if ($validator->passes()) {

 $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();

$path = $request->file('logo')->storeAs('categories', $imageName);
  $res=m::InsertSubCategory($request,$path);
       
            return response()->json(['success'=>'Added new records.']);
        }

else{
        return response()->json(['error'=>$validator->getMessageBag()->toArray() ]);
    }

    }

    
}
