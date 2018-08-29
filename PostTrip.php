<?php
if(isset($_GET["action"]))
{
  include("DbConnect.php");

  $action = $_GET["action"];
  $email = $_GET['email'];

if($action == "insert"){

    //$password = md5($_GET["password"]);
    $country = $_GET["country"];
    $tgl = $_GET["tgl"];

    $sql1 = "INSERT INTO postTrip(email,country,tanggalPulang,status) VALUES ('$email', '$country', '$tgl','1')";
    $result1 = mysqli_query($conn,$sql1);
    if($result1)
    {
        $response = array('success' => 1,
                 'message' => 'Post Trip Sukses');
    }
    else
    {
        $response = array('success' => 0,
                 'message' => 'Post Trip Gagal');
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
