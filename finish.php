<?php
  include("DbConnect.php");

  $sql1 = "INSERT INTO midtrans(midtrans) VALUES ('finish')";
  $result1 = mysqli_query($conn,$sql1);
?>
