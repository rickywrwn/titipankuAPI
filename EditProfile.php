<?php

include("DbConnect.php");
if(isset($_GET["action"]))
{
$email = $_GET['email'];
$nama = $_GET['nama'];
$sql2 = "UPDATE user SET name='$nama' WHERE email='$email'";
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
