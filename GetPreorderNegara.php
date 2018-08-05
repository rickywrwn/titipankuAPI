<?php
include("DbConnect.php");

$negara = $_GET["negara"];
$sql2 = "SELECT * FROM postPreorder where batasWaktu = '0' AND country='$negara'";
$result2 = mysqli_query($conn,$sql2);

$apps=array();
if(mysqli_num_rows($result2) > 0)
{
  while($row = $result2->fetch_assoc()) {

          $newDate = date("d F Y", strtotime($row["deadline"]));
          $newDate1 = date("d F Y", strtotime($row["tglPost"]));
          $newPrice = number_format($row["price"]);
          $app=array("id"=>$row["id"],"email"=>$row["email"],"name"=>$row["name"],"description"=>$row["description"],"category"=>$row["category"],"country"=>$row["country"],"price"=>$newPrice,"ImageName"=>$row["imageName"],"url"=>$row["url"],"qty"=>$row["qty"],"berat"=>$row["berat"],"kotaKirim"=>$row["kotaKirim"],"idKota"=>$row["idKota"],"provinsi"=>$row["provinsi"],"tglPost"=>$newDate1,"status"=>$row["status"],"deadline"=>$newDate,"batasWaktu"=>$row["batasWaktu"],"valueHarga"=>$row["price"],"brand"=>$row["brand"]);
          array_push($apps,$app);
      }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($apps);
?>
