<?php
include("DbConnect.php");

$email = $_GET["email"];

$sql5 = "SELECT * FROM offerRequest WHERE idPenawar ='$email' ORDER BY id DESC";
$result5 = mysqli_query($conn,$sql5);

$offers=array();
if(mysqli_num_rows($result5) > 0)
{
  while($row = $result5->fetch_assoc()) {
          $newDate = date("d F Y", strtotime($row["tglOffer"]));
          $newDate1 = date("d F Y", strtotime($row["tglPulang"]));
          $newPrice = number_format((int)$row["hargaPenawaran"],0,",",".");
          $offer=array("id"=>$row["id"],"idRequest"=>$row["idRequest"],"idPenawar"=>$row["idPenawar"],"tglOffer"=>$newDate,"hargaPenawaran"=>$newPrice,"valueHarga"=>$row["hargaPenawaran"],"tglPulang"=>$newDate1,"idKota"=>$row["idKota"],"kota"=>$row["kota"],"hargaOngkir"=>$row["hargaOngkir"],"jenisOngkir"=>$row["jenisOngkir"],"status"=>$row["status"]);
          array_push($offers,$offer);
      }
}

  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($offers);
?>
