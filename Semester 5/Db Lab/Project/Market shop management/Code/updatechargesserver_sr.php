<?php

include('db.php');

echo "hi";
$skid= $_POST['skid'];
$sid= $_POST['sid'];
$amount= $_POST['amount'];


$query  = "SELECT * FROM Shop WHERE skid=$skid and sid=$sid";
$result = mysqli_query($db, $query);
$rows = mysqli_fetch_assoc($result);
        // echo $rows['skid'];
$rows['charges'] += $amount;
$rows['pendingcharges'] += $amount;

        // echo $rows['charges'];
$charges = $rows['charges'];
$pendingcharges = $rows['pendingcharges'];

    

$sql = "UPDATE Shop set charges=$charges, pendingcharges = $pendingcharges 
where sid ='$sid' and skid='$skid'";

$result = mysqli_query($db, $sql);
        
        if ($result) {
            echo "charges updated";
        } 
        else {
            echo "Failed";
        
    }

?>