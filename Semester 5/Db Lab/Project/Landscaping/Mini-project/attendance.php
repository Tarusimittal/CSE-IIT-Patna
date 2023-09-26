<?php 
    require_once('db.php');
    require_once('./template/navbar.php');
    $sql = "SELECT gardenerid FROM gardener";
    $result = mysqli_query($db, $sql);
    // $row = mysqli_fetch_array($result);
    // echo mysqli_error($db);
    // echo strval(mysqli_num_rows($result))." ";
    $tomark = array();
    $present = array();
    $absent = array();
    $date = date("y-m-d");
    while($row = mysqli_fetch_array($result)){
        $query = "SELECT * from attendance WHERE date='$date' and gardenerid={$row['gardenerid']} ";
        $resultMark = mysqli_query($db,$query);
        $markRow = mysqli_fetch_array($resultMark);


        if(mysqli_num_rows($resultMark) == 0){
            array_push($tomark,$row['gardenerid']);
        }
        else if($markRow['mark'] == 1){
            array_push($present,$row['gardenerid']);
        }
        else{
            array_push($absent,$row['gardenerid']);
        }
    }

    

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
    <title>Document</title>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function markFunction(id,bl){
            console.log(bl);
            if(bl == 1){
                console.log("inside");
                $.post( "http://localhost/Mini-project/markpres.php", { id: id } );
            }
            else{
                console.log("ab");
                $.post( "http://localhost/Mini-project/markab.php", { id: id } );
            }

            window.location.reload();
        }
    </script>
    <table>
        <tr>
            <th>mark</th>
            <th>present</th>
            <th>absent</th>
        </tr>
        <tr>
            <td>
                <?php 
                    foreach($tomark as $mark){
                        $valsql = "SELECT * FROM gardener WHERE gardenerid='$mark'";
                        $valquery = mysqli_query($db, $valsql);
                        $valrow = mysqli_fetch_array($valquery);
                        $one = "1";
                        $zero = "0";
                        echo "<div class='card' style='width: 18rem;'>
                        <div class='card-body'>
                          <h5 class='card-title'>{$valrow['name']}</h5>
                          <button onclick='markFunction({$mark},{$one});' style='border:2px solid black;background-color:green;'>Present</button>
                          <button onclick='markFunction({$mark},{$zero});' style='border:2px solid black;background-color:red'>Absent</button>
                        </div>
                      </div>";
                    }
                ?>
            </td>
            <td>
                <?php 
                    foreach($present as $val){
                        $valsql = "SELECT * FROM gardener WHERE gardenerid='$val'";
                        $valquery = mysqli_query($db, $valsql);
                        $valrow = mysqli_fetch_array($valquery);
                        $one = 1;
                        $zero = 0;
                        echo "<div class='card' style='width: 18rem;'>
                        <div class='card-body'>
                          <h5 class='card-title'>{$valrow['name']}</h5>
                          </div>
                      </div>";
                    }
                ?>
            </td>
            <td>
                <?php 
                    foreach($absent as $val){
                        $valsql = "SELECT * FROM gardener WHERE gardenerid='$val'";
                        $valquery = mysqli_query($db, $valsql);
                        $valrow = mysqli_fetch_array($valquery);
                        echo "<div class='card' style='width: 18rem;'>
                        <div class='card-body'>
                          <h5 class='card-title'>{$valrow['name']}</h5>
                          </div>
                      </div>";
                    }
                ?>
            </td>
        </tr>
    </table>
<script>

src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></scrip>   
</body>
</html>

<!-- if(bl){
        $markpressql = "INSERT into attendance values('$id','$date',1)";
        $result = mysqli_query($db, $markpressql);
    }
    else{
        $markpressql = "INSERT into attendance values('$id','$date',0)";
        $result = mysqli_query($db, $markpressql);
    } -->