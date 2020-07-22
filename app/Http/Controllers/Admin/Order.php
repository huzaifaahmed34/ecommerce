<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Model\Order_model as m;

class Order extends Controller
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
    public function ViewPendingOrders()
    {
        return view('user.ViewPendingOrders');
    }
     public function ViewCompletedOrders()
    {  
          return view('user.ViewCompletedOrders');
        
    }

         public function ViewCancelOrders()
    {  
          return view('user.ViewCancelOrders');
        
    }
     public function PendingOrderDetailsShow($id)
    {
        $res=m::PendingOrderDetailsShow($id);
     return $res;
        }
         public function ConfirmOrder($id)
    {
        $res=m::ConfirmOrder($id);
  return response()->json($res);
        }






 public function CancelOrder($id)
    {
        $res=m::CancelOrder($id);
        return response()->json($res);
    }


        public function PendingOrderShow()
    {
        $res=m::PendingOrderShow();
        return response()->json($res);
    }






  public function CompletedOrderDetailsShow($id)
    {
        $res=m::CompletedOrderDetailsShow($id);
     return $res;
        }


        public function CompletedOrderShow()
    {
        $res=m::CompletedOrderShow();
        return response()->json($res);
    }




  public function CancelOrderDetailsShow($id)
    {
        $res=m::CancelOrderDetailsShow($id);
     return $res;
        }


        public function CancelOrderShow()
    {
        $res=m::CancelOrderShow();
        return response()->json($res);
    }




      

}