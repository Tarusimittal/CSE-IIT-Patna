<?php

include('db.php');

if(isset($_POST['accept'])) {
    $gid = $_POST['gardenerid'];
    $sdate = $_POST['startdate'];
    $edate = $_POST['enddate'];

$sql = "UPDATE holidayrequest set isApproved='approved' where gardenerid='$gid' and startdate='$sdate' and enddate='$edate'";

$result = mysqli_query($db, $sql);

    if($result){
        echo '<script type = "text/javascript">';
    echo 'alert("Approved!");';
    echo 'window.location.href = "approverequest.php"';
    echo '</script>';
    }
    else{
        echo mysqli_error($db);
    }
}else{
    $gid = $_POST['gardenerid'];
    $sdate = $_POST['startdate'];
    $edate = $_POST['enddate'];

$sql = "UPDATE holidayrequest set isApproved='denied' where gardenerid='$gid' and startdate='$sdate' and enddate='$edate'";

$result = mysqli_query($db, $sql);

    if($result){
        echo '<script type = "text/javascript">';
    echo 'alert("Denied!");';
    echo 'window.location.href = "approverequest.php"';
    echo '</script>';
    }
    else{
        echo mysqli_error($db);
    }
}

?>