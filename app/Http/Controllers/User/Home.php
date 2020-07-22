<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Home_model as m;
use Validator;
use Auth;
use DB;
use Session;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

use PayPal\Api\ExecutePayment;

use PayPal\Api\PaymentExecution;


require 'vendor/autoload.php';
class Home extends Controller
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
    public function index(Request $request)
    {   $data=DB::table('order_details as o')->select('p.id','p.logo','p.discount_available','p.discount_perc','p.end_discount_date','p.price','p.id','p.slug','p.product_name')->join('product as p','p.id','=','o.product_id')->where('p.is_deleted',0)->groupBy('o.product_id','p.price','p.id','p.slug','p.logo','p.product_name','p.discount_available','p.discount_perc','p.end_discount_date')->orderBy(\DB::raw('count(o.product_id)'),'desc')->paginate(4);
 if ($request->ajax()) {

            return view('Home.presult', compact('data'))->render();
        }
        return view('Home.home', compact('data'));
    }

    

        public function AccessForbidden()
    {

        return view('Home.alreadyadmin');
    }



   public function Search(Request $request)

    {
           $res=m::Search($request);

     return  response()->json($res);
    

    }


       public function  Featured()
    {
        return view('Home.Productview',['Featured'=>'Featured']);
    }

   public function SearchResults($slug)

    {
           $res=m::SearchResults($slug);
           return view('Home.ProductSearchview',['res'=>$res]);

     
    }

    
        public function getFilter(Request $request)

    {
           $res=m::getFilter($request);

     return  response()->json($res);
    

    }
          public function getFilterSearch(Request $request)

    {
           $res=m::getFilterSearch($request);

     return  response()->json($res);
    

    }
        public function Order()

    {
           $userdata=m::GetUserData();

        $res=m::GetOrder();
        return view('Home.OrderConfirm',['res'=>$res,'userdata'=>$userdata]);
    }

   public function ViewComments($id)
    {
        $res=m::ViewComments($id);
         return response()->json($res);

    }
    public function SubmitRating(Request $request)
    {
        $res=m::SubmitRating($request);
         return response()->json(['success'=>'Updated.']);

    }
       public function Profile()
    {       
          $userdata=m::GetUserData();
        $res=m::ShowOrder();
        return view('Home.customer_dashboard',['order_details'=>$res],['userdata'=>$userdata]);
    }

    

      public function UpdateProfilePic(Request $request)
    {      $validator = Validator::make($request->all(), [
          
             'photo' => 'bail|required|max:2048',
          
        ]);


        if ($validator->passes()) {

        
 $imageName = time() . '.' . $request->file('photo')->getClientOriginalExtension();

$path = $request->file('photo')->storeAs('UserPic', $imageName);
  $res=m::UpdateProfilePic($request,$path);
       
            return response()->json(['success'=>'Updated Profile Pic.']);
        }

else{
        return response()->json(['error'=>$validator->getMessageBag()->toArray() ]);
    }

    }

    
      public function  CategoriesSearch($slug)
    {
        return view('Home.Productview',['category_slug'=>$slug]);
    }
       public function  SubCategoriesSearch($slug)
    {
        return view('Home.Productview',['subcategory_slug'=>$slug]);
    }
       public function  ProductDetail($slug)
    {                $res=m::ShowProduct($slug);
        return view('Home.Productdetails',['product_detail'=>$res]);
    }
         public function  Cart()
    {        
        return view('Home.Cart');
    }
       
       public function  ShowProductCart()
    {        
        $res=m::ShowProductCart();
        return $res;
    }
         public function  AddCart(Request $Request)
        {    
            
      $res=m::AddCart($Request);
        return redirect('Cart');
    }
   

           public function  SizeChange(Request $Request)
        {    
            
      $res=m::SizeChange($Request);
  return response()->json(['success'=>'Updated.']);
    }


    public function  QuantityUp(Request $Request)
        {    
            
      $res=m::QuantityUp($Request);
      if($res=='error'){
         return response()->json(['error'=>'Limit Exceeds Avalaible Quantity']);
      }
        else{
  return response()->json(['success'=>'Updated.']);
    }
}

  public function  ShowOrderDetails(Request $Request)
        {    
            
      $res=m::ShowOrderDetails($Request);
  
  return response()->json($res);
    
}


    public function  InsertOrder(Request $request)
        {    
           $validator = Validator::make($request->all(), [
                'phone1' => 'bail|required|digits:11',
            'city' => 'bail|required',
            'phone2' => 'bail|required|digits:11',
             'postcode' => 'bail|required',
             'address' => 'required',
             
]);




$userid=Auth::guard('customer')->id();


  if ($validator->passes()) 
  {

    DB::table('customers')->where('id',$userid)->update(
      ['phone1'=>$request->phone1,
        'phone2'=>$request->phone2,
        'city'=>$request->city,
        'postcode'=>$request->postcode,
        'address'=>$request->address,
 ]
    );


$res=m::InsertOrder($request);
if($res=='error'){
  Session::flash('error', 'Cannot Process Order'); 
   return redirect()->back();}
else{
  Session::flash('message', 'Order Successfully Added'); 
  return redirect('Profile');
}


  }
else{
        return redirect('Order')->withErrors($validator->errors());;
    } 

}




public function Paypal(Request $request){
    $validator = Validator::make($request->all(), [
                'phone1' => 'bail|required|digits:11',
            'city' => 'bail|required',
            'phone2' => 'bail|required|digits:11',
             'postcode' => 'bail|required',
             'address' => 'required',
             
]);



$userid=Auth::guard('customer')->id();


  if ($validator->passes()) 
  {


    if($request->alltot==0){
  Session::flash('error', 'Cannot Process Order'); 
   return redirect()->back();}


    DB::table('customers')->where('id',$userid)->update(
      ['phone1'=>$request->phone1,
        'phone2'=>$request->phone2,
        'city'=>$request->city,
        'postcode'=>$request->postcode,
        'address'=>$request->address,
 ]
    );


  
  $apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
  env('PAYPAL_CLIENT_ID'),
  env('PAYPAL_SECRET_ID')
  )
);

// Create new payer and method
$payer = new Payer();
$payer->setPaymentMethod("paypal");

// Set redirect URLs
$redirectUrls = new RedirectUrls();
$request->session()->put('data', $request->all());
$redirectUrls->setReturnUrl(route('process.paypal'))
  ->setCancelUrl(route('cancel.paypal'));

// Set payment amount
$amount = new Amount();
$amount->setCurrency("USD")
  ->setTotal($request->alltot);

// Set transaction object
$transaction = new Transaction();
$transaction->setAmount($amount)
  ->setDescription("Payment description");

// Create the full payment object
$payment = new Payment();
$payment->setIntent('sale')
  ->setPayer($payer)
  ->setRedirectUrls($redirectUrls)
  ->setTransactions(array($transaction));
// Create payment with valid API context
try {
  $payment->create($apiContext);

  // Get PayPal redirect URL and redirect the customer
  $approvalUrl = $payment->getApprovalLink();
return redirect($approvalUrl);
  // Redirect the customer to $approvalUrl
} catch (PayPal\Exception\PayPalConnectionException $ex) {
  echo $ex->getCode();
  echo $ex->getData();
  die($ex);
} catch (Exception $ex) {
  die($ex);
}

  }
else{
        return redirect('Order')->withErrors($validator->errors());;
    } 


}



public function RequestPaypal(Request $request){
  // Get payment object by passing paymentId
$paymentId = $request->paymentId;

$apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
  env('PAYPAL_CLIENT_ID'),
  env('PAYPAL_SECRET_ID')
  )
);

$payment = Payment::get($paymentId, $apiContext);
$payerId =$request->PayerID;

// Execute payment with payer ID
$execution = new PaymentExecution();
$execution->setPayerId($payerId);


try {
  // Execute payment
  $result = $payment->execute($execution, $apiContext);
$res=m::InsertOrder($request);
if($res=='error'){
  Session::flash('error', 'Cannot Process Order'); 
   return redirect()->back();}
else{
  Session::flash('message', 'Order Successfully Added'); 
  return redirect('Profile');
}
} catch (PayPal\Exception\PayPalConnectionException $ex) {
  echo $ex->getCode();
  echo $ex->getData();
  die($ex);
} catch (Exception $ex) {
  die($ex);
}
}
public function cancelPaypal(){
 Session::flash('error', 'Cannot Process Order'); 
   return redirect('/Order');
}

    public function  QuantityDown(Request $Request)
        {    
            
      $res=m::QuantityDown($Request);
      if($res=='error'){
         return response()->json(['error'=>'Limit Exceeds Avalaible Quantity']);
      }
        else{
  return response()->json(['success'=>'Updated.']);
    }
}


           public function  CartDelete(Request $Request)
        {    
            
      $res=m::CartDelete($Request);
  return response()->json(['success'=>'Deleted.']);
    }
    
   

   
   
}