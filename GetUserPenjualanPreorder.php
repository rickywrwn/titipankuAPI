<?php
include("DbConnect.php");

$email = $_GET["email"];

$sql5 = "SELECT * FROM offerPreorder WHERE idPembeli ='$email' ORDER BY id DESC";
$result5 = mysqli_query($conn,$sql5);

$offers=array();
if(mysqli_num_rows($result5) > 0)
{
  while($row = $result5->fetch_assoc()) {
    $newDate = date("d F Y", strtotime($row["tglBeli"]));
    $newPrice = number_format((int)$row["hargaOngkir"]);
    $offer=array("id"=>$row["id"],"idPreorder"=>$row["idPreorder"],"idPembeli"=>$row["idPembeli"],"tglBeli"=>$newDate,"hargaOngkir"=>$newPrice,"valueHarga"=>$row["hargaOngkir"],"qty"=>$row["qty"],"idKota"=>$row["idKota"],"kota"=>$row["kota"],"pengiriman"=>$row["pengiriman"],"jenisOngkir"=>$row["jenisOngkir"],"nomorResi"=>$row["nomorResi"],"status"=>$row["status"]);
    array_push($offers,$offer);
      }
}

  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($offers);
?>
