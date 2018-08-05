<?php
include("DbConnect.php");

$sql2 = "SELECT * FROM masterNegara";
$result2 = mysqli_query($conn,$sql2);

$negara=array();
if(mysqli_num_rows($result2) > 0)
{
  while($row = $result2->fetch_assoc()) {

          $app=array("id"=>$row["id"],"nama"=>$row["nama"]);
          array_push($negara,$app);
      }
}

$sql3 = "SELECT * FROM masterKategori";
$result3 = mysqli_query($conn,$sql3);

$kategori=array();
if(mysqli_num_rows($result3) > 0)
{
  while($row = $result3->fetch_assoc()) {

          $app=array("id"=>$row["id"],"nama"=>$row["nama"]);
          array_push($kategori,$app);
      }
}

$categories1 = array("name"=>"Kategori","isi"=>$kategori);
$categories2 = array("name"=>"Negara","isi"=>$negara);
$explore = array();
array_push($explore,$categories2);
array_push($explore,$categories1);

$body = array("explore"=>$explore);
// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($body);
?>
