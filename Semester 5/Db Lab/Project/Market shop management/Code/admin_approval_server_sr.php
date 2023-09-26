<?php

include('db.php');
session_start();

$skid= $_POST['skid'];
$sid= $_POST['sid'];
$licensecharge= $_POST['licensecharge'];


if(isset($_POST['approve'])){
    $lsdate=$_POST['lsdate'];
    $ledate=$_POST['ledate'];
    $sql = "UPDATE shop set approval='approved',licensestart='$lsdate',
    licenseend='$ledate',licensecharge='$licensecharge',pendingcharges='$licensecharge' 
    where sid='$sid' and skid='$skid'";

    $result = mysqli_query($db, $sql);
        if ($result) {
            echo "License Approved";
        } 
        else {
            echo mysqli_connect_error(db);
        }

        $sql = "delete from licenserequest where sid = {$sid}";

        $result = mysqli_query($db, $sql);
            
            if ($result) {
                echo "License Denied";
            } 
            else {
                echo "Failed";
            }
}
else{
    $skid = $_POST['skid'];
    $sid = $_POST['sid'];

    $sql = "UPDATE Shop set approval='declined' where sid='$sid' and skid='$skid'";

    $result = mysqli_query($db, $sql);
        
        if ($result) {
            echo "License Denied";
        } 
        else {
            echo "Failed";
        }

        $sql = "delete from licenserequest where sid = {$sid}";

    $result = mysqli_query($db, $sql);
        
        if ($result) {
            echo "License Denied";
        } 
        else {
            echo "Failed";
        }
}
?>