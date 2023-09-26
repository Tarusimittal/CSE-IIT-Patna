<?php


if(empty($_SESSION['username'])) {
  header('location: login.php');
}

require_once('server.php');
$id=$_SESSION['id'];
$email=$_SESSION['email'];
if (isset($_POST['roomschosen'])){
  if(!empty($_POST['check_list'])){
  // Loop to store and display values of individual checked checkbox.

  foreach($_POST['check_list'] as $selected){
    if(!isset($s))
    $s=$selected;
    else {
    $s=$s.",".$selected;
    }
  }
  $dbc= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $update_status_query = "UPDATE bookings SET requestedrooms='$s' WHERE id='$id'";
  $update_status = mysqli_query($dbc, $update_status_query);
}
header("location: homepage.php");
}


?>
