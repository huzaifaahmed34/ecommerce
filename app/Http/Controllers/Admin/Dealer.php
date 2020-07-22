<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Model\Dealer_model as m;

class Dealer extends Controller
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
    public function AddDealer()
    {
        return view('user.adddealer');
    }
     public function EditDealer($id=null)
    {   $data=m::EditDealer($id);
        
        return response()->json($data);
    }
      

        public function ShowDealer()
    {
        $res=m::ShowDealer();
        return response()->json($res);
    }

      public function ViewDealer()
    {
      
        return view('user.viewDealer');
    }
    
     public function UpdateDealer(Request $request)
    {      
       $res=m::UpdateDealer($request);
       
              return response()->json(['success'=>'Update record.']);
      
    }


 public function DeleteDealer($id)
    {
        $res=m::DeleteDealer($id);
     return response()->json(['success'=>'Delete record.']);
    }


      public function InsertDealer(Request $request)
    {      $validator = Validator::make($request->all(), [
        


            'name' => 'required',
            'cnic' => 'required',
            'phone' => 'required',
            'email' => 'email|required',
             'address' => 'required',
            
          
        ]);


        if ($validator->passes()) {

  $res=m::InsertDealer($request);
       
            return response()->json(['success'=>'Added new records.']);
        }

else{
        return response()->json(['error'=>$validator->getMessageBag()->toArray() ]);
    }

    }

    
}
