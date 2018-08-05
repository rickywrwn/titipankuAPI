<?php
include("DbConnect.php");

$idOffer = $_GET["idOffer"];

$sql1 = "SELECT * FROM offerRequest WHERE id = '$idOffer'";
$result1 = mysqli_query($conn,$sql1);
$offer = array();
if(mysqli_num_rows($result1) > 0)
{

  while($row = $result1->fetch_assoc()) {
    $newDate = date("d F Y", strtotime($row["tglOffer"]));
    $newDate1 = date("d F Y", strtotime($row["tglPulang"]));
    $newPrice = number_format($row["hargaPenawaran"]);
    $offer=array("id"=>$row["id"],"idPenawar"=>$row["idPenawar"],"tglOffer"=>$newDate,"hargaPenawaran"=>$newPrice,"valueHarga"=>$row["hargaPenawaran"],"tglPulang"=>$newDate1,"idKota"=>$row["idKota"],"kota"=>$row["kota"],"status"=>$row["status"]);
  }

          // headers to tell that result is JSON
          header('Content-type: application/json');
          echo json_encode($offer);
}else{
  $response = array('success' => 0,
           'message' => 'tidak ada request');
  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($response);
}
?>
