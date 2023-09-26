<?php
    include('server.php');
    include('templates/navbar.php');
    if(empty($_SESSION['username'])) {
        header('location: login.php');
    }
    $id = null;
    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM bookings WHERE id='$id'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    $days = (strtotime($row['departure']) - strtotime($row['arrival'])) / (60*60*24);
    // echo $days;
    $vegprice = 40;
    $nonvegprice = 50;
    $breakfastvegPrice = $row['vegbreakfast']*$days*($vegprice);
    $lunchvegPrice = $row['veglunch']*$days*($vegprice);
    $dinnervegPrice = $row['vegdinner']*$days*($vegprice);
    $breakfastnonPrice = $row['nonvegbreakfast']*$days*($nonvegprice);
    $lunchnonnonPrice = $row['nonveglunch']*$days*($nonvegprice);
    $dinnernonPrice = $row['nonvegdinner']*$days*($nonvegprice);
    $roomPrice;
    if($row['accomodation'] == "Normal"){
      $roomPrice = 250*$row['number_rooms'];
    }
    else{
      $roomPrice = 350*$row['number_rooms'];
    }
    // echo $breakfastvegPrice;


?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
body{
    width: 100%;
    overflow-x:hidden;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 80%;
  margin-top:10px;
  margin-left: 10%;
  margin-right: 10%;
  border: 1px solid #dddddd;
  border-radius:10px;
}




td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

/* table th:first-child {
  -moz-border-radius: 20px 0 0 0 !important;
}
table th:last-child {
  -moz-border-radius: 0 5px 0 0 !important;
}
table tr:last-child td:first-child {
  -moz-border-radius: 0 0 0 5px !important;
}
table tr:last-child td:last-child {
  -moz-border-radius: 0 0 5px 0 !important;
} */


th:first-child {
     border-left: none;
}





</style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="css/style_index.css">

  <link rel="stylesheet" type="text/css" title="Cool stylesheet" href="css/style_main.css">
</head>
<body>
  <div id="root" style="margin-bottom:200px;overflow:hidden;width:100%">

  <table>
      <tr>
          <th>Item</th>
          <th>quantity</th>
          <th>price</th>
      </tr>
      <tr>
          <td>veg-Breakfast</td>
          <td><?php echo $row['vegbreakfast']*$days ?></td>
          <td><?php echo $breakfastvegPrice ?></td>
      </tr>
      <tr>
          <td>veg-lunch</td>
          <td><?php echo $row['veglunch']*$days ?></td>
          <td><?php echo $lunchvegPrice ?></td>
      </tr>
      <tr>
          <td>veg-Dinner</td>
          <td><?php echo $row['vegdinner']*$days ?></td>
          <td><?php echo $dinnervegPrice ?></td>
      </tr>
      <tr>
          <td>nonveg-Breakfast</td>
          <td><?php echo $row['nonvegbreakfast']*$days ?></td>
          <td><?php echo $breakfastnonPrice ?></td>
      </tr>
      <tr>
          <td>nonveg-lunch</td>
          <td><?php echo $row['nonveglunch']*$days ?></td>
          <td><?php echo $lunchnonnonPrice ?></td>
      </tr>
      <tr>
          <td>nonveg-Dinner</td>
          <td><?php echo $row['nonvegdinner']*$days ?></td>
          <td><?php echo $dinnernonPrice ?></td>
      </tr>
      <tr>
          <td>Room Charges</td>
          <td><?php echo $row['number_rooms']*$days ?></td>
          <td><?php echo $roomPrice ?></td>
      </tr>
      <tr>
          <td></td>
          <td></td>
          <td></td>
      </tr>
      <tr>
          <td></td>
          <td>Total</td>
          <td><?php echo ($roomPrice+$breakfastvegPrice+$lunchvegPrice+$dinnervegPrice+$breakfastnonPrice+$lunchnonnonPrice+$dinnernonPrice) ?></td>
      </tr>

  </table>

  <button style="color: white;border-radius: 30px;border:none:padding-left:10px;padding-right:10px;margin-top: 20px;margin-left: 50%;background-color: blue;border: none;padding-left: 10px;width: 100px;padding-top: 5px;">Pay</button>


  </div>
  <!-- <script src="main.js" type="text/javascript"></script> -->
</body>
</html>
