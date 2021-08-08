<?php

include("DbConnect.php");
if(isset($_GET["action"]))
{
$email = $_GET['email'];
$nama = $_GET['nama'];
$berat = $_GET['berat'];
$ukuran = $_GET['ukuran'];
$sql2 = "UPDATE user SET name='$nama',ukuran='$ukuran',berat='$berat' WHERE email='$email'";
$result2 = mysqli_query($conn,$sql2);
if($result2){
$response = array('success' => 1,
       'message' => 'Edit Profile Sukses');
}



// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($response);
}
?>
