<?php
if(isset($_GET["action"]))
{
  include("DbConnect.php");

  $action = $_GET["action"];

if($action == "insert"){


  $email = $_GET['email'];
  $rating = $_GET['rating'];
  $review = $_GET['review'];

    $sql1 = "INSERT INTO reviewUser(rating,review,email) VALUES ('$rating', '$review', '$email')";
    $result1 = mysqli_query($conn,$sql1);
    if($result1)
    {
        $response = array('success' => 1,
                 'message' => 'Post Review Sukses');
    }
    else
    {
        $response = array('success' => 0,
                 'message' => 'Post Review Gagal');
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
