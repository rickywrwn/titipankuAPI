<html>
<head>
<!-- Firebase App is always required and must be first -->
 <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-app.js"></script>
 <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-messaging.js"></script>

 <script>
   // Initialize Firebase
   var config = {
     apiKey: "AIzaSyBz9QxKFnpiTsTeXwosVO5wJxSXDeNUw80",
     authDomain: "titipanku-d366a.firebaseapp.com",
     databaseURL: "https://titipanku-d366a.firebaseio.com",
     projectId: "titipanku-d366a",
     storageBucket: "titipanku-d366a.appspot.com",
     messagingSenderId: "992057371616"
   };



 </script>
</head>
<?php
include("DbConnect.php");

$today = date("Y-m-d");

$sql = "SELECT * FROM offerRequest WHERE status = '2' ";
$result = mysqli_query($conn,$sql);

$trips=array();
if(mysqli_num_rows($result) > 0)
{
while($row = $result->fetch_assoc()) {
$id = $row["id"];
$idRequest = $row["idRequest"];
$idPemilik = $row["idPemilik"];
$idPenawar = $row["idPenawar"];
$tglPost = $row["tglOffer"];
$hargaPenawaran = (int)$row["hargaPenawaran"];
$cekDate = date('Y-m-d', strtotime($tglPost. ' + 7 days'));
if($today >= $cekDate){
$sql2 = "UPDATE offerRequest SET status='0' WHERE id='$id' ";
$result2 = mysqli_query($conn,$sql2);
if($result2)
{
$sql2 = "UPDATE postRequest SET status='1' WHERE id='$idRequest' ";
$result2 = mysqli_query($conn,$sql2);
if($result2)
{

$sql = "SELECT * FROM user WHERE email = '$idPenawar' ";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0)
{
while($row = $result->fetch_assoc()) {
$device = $row["device"];

$url = "https://fcm.googleapis.com/fcm/send";
$array = array(
"to" => $device,
"notification" => array(
                      "title" => "Titipanku",
                      "body" => "Penawaranmu dibatalkan karena melewati 7 hari"
                    )
);
$content = json_encode($array);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
      array("Content-type: application/json","Authorization:key=AAAA5vs6K-A:APA91bGOYQeGh0640S3S-HrDJR8HY66jNrjQUKzC_WpXfjhRZQ-WObzw8Fu68MhZ975bJaKpFeh-8X6ZU8dHe7BJhUqHk_tc1GB-A4QSw4b89JdpLyBo0g-ZmxKThhKRVaMIJdchhWUw
"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

$json_response = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

$trip=array("email"=>$row["email"],"saldo"=>$row["saldo"]);
array_push($trips,$trip);
}
}
...

}
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($trips);
?>

</html>
