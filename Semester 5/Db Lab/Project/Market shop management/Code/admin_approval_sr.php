<?php
require('db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" type ="text/css" href = "main.css">
    <title>License Request</title>
</head>
<body>
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


<div class="center">
    <h1>License Requests</h1>

    <table id = "users">
        <tr>
            <th>Shop-Id</th>
            <th>ShopKeeper-Id</th>
        </tr>

        <?php
            $query = "SELECT * FROM licenserequest";
            $result = mysqli_query($db, $query);
          
            while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['sid'];?></td>
            <td><?php echo $row['skid'];?></td>
            <td>
                <form action ="admin_approval_server_sr.php" method ="POST">
                    
                    <input type = "date" name= "lsdate" />
                    <input type = "date" name= "ledate" />
                    <input type = "text" name = "licensecharge" placeholder="enter license charges" />
                    <input type = "submit" name  ="approve" value = "approve"/>
                    <input type = "submit" name  ="deny" value = "decline"/>
                    <input type = "hidden" name  ="sid" value = "<?php echo $row['sid'];?>"/>
                    <input type = "hidden" name  ="skid" value = "<?php echo $row['skid'];?>"/>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

   
</div>

<!-- <?php

if(isset($_POST['approve'])){
    $sid = $_POST['sid'];

    $sql = "UPDATE shop SET approval = 'approved' WHERE sid = '$sid'";
    $result = mysqli_query($db, $sql);

    echo '<script type = "text/javascript">';
    echo 'alert("User Approved!");';
    echo 'window.location.href = "admin_approval.php"';
    echo '</script>';
}

if(isset($_POST['deny'])){
    $sid = $_POST['sid'];

    $sql = "DELETE FROM Shop WHERE sid = '$sid'";
    $result = mysqli_query($db, $sql);

    echo '<script type = "text/javascript">';
    echo 'alert("User Denied!");';
    echo 'window.location.href = "admin_approval.php"';
    echo '</script>';
}
?> -->
