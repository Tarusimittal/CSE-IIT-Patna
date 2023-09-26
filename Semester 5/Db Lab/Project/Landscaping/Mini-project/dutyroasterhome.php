<?php 
    require_once('db.php');
    
    require_once('./template/navbar.php');
    
    
    if(!isset($_SESSION['username'])){
        header("Location: adminlogin.php" );
    }
    $sql = "SELECT gardenerid FROM gardener";
    $result = mysqli_query($db, $sql);

    $gardenerids = array();

    while($row = mysqli_fetch_array($result)){
        array_push($gardenerids, $row['gardenerid']);
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
    <style>
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
    
    
    <li class='list-group-item'> <a href="/Mini-project/createroaster.php">Assign Duties</a></li>
    <br>
    <li class='list-group-item'><a href="/Mini-project/areawise.php">Check Area Wise Details</a></li>
    <br>
   <?php $all = '*';
   echo "<li class='list-group-item'> <a href='/Mini-project/displayroaster.php?gardenerid={$all}'>Display Duty Roaster For All gardeners</a> </li>";
   ?>
   <br>
   <br>

    <h4>Check Individual Gardener Duty Details</h4>
<br>
    <ul class="list-group">
        <?php 
            foreach($gardenerids as $ID){
                echo "<li class='list-group-item'> <a href='/Mini-project/displayroaster.php?gardenerid={$ID}'>Gardener ID: {$ID}</a> </li>";
            }
            ?>
        
</ul>
 <!-- Option 1: Bootstrap Bundle with Popper -->
 <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
 <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
</body>
</html>