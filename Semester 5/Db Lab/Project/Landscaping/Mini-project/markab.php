<?php
require_once('db.php');

if(isset($_POST['id'])){
$id = $_POST['id'];
$date = date("y-m-d");
$markpressql = "INSERT into attendance values('$id','$date',0)";
$result = mysqli_query($db, $markpressql);
if($result){
// header("Location: attendance.php" );
}
else{
    echo mysqli_error($db);
}
}
?>