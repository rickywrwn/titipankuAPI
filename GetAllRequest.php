<?php
include("DbConnect.php");

$email = $_GET["email"];
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn,$sql);

$user=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {
    $berat = $row["berat"];
    $ukuran = $row["ukuran"];
  }
}


if ($berat == '1'){
  if ($ukuran == "Kecil (20x20x20 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' AND ukuran = 'Kecil (20x20x20 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }else if ($ukuran == "Sedang ( 30x25x20 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' AND ukuran = 'Kecil (20x20x20 CM)' OR  ukuran = 'Sedang ( 30x25x20 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }else if ($ukuran == "Besar (35x22x55 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' AND ukuran = 'Kecil (20x20x20 CM)' OR  ukuran = 'Sedang ( 30x25x20 CM)' OR  ukuran = 'Besar (35x22x55 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }
}else if ($berat == '2'){
  if ($ukuran == "Kecil (20x20x20 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' OR berat = '2' AND ukuran = 'Kecil (20x20x20 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }else if ($ukuran == "Sedang ( 30x25x20 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' OR berat = '2' AND ukuran = 'Kecil (20x20x20 CM)' OR  ukuran = 'Sedang ( 30x25x20 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }else if ($ukuran == "Besar (35x22x55 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' OR berat = '2' AND ukuran = 'Kecil (20x20x20 CM)' OR  ukuran = 'Sedang ( 30x25x20 CM)' OR  ukuran = 'Besar (35x22x55 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }
}else if ($berat == '3'){
  if ($ukuran == "Kecil (20x20x20 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' OR berat = '2' OR berat = '3' AND ukuran = 'Kecil (20x20x20 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }else if ($ukuran == "Sedang ( 30x25x20 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' OR berat = '2' OR berat = '3'AND ukuran = 'Kecil (20x20x20 CM)' OR  ukuran = 'Sedang ( 30x25x20 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }else if ($ukuran == "Besar (35x22x55 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' OR berat = '2' OR berat = '3'AND ukuran = 'Kecil (20x20x20 CM)' OR  ukuran = 'Sedang ( 30x25x20 CM)' OR  ukuran = 'Besar (35x22x55 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }
}else if ($berat == '4'){
  if ($ukuran == "Kecil (20x20x20 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' OR berat = '2' OR berat = '3' OR berat = '4' AND ukuran = 'Kecil (20x20x20 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }else if ($ukuran == "Sedang ( 30x25x20 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' OR berat = '2' OR berat = '3' OR berat = '4' AND ukuran = 'Kecil (20x20x20 CM)' OR  ukuran = 'Sedang ( 30x25x20 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }else if ($ukuran == "Besar (35x22x55 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND berat = '1' OR berat = '2' OR berat = '3' OR berat = '4' AND ukuran = 'Kecil (20x20x20 CM)' OR  ukuran = 'Sedang ( 30x25x20 CM)' OR  ukuran = 'Besar (35x22x55 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }
}else if ($berat == '5'){
  if ($ukuran == "Kecil (20x20x20 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND ukuran = 'Kecil (20x20x20 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }else if ($ukuran == "Sedang ( 30x25x20 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' AND ukuran = 'Kecil (20x20x20 CM)' OR  ukuran = 'Sedang ( 30x25x20 CM)' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }else if ($ukuran == "Besar (35x22x55 CM)"){
    $sql = "SELECT * FROM postRequest WHERE status != '0' ORDER BY id DESC";
    $result = mysqli_query($conn,$sql);
  }
}



$app=array();
if(mysqli_num_rows($result) > 0)
{
  while($row = $result->fetch_assoc()) {

          $newDate = date("d F Y", strtotime($row["tglPost"]));
          $newPrice = number_format($row["price"],0,",",".");
          $request=array("id"=>$row["id"],"email"=>$row["email"],"name"=>$row["name"],"description"=>$row["description"],"category"=>$row["category"],"country"=>$row["country"],"price"=>$newPrice,"ImageName"=>$row["imageName"],"url"=>$row["url"],"qty"=>$row["qty"],"ukuran"=>$row["ukuran"],"berat"=>$row["berat"],"kotaKirim"=>$row["kotaKirim"],"idKota"=>$row["idKota"],"provinsi"=>$row["provinsi"],"tglPost"=>$newDate,"nomorResi"=>$row["nomorResi"],"status"=>$row["status"]);
          array_push($app,$request);
      }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($app);
?>
