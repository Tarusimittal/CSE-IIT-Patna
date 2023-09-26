<?php
require_once('db.php');
session_start();
// if(!isset($_SESSION['username'])){
//         header("Location: adminlogin.php" );
// }
$id;
$sdate;
$edate;
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
<body>

<?php 
        $area = null;
        if(isset($_POST['area'])){
                $area = $_POST['area'];
        }
?>

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
    <h1>Shops</h1>
    <form action = "shoplist.php" method = "POST">
        <br/><h5>Area Filter :</h5>
        <input type = "text" name = 'area' value = <?php echo "{$area}";?>>
        <input type = "submit" name = 'areasubmit'>
    </form>
    <table id = "users" >


        <tr>
            <th>ShopID</th>
            <th>ShopkeeperID</th>
            <th>Shop Name</th>
            <th>Address</th>
            <th>License start</th>
            <th>License end</th>
            <th>License Charge</th>
            <th>Charge</th>
            <th>Pending Charges</th>
            <th>Approval</th>
            
        </tr>

        <?php
            $sql = "SELECT * FROM shop";
            if(isset($area) and $area !== ''){
                $sql = "select * from shop where address = '$area'";
            }

            $result = mysqli_query($db, $sql);

            while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $row['sid'];?></td>
            <td><?php echo $row['skid'];?></td>
            <td><?php echo $row['sname'];?></td>
            <td><?php echo $row['address'];?></td>
            <td><?php echo $row['licensestart'];?></td>
            <td><?php echo $row['licenseend'];?></td>
            <td><?php echo $row['licensecharge'];?></td>
            <td><?php echo $row['charges'];?></td>
            <td><?php echo $row['pendingcharges'];?></td>
            <td><?php echo $row['approval'];?></td>

        </tr>
        <?php
    }
    ?>
    </table>


</div>


