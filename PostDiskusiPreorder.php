<?php
if(isset($_GET["action"]))
{
  include("DbConnect.php");

  $action = $_GET["action"];
  $email = $_GET['email'];

  if($action == "insert"){

    //$password = md5($_GET["password"]);
    $isi = $_GET["isi"];
    $idPost = $_GET["idPost"];
    $today = date("Y-m-d");

    $sql1 = "INSERT INTO diskusiPreorder(idPost,email,isi,tanggal) VALUES ('$idPost','$email', '$isi', '$today')";
    $result1 = mysqli_query($conn,$sql1);
    if($result1)
    {
        $response = array('success' => 1,
                 'message' => 'Post Komentar Sukses');
    }
    else
    {
        $response = array('success' => 0,
                 'message' => 'Post Komentar Gagal');
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
}
?>
