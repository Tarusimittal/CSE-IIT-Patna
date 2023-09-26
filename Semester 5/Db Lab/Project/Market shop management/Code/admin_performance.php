<?php require('db.php');session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" type ="text/css" href = "main.css">
    <title>Admin Charges</title>
</head>
<style media="screen">

#users {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#users td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#users tr:nth-child(even){background-color: #f2f2f2;}

#users tr:hover {background-color: #ddd;}

#users th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
  text-align: center;
}
</style>
<?php
$grade_row=[];
if(isset($_POST['submit'])){
    $grade_sid = $_POST['sid'];
    $grade_dt = $_POST['Category'];
    $grade_select = "SELECT * FROM `performance` WHERE `sid` = '$grade_sid' and dated='$grade_dt'";
    $grade_result = mysqli_query($db, $grade_select);
    $grade_row = mysqli_fetch_array($grade_result);
    echo $grade_row['grade'];

} 
else {
    echo "NULL";
}
?>
<body>

<div class="center">

    <form class="form" action="admin_performance.php" method="post">
        <h1 class="login-title">Grade the Shop</h1>
        <input type="text" class="login-input" name="insert_sid" placeholder="Enter the Shop ID" required />
        <input type="date" class="login-input" name="insert_date" placeholder="Enter Date" required />
        <input type="text" class="login-input" name="insert_grade" placeholder="Enter Grade" required>
        <input type="submit" name="submit" value="Grade" class="login-button">
    </form>


</div>
<?php
if (isset($_REQUEST['insert_sid'])) {
    $insert_sid = $_REQUEST['insert_sid'];
    $insert_date=$_REQUEST['insert_date'];
    $insert_grade =$_REQUEST['insert_grade'];

    $insert_query    = "INSERT into `performance` VALUES ('$insert_sid','$insert_date','$insert_grade')";

    $insert_result   = mysqli_query($db, $insert_query);
    echo '<script type = "text/javascript">';
    echo 'alert("Graded!");';
    echo 'window.location.href = "admin_performance.php"';
    echo '</script>';
}

?>
