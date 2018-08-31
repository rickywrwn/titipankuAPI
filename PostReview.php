<?php
if(isset($_GET["action"]))
{
  include("DbConnect.php");

  $action = $_GET["action"];

if($action == "insert"){


  $email = $_GET['email'];
  $rating = $_GET['rating'];
  $review = $_GET['review'];
  $reviewer = $_GET['reviewer'];

    $sql1 = "INSERT INTO reviewUser(rating,review,email,reviewer) VALUES ('$rating', '$review', '$email','$reviewer')";
    $result1 = mysqli_query($conn,$sql1);
    if($result1)
    {
        $response = array('success' => 1,
                 'message' => 'Post Review Sukses');
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
