<?php
include("DbConnect.php");

$negara = $_GET["negara"];

$sql = "SELECT * FROM postPreorder WHERE status != '0' AND status != '5' AND country = '$negara' AND batasWaktu='1' ORDER BY id DESC";
$result = mysqli_query($conn,$sql);

$app=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {

          $newDate = date("d F Y", strtotime($row["tglPost"]));
          $newDate1 = date("d F Y", strtotime($row["tglPost"]));
          $newPrice = number_format($row["price"],0,",",".");
          $request=array("id"=>$row["id"],"email"=>$row["email"],"name"=>$row["name"],"description"=>$row["description"],"category"=>$row["category"],"country"=>$row["country"],"price"=>$newPrice,"ImageName"=>$row["imageName"],"url"=>$row["url"],"qty"=>$row["qty"],"berat"=>$row["berat"],"kotaKirim"=>$row["kotaKirim"],"idKota"=>$row["idKota"],"provinsi"=>$row["provinsi"],"tglPost"=>$newDate1,"status"=>$row["status"],"deadline"=>$newDate,"batasWaktu"=>$row["batasWaktu"],"cdText"=>$row["cdText"],"cdValue"=>$row["cdValue"],"brand"=>$row["brand"]);
          array_push($app,$request);
      }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($app);
?>
