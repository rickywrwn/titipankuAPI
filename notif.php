
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

$idTujuan = $_GET["idTujuan"];
$pesan = $_GET["pesan"];

$query = "SELECT device FROM user where email = '$idTujuan'";
$hasil =  mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($hasil);
$device=$row['device'];

$url = "https://fcm.googleapis.com/fcm/send";
$array = array(
  "to" => $device,
  "notification" => array(
                        "title" => "Titipanku",
                        "body" => $pesan
                      )
);
$content = json_encode($array);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json","Authorization:key=AAAA5vs6K-A:APA91bGOYQeGh0640S3S-HrDJR8HY66jNrjQUKzC_WpXfjhRZQ-WObzw8Fu68MhZ975bJaKpFeh-8X6ZU8dHe7BJhUqHk_tc1GB-A4QSw4b89JdpLyBo0g-ZmxKThhKRVaMIJdchhWUw"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

$json_response = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ( $status != 201 ) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}


curl_close($curl);

$response = json_decode($json_response, true);

header('Content-type: application/json');
echo json_encode($json_response);
?>
</html>
