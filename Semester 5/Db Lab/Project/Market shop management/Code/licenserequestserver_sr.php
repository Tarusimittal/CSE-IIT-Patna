<?php
    
    include('db.php');

    $skid = $_POST['skid'];
    $sid = $_POST['sid'];
    $sql = "insert into licenserequest(skid,sid,isApproved) values('$skid', '$sid','pending')";
    $result = mysqli_query($db,$sql);

    if($result){
        echo "License request sent";
    }
    else{
        echo mysqli_error($db);
    }

?>