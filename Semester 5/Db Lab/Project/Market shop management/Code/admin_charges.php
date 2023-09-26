<?php
require('db.php');
?>
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
<body>


<div class="center">
    <h1>Shop Charges</h1>

    <table id = "users">
        <tr>
            <th>Shop-Id</th>
            <th>ShopKeeper-Id</th>
            <th>Shop Name</th>
            <th>Address</th>
            <th>Contact</th>
            <th>License Start Date</th>
            <th>License End Date</th>
            <th>License Charges</th>
            <th>Other charges (Electricity + water)</th>
            <th>Pending Charges</th>
            <th>Action</th>
        </tr>

        <?php
            $query = "SELECT * FROM Shop WHERE approval = 'approved' ORDER BY sid ASC";
            $result = mysqli_query($db, $query);
            while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['sid'];?></td>
            <td><?php echo $row['skid'];?></td>
            <td><?php echo $row['sname'];?></td>
            <td><?php echo $row['address'];?></td>
            <td><?php echo $row['contact'];?></td>
            <td><?php if($row['licensestart']==NULL) echo 'Not Assigned'; else echo $row['licensestart'];?></td>
            <td><?php if($row['licenseend']==NULL) echo 'Not Assigned'; else echo $row['licenseend'];?></td>
            <td><?php echo $row['licensecharge'];?></td>
            <td><?php echo $row['charges'];?></td>
            <td><?php echo $row['pendingcharges'];?></td>
            <td>
                <form action ="updatecharges_sr.php" method ="POST">
                    <input type = "hidden" name  ="sid" value = "<?php echo $row['sid'];?>"/>
                    <input type = "submit" name  ="update" value = "Update"/>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>
