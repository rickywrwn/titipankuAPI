<?php
include("DbConnect.php");

$email = $_GET["email"];

$sql = "SELECT * FROM postPreorder WHERE email='$email' AND batasWaktu = '1' ORDER BY id DESC";
$result = mysqli_query($conn,$sql);

$app=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {

          $newDate = date("d F Y", strtotime($row["tglPost"]));
          $newDate1 = date("d F Y", strtotime($row["tglPost"]));
          $newPrice = number_format($row["price"]);
          $request=array("id"=>$row["id"],"email"=>$row["email"],"name"=>$row["name"],"description"=>$row["description"],"category"=>$row["category"],"country"=>$row["country"],"price"=>$newPrice,"ImageName"=>$row["imageName"],"url"=>$row["url"],"qty"=>$row["qty"],"berat"=>$row["berat"],"kotaKirim"=>$row["kotaKirim"],"idKota"=>$row["idKota"],"provinsi"=>$row["provinsi"],"tglPost"=>$newDate1,"status"=>$row["status"],"deadline"=>$newDate,"batasWaktu"=>$row["batasWaktu"],"valueHarga"=>$row["price"],"brand"=>$row["brand"]);
          array_push($app,$request);
      }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($app);
?>
