<?php
include("DbConnect.php");

  //upload gambar di xcode pake post
if(isset($_GET["action"]))
{
  $action = $_GET["action"];

    if($action == "cancel"){
      $idRequest = $_GET['idRequest'];
      $sql4 = "UPDATE postRequest SET status='0'WHERE id='$idRequest'";
      $result4 = mysqli_query($conn,$sql4);
      if($result4)
      {
        $response = array('success' => 1,
               'message' => 'Berhasil Membatalkan Permintaan');
      }
      else
      {
          $response = array('success' => 0,
                   'message' => mysqli_error($conn));
      }


    // headers to tell that result is JSON
    header('Content-type: application/json');
    echo json_encode($response);
    }
}
else
{
  $response = array(
           'message' => 'Tidak Bisa');
           echo json_encode($response);
}
?>
