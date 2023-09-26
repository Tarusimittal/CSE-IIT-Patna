<?php
    include('navbargardener.php');
    require('db.php');
    $var1 = $_SESSION['gardenerid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gardener</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
</head>
<body>
 <div class = "container">
  <div class = "header"> 
        <h2> Request Holidays </h2>
  </div>

  <form action = "requestholidayserver.php" method="post">
   <div class="mb-3">
        <label for="gardenerid" class="form-label" >GardenerID</label>
        <input type="text" name = "gardenerid" class="form-control" value = <?php echo $_SESSION['gardenerid']; ?> >
   </div>
   <div class="mb-3">
        <label for="StartDate" class="form-label">Start Date</label>
        <input type="date" name = "startdate" class="form-control" placeholder="enter date" required>
   </div>

   <div class="mb-3">
        <label for="StartDate" class="form-label">
               End Date
        </label>
        <input type="date" name = "enddate" class="form-control" placeholder="enter date" required>
   </div>
   <button type = "submit" class="btn btn-outline-primary" name = "gardenerdetailsubmit">Request holiday</button>
 </form>
<br><br><br>
 <table id = 'users'>
      <tr>
        <th>Request Id</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>
      </tr>
      <?php
      $sql2 = "SELECT * from `holidayrequest` where gardenerid = '$var1'" ;
      $result2= mysqli_query($db, $sql2);
      if(mysqli_num_rows($result2)==0){
        ?>
        <tr>
        <td>No Request Made</td>
        <td>Relax!</td>
        <td>Relax!</td>
        <td>Relax!</td>
      </tr>
      <?php } else {
      while($row2 = mysqli_fetch_assoc($result2)){
        ?>
        <tr>
        <td><?php echo $row2['hrid'] ?></td>
        <td><?php echo $row2['startdate'] ?></td>
        <td><?php echo $row2['enddate'] ?></td>
        <td><?php echo $row2['isApproved'] ?></td>
      </tr>
      <?php }} ?>
    </table>

</div>
</body>


</html>