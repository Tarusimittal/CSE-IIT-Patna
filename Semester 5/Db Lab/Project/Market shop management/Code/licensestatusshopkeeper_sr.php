<?php require('db.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" type ="text/css" href = "main.css">
    <title>All Licenses</title>
</head>
<body>
<style>
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
    <h1>All Licenses</h1>

    <table id = "users">
        <tr>
            <th>Shop ID</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>

        <?php
            $sql = "SELECT * FROM licenserequest where skid = $_POST['skid]";
            $result = mysqli_query($db, $sql);
            while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['sid'];?></td>
            <td><?php echo $row['IsApproved'];?></td>
            <td><?php if($row['IsApproved'] === 'approved'){ echo $row['lsdate']; }else{ echo "-"; }; ?></td>
            <td><?php if($row['IsApproved'] === 'approved'){ echo $row['ledate']; }else{ echo "-"; }; ?></td>
        </tr>
        <?php } ?>
    </table>


</div>



