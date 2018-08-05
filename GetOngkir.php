<?php
$origin = $_POST['origin'];
$destination = $_POST['destination'];
$weight = $_POST['weight'];

$curl = curl_init();

curl_setopt_array($curl, array(
 CURLOPT_URL => "http://rajaongkir.com/api/starter/cost",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => "",
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 30,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "POST",
 CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight",
 CURLOPT_HTTPHEADER => array(
 "key: 590ad699c8c798373e2053a28c7edd1e"
 ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
 echo "cURL Error #:" . $err;
} else {

 $data = json_decode($response, true);
}

?>
