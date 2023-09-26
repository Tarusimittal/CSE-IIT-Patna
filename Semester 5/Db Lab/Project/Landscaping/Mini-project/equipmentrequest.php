<?php
require('db.php');

require_once('./template/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Approval</title>
</head>
<style media="screen">
.wrapper0 {
  margin-right: 10%;
  margin-left: 10%; 
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  padding-bottom: 10px;
}
.wrapper1 {
  padding-right: 5%; 
  padding-left: 5%; 
  padding-bottom: 10px;
}
table{
    table-layout: fixed;
  width: 100%;
}
#users {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin-right: auto;
  margin-top: 20px;
  margin-left: auto; 
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;

}

#users th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: green;
  color: white;
}
#users td{
  padding-top: 12px;
  padding-bottom: 12px; 
  text-align: center;
}
#users td,
#users th {
  word-wrap: break-word;
  border: 1px solid #ddd;
}

#users tr:nth-child(even) {
  background-color: #f2f2f2;
}
#users tr:last-child td {
  border-bottom: 2px solid blue;
}
#users tr:hover {
  background-color: #ddd;
}
</style>
<body>

<div class="wrapper0">
    <div class="wrapper1">
    <h1>Equipment Repair Requests</h1>

    <table id = "users">
        <tr>
            <th>Request-ID</th>
            <th>Equipment-ID</th>
            <th>Gardener-ID</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
            $request_query1 = "SELECT * FROM equipmentrequest ORDER BY status ASC";
            $request_result1 = mysqli_query($db, $request_query1);

            while($request_row1 = mysqli_fetch_assoc($request_result1)){
        ?>
        <tr>
            <td><?php echo $request_row1['erid'];?></td>
            <td><?php echo $request_row1['equipmentid'];?></td>
            <td><?php echo $request_row1['gardenerid'];?></td>
            <td><?php if($request_row1['status']==0) echo 'Request Pending';
              else if($request_row1['status']==1) echo 'Approved! Work in Progress';
             else if($request_row1['status']==2) echo 'Declined';
              else if($request_row1['status']==3) echo 'Repaired';
            ?></td>
            <?php if($request_row1['status']==0){ ?>

            <td>
                <form action ="equipmentrequest.php" method ="POST">
                    <input type = "hidden" name  ="erid" value = "<?php echo $request_row1['erid'];?>"/>
                    <input type = "hidden" name  ="equipmentid" value = "<?php echo $request_row1['equipmentid'];?>"/>
                    <input type = "submit" name  ="approve" value = "Approve"/>
                    <input type = "submit" name  ="decline" value = "Decline"/>
                </form>
            </td>
          <?php }else if($request_row1['status']==1){?>
            <td><form action ="equipmentrequest.php" method ="POST">
                    <input type = "hidden" name  ="erid" value = "<?php echo $request_row1['erid'];?>"/>
                    <input type = "hidden" name  ="equipmentid" value = "<?php echo $request_row1['equipmentid'];?>"/>
                    <input type = "submit" name  ="repair" value = "Repair Completed"/>
                </form></td>

            <?php }else if($request_row1['status']==2){?>
            <td>Declined!</td>

            <?php }else{?>
            <td>Repaired</td>
        </tr>
      <?php }?>
      <?php
              }
              ?>
    </table>

            </div>
</div>

<?php

if(isset($_POST['approve'])){
    $erid = $_POST['erid'];
    $allot_equipmentid = $_POST['equipmentid'];
    $allot_select = "UPDATE equipmentrequest SET  status=1 WHERE erid = '$erid'";
    $allot_result = mysqli_query($db, $allot_select);
    $allot_select1 = "UPDATE equipment SET  status=0 WHERE equipmentid = '$allot_equipmentid'";
    $allot_result1 = mysqli_query($db, $allot_select1);

    echo '<script type = "text/javascript">';
    echo 'alert("Equipment Request Approved!");';
    echo 'window.location.href = "equipmentrequest.php"';
    echo '</script>';
}
if(isset($_POST['decline'])){
    $erid = $_POST['erid'];
    $allot_equipmentid = $_POST['equipmentid'];
    $allot_select = "UPDATE equipmentrequest SET  status=2 WHERE erid = '$erid'";
    $allot_result = mysqli_query($db, $allot_select);

    echo '<script type = "text/javascript">';
    echo 'alert("You declined the equipment request!");';
    echo 'window.location.href = "equipmentrequest.php"';
    echo '</script>';
}

if(isset($_POST['repair'])){
    $erid = $_POST['erid'];
    $allot_equipmentid = $_POST['equipmentid'];
    $allot_select = "UPDATE equipmentrequest SET  status=3 WHERE erid = '$erid'";
    $allot_result = mysqli_query($db, $allot_select);
    $allot_select1 = "UPDATE equipment SET  status=1 WHERE equipmentid = '$allot_equipmentid'";
    $allot_result1 = mysqli_query($db, $allot_select1);

    echo '<script type = "text/javascript">';
    echo 'alert("Equipment repaired!");';
    echo 'window.location.href = "equipmentrequest.php"';
    echo '</script>';
}

?>
