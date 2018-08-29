<?php
if(isset($_GET["action"]))
{
  include("DbConnect.php");

  $action = $_GET["action"];

if($action == "insert"){

    $email = $_GET['email'];
    $jumlah = $_GET["jumlah"];
    $saldo = $_GET["saldo"];
    $status = $_GET["status"];
    $rekening = $_GET["rekening"];
    $namaRekening = $_GET["namaRekening"];
    $today = date("Y-m-d");

    $sql1 = "INSERT INTO topup(email,jumlah,saldo,status,orderId,tglTopup,jenis,rekening,namaRekening) VALUES ('$email', '$jumlah','$saldo','$status','','$today','Withdraw','$rekening','$namaRekening')";
    $result1 = mysqli_query($conn,$sql1);
    if($result1)
    {
      $sql2 = "UPDATE user SET saldo='$saldo' WHERE email='$email'";
      $result2 = mysqli_query($conn,$sql2);
      if($result2){
        $response = array('success' => 1,
                 'message' => 'Post Topup Sukses');
      }

    }
    else
    {
        $response = array('success' => 0,
                 'message' => mysqli_error($conn));
    }
  }


  // headers to tell that result is JSON
  header('Content-type: application/json');
  echo json_encode($response);
}
else
{
  $response = array(
           'message' => 'Tidak Bisa');
           echo json_encode($response);
}
?>
