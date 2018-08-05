<?php
include("DbConnect.php");

$email = $_GET["email"];

$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn,$sql);

$user=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {
          $newDate = date("d F Y", strtotime($row["tanggalDaftar"]));
          $newPrice = number_format($row["saldo"]);
          $user=array("email"=>$row["email"],"name"=>$row["name"],"bio"=>$row["bio"],"tanggalDaftar"=>$newDate,"saldo"=>$newPrice ,"valueSaldo"=>$row["saldo"]);
      }
}
// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($user);
?>
