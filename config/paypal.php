<?php


$apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
  env('PAYPAL_CLIENT_ID'),
  env('PAYPAL_SECRET_ID')
  )
);
