<?php
    
    include('db.php');

    $gid = $_POST['gardenerid'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];

    $sql = "insert into holidayrequest(gardenerid, startdate, enddate) values('$gid', '$startdate', '$enddate')";

    $result = mysqli_query($db,$sql);

    if($result){
        echo '<script type = "text/javascript">';
    echo 'alert("Holiday Request Sent!");';
    echo 'window.location.href = "requestholiday.php"';
    echo '</script>';;
    }else{
        echo mysqli_error($db);
    }



?>