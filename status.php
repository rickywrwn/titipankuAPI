<?php
include("DbConnect.php");
// Set your server key (Note: Server key for sandbox and production mode are different)
$server_key = 'U0ItTWlkLXNlcnZlci1Ld1p5c3lOTF80d0hGSURJOGtwNG9VWDA6';
// Set true for production, set false for sandbox

$idCek = $_GET["id"];
$api_url ='https://api.sandbox.midtrans.com/v2/'.$idCek.'/status';

echo chargeAPI($api_url, $server_key);

/**
 * call charge API using Curl
 * @param string  $api_url
 * @param string  $server_key
 * @param string  $request_body
 */
function chargeAPI($api_url, $server_key){
  $ch = curl_init();
  $curl_options = array(
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => 1,
    // Add header to the request, including Authorization generated from server key
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Accept: application/json',
      'Authorization: U0ItTWlkLXNlcnZlci1Ld1p5c3lOTF80d0hGSURJOGtwNG9VWDA6'
    )
  );
  curl_setopt_array($ch, $curl_options);
  $result = curl_exec($ch);
  return $result;
}
