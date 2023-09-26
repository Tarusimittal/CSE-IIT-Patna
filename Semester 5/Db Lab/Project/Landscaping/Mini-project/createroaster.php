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

    if(isset($_POST['DutySubmit'])){
        $gardenerid = $_POST['gardenerid'];
        $area = $_POST['area'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $table = "roster";

        $begin = new DateTime($startdate);
        $end = new DateTime($enddate);

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        $holidayquery = "SELECT holiday FROM gardener WHERE gardenerid='$gardenerid'";
        $holidayres = mysqli_query($db, $holidayquery);
        $holidayrow = mysqli_fetch_array($holidayres);
        $holiday = $holidayrow['holiday'];

        foreach ($period as $dt) {
            $dateform = $dt->format('Y-m-d'); 

            $holidayinsert = "INSERT INTO dutyroaster VALUES('$gardenerid','$dateform','$holiday')";
            $insertquery = "INSERT INTO dutyroaster VALUES('$gardenerid','$dateform','$area')";
            echo mysqli_error($db);
            $MyGivenDateIn = strtotime($dateform);
            $ConverDate = date("l", $MyGivenDateIn);
            $ConverDateTomatch = strtolower($ConverDate);

            if($ConverDateTomatch == $holiday ){
                mysqli_query($db, $holidayinsert);
            } else {
                $res = mysqli_query($db, $insertquery);

            if($res){
                $updateQuery = "UPDATE gardener SET workingarea='$area' WHERE gardenerid='$gardenerid'";
                $ures = mysqli_query($db,$updateQuery);
            }
            else{
                echo mysqli_error($db);
            }
            }


            
        }

        unset($_POST['DutySubmit']);

        

        
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
    
    
        
<form action = "createroaster.php" method="post">

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
<div class="mb-3">
        <label for="Name" class="form-label">
                Area
        </label>
        <input type="text" name = "area" class="form-control" required>
</div>
<div class="mb-3">
        <label for="address" class="form-label">
                GardenerID
        </label>
        <input type="number" name = "gardenerid" class="form-control" required>
</div>
<button type = "submit" class="btn btn-outline-primary" name = "DutySubmit">
        Submit
</button>
 <!-- Option 1: Bootstrap Bundle with Popper -->
 <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
 <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
</body>
</html>