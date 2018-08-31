<?php
include("DbConnect.php");

$idRequest = $_GET['idRequest'];
$idTrip = $_GET['idTrip'];
$idPemilik = $_GET['idPemilik'];
$email = $_GET['email'];
$today = date("Y-m-d");

$sql1 = "UPDATE postTrip SET status='0' WHERE id='$idTrip'";
$result1 = mysqli_query($conn,$sql1);
if($result1)
{
$response = array('success' => 1,
         'message' => 'Update trip sukses');
}
else
{
$response = array('success' => 0,
         'message' => mysqli_error($conn));
}

$sql2 = "UPDATE offerRequest SET status='0' WHERE idRequest='$idRequest' AND status='1' AND idPenawar ='$email'";
$result2 = mysqli_query($conn,$sql2);
if($result2)
{
$response = array('success' => 1,
         'message' => 'Update penawaran 1 sukses');
}
else
{
$response = array('success' => 0,
         'message' => mysqli_error($conn));

}

$sql3 = "UPDATE offerRequest SET status='6' WHERE idRequest='$idRequest' AND status='3' AND idPenawar ='$email'";
$result3 = mysqli_query($conn,$sql3);
if($result3)
{
$response = array('success' => 1,
         'message' => 'Update penawaran 3 sukses');
}
else
{
$response = array('success' => 0,
         'message' => mysqli_error($conn));
}

$sql4 = "UPDATE offerRequest SET status='6' WHERE idRequest='$idRequest' AND status='2' AND idPenawar ='$email'";
$result4 = mysqli_query($conn,$sql4);
if($result4)
{
  $response = array('success' => 1,
           'message' => 'Update penawaran 2 sukses');
}
else
{
  $response = array('success' => 0,
           'message' => mysqli_error($conn));
}

$sql5 = "INSERT INTO notification(name,tanggal,jenis,idTujuan,email) VALUES ('Penawar Membatalkan Perjalanan', '$today','request','$idRequest','$idPemilik')";
$result5 = mysqli_query($conn,$sql5);
if($result5)
{
    $response = array('success' => 1,
             'message' => 'Insert Notif sukses');
}
else
{
    $response = array('success' => 0,
             'message' => mysqli_error($conn));

}

             // headers to tell that result is JSON
             header('Content-type: application/json');
             echo json_encode($response);
?>
