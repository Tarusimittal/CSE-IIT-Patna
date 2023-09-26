<?php 
    require_once('db.php');
    
    require_once('./template/navbar.php');
    
    
    if(!isset($_SESSION['username'])){
        header("Location: adminlogin.php" );
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
</head>
<body>
<?php 
        $area = null;
        $date = 01-01-2000;
        if(isset($_POST['area'])){
                $area = $_POST['area'];
        }
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }

        ?>

        <div class="center">
    <h1>Area Wise Gardener Id's</h1>
    <form action = "areawise.php" method = "POST">
        <br/><h5>Area Filter :</h5>
        <input type = "text" name = 'area' value = <?php echo "{$area}";?>>
        <input type = "date" name = 'date' value = <?php echo "{$date}";?>>
        <input type = "submit" name = 'areasubmit'>
    </form>

    <div class="wrapper0">
    <div class="wrapper1">
    <table id = "users" >
        <tr>
            <th>GardenerID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Contact No</th>
            <th>Date Of Joining</th>
            <th>Date Of Birth</th>
            <th>Address</th>
            <th>Gender</th>
            
        </tr>

        <?php
            $sql = "SELECT * FROM dutyroaster where gardenerid = 0";
            if(isset($area) and $area !== ''){ 
                $sql = "select * from dutyroaster where areaname = '$area' and date = '$date'";
            }

            $result = mysqli_query($db, $sql);

            while($row = mysqli_fetch_assoc($result)){
                $sql1 = "SELECT * FROM gardener WHERE gardenerid={$row['gardenerid']}";
                $result1 = mysqli_query($db, $sql1);
                $row1 = mysqli_fetch_assoc($result1);
        ?>
        <tr>
            <td><?php echo $row1['gardenerid'];?></td>
            <td><?php echo $row1['username'];?></td>
            <td><?php echo $row1['name'];?></td>
            <td><?php echo $row1['contactno'];?></td>
            <td><?php echo $row1['doj'];?></td>
            <td><?php echo $row1['dob'];?></td>
            <td><?php echo $row1['address'];?></td>
            <td><?php echo $row1['gender'];?></td>

        </tr>
        <?php
                }
                ?>
    </table>
            </div>
            </div>


</div>