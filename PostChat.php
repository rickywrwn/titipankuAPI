<?php
if(isset($_GET["action"]))
{
  include("DbConnect.php");

  $action = $_GET["action"];
  $emailA = $_GET['emailA'];
  $emailB = $_GET['emailB'];

if($action == "insert"){

  $today = date("Y-m-d");

    $sql1 = "INSERT INTO chatroom(emailA,emailB,tanggal) VALUES ('$emailA', '$emailB', '$today')";
    $result1 = mysqli_query($conn,$sql1);
    if($result1)
    {
        $response = array('success' => 1,
                 'message' => 'Chat Sukses');
    }
    else
    {
        $response = array('success' => 0,
                 'message' => 'Chat Gagal');
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
