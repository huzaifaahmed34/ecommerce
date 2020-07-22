<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Model\Category_model as m;

class Category extends Controller
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
    public function AddCategory()
    {
        return view('user.addcategory');
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

      public function ViewCategory()
    {
      
        return view('user.viewcategory');
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


      public function InsertCategory(Request $request)
    {      $validator = Validator::make($request->all(), [
            'name' => 'required',
             'logo' => 'bail|required|max:2048',
          
        ]);


        if ($validator->passes()) {

        
 $imageName = time() . '.' . $request->file('logo')->getClientOriginalExtension();

$path = $request->file('logo')->storeAs('categories', $imageName);
  $res=m::InsertCategory($request,$path);
       
            return response()->json(['success'=>'Added new records.']);
        }

else{
        return response()->json(['error'=>$validator->getMessageBag()->toArray() ]);
    }

    }

    
}
