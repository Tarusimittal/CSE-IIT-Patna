<?php 
    require_once('db.php');
    
    require_once('./template/navbar.php');
    
    if(!isset($_SESSION['username'])){
        header("Location: adminlogin.php" );
    }
    $sql = "SELECT gardenerid FROM gardener";
    $result = mysqli_query($db, $sql);

    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    // echo $url;
    $url_components = parse_url($url);
 
    
    parse_str($url_components['query'], $params);
    $gardenerid = $params['gardenerid'];

    $fires = null;
    if(isset($_POST['ViewDutySubmit'])){
        
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        if($gardenerid=='*'){   
            $getquery = "SELECT * FROM dutyroaster WHERE date BETWEEN '$startdate' AND '$enddate' ";
            $fires = mysqli_query($db, $getquery);
        }
        else{
        $getquery = "SELECT * FROM dutyroaster WHERE gardenerid='$gardenerid' and (date BETWEEN '$startdate' AND '$enddate' ) ";
        $fires = mysqli_query($db, $getquery);
        }
        
    }

    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    
    <title>Document</title>
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
        .red {
            border-top: 3px solid #DC143C;
        }
        .green {
            border-top: 3px solid #00A300;
        }
        .blue {
            border-top: 3px solid blue;
        }
    </style>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <h2>Display Roaster</h2>
<form action =<?php echo $url ?> method="post">

<div class="mb-3">
        <label for="Name" class="form-label">
                Start Date
        </label>
        <input type="date" name = "startdate" class="form-control" required>
</div>
<div class="mb-3">
        <label for="Name" class="form-label">
                End Date
        </label>
        <input type="date" name = "enddate" class="form-control" required>
</div>
<button type = "submit" class="btn btn-outline-primary" name = "ViewDutySubmit">
        Submit
</button>
<ul class="list-group">
<?php

if($gardenerid == '*'){
    if($fires != null){
        ?>
        <div class="wrapper0">
    <div class="wrapper1">
        <table id ="users">
            <tr><th>Date</th>
            <th>Gardener ID</th>
            <th>Area Name</th></tr>
            <?php  
        while($row = mysqli_fetch_array($fires)){ 
            ?> 
                 <tr>
                     <td><?php echo $row['date'];?></td>
                     <td><?php echo $row['gardenerid'];?></td>
                     <td><?php echo $row['areaname'];?></td>
                 </tr>
                    
        <?php }
        ?>
        
        </table>
        </div>
        </div>
        <?php
    }

}else {

    if($fires != null){
        ?>
        <div class="wrapper0">
    <div class="wrapper1">
    <table id ="users">
            <tr><th>Date</th>
            <th>Area Name</th></tr>
            <?php  
        while($row = mysqli_fetch_array($fires)){ 
            ?> 
                 <tr>
                     <td><?php echo $row['date'];?></td>
                     <td><?php echo $row['areaname'];?></td>
                 </tr>
                    <!-- // echo "<li class='list-group-item'>{$row['date']} :{$row['gardenerid']} : {$row['areaname']}   </li>"; -->
        <?php }
        ?>
        
        </table>
        </div>
        </div>
        <?php
    }}
    
?>
</ul>


 <!-- Option 1: Bootstrap Bundle with Popper -->
 <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
 <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
</body>
</html>