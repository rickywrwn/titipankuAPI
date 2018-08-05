<?php
include("DbConnect.php");

$sql2 = "SELECT * FROM masterNegara";
$result2 = mysqli_query($conn,$sql2);

$apps=array();
if(mysqli_num_rows($result2) > 0)
{
  while($row = $result2->fetch_assoc()) {

          $app=array("id"=>$row["id"],"nama"=>$row["nama"]);
          array_push($apps,$app);
      }
}

// headers to tell that result is JSON
header('Content-type: application/json');
echo json_encode($apps);
?>
