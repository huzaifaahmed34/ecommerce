<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

public function paypal(){

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
$redirectUrls->setReturnUrl(route('process.paypal'))
  ->setCancelUrl(route('cancel.paypal'));

// Set payment amount
$amount = new Amount();
$amount->setCurrency("USD")
  ->setTotal(10);

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
public function returnPaypal(Request $request){
    $apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
  env('PAYPAL_CLIENT_ID'),
  env('PAYPAL_SECRET_ID')

  )
);

$paymentId = $request->paymentId;
$payment = Payment::get($paymentId, $apiContext);
$payerId = $request->PayerID;

// Execute payment with payer ID
$execution = new PaymentExecution();
$execution->setPayerId($payerId);

try {
  // Execute payment
  $result = $payment->execute($execution, $apiContext);
  dd($result);
} catch (PayPal\Exception\PayPalConnectionException $ex) {
  echo $ex->getCode();
  echo $ex->getData();
  die($ex);
} catch (Exception $ex) {
  die($ex);
}
}
public function cancelPaypal(){

}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
