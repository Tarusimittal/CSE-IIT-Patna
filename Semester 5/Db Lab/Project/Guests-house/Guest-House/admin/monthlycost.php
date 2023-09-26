<?php require_once('../server.php');
if(empty($_SESSION['username'])) {
   header('location: ../login.php');
}

$month = date('m',time());
$year = date('Y', time());
if(isset($_POST['submitMonth'])){
  $pickMonth = $_POST['pickMonth'];

  $month = date('m', strtotime($pickMonth));
  $year = date('Y', strtotime($pickMonth));

}

$monthlyFoodPrice = 0;

$bookingDetailsNormal = "SELECT * FROM bookings WHERE (EXTRACT(MONTH FROM arrival)='$month' or EXTRACT(MONTH FROM departure)='$month') AND (EXTRACT(YEAR FROM arrival)='$year' or EXTRACT(YEAR FROM departure)='$year') AND accomodation='Normal' ";
$res = mysqli_query($db, $bookingDetailsNormal);

$numNormal = 0;
$costnormal = 0;
while($row = mysqli_fetch_array($res)){
  $monthlyFoodPrice += ($row['vegbreakfast'])*30;
  $monthlyFoodPrice += ($row['nonvegbreakfast'])*40;
  $monthlyFoodPrice += ($row['veglunch'])*50;
  $monthlyFoodPrice += ($row['nonveglunch'])*60;
  $monthlyFoodPrice += ($row['vegdinner'])*50;
  $monthlyFoodPrice += ($row['nonvegdinner'])*60;
  $numNormal += $row['number_rooms'];
  $costnormal += 250;
}

$numMaster = 0;
$costmaster = 0;
$bookingDetailsMaster = "SELECT * FROM bookings WHERE (EXTRACT(MONTH FROM arrival)='$month' or EXTRACT(MONTH FROM departure)='$month') AND (EXTRACT(YEAR FROM arrival)='$year' or EXTRACT(YEAR FROM departure)='$year') AND accomodation='Deluxe' ";
$res = mysqli_query($db, $bookingDetailsMaster);
while($row = mysqli_fetch_array($res)){
  $monthlyFoodPrice += ($row['vegbreakfast'])*30;
  $monthlyFoodPrice += ($row['nonvegbreakfast'])*40;
  $monthlyFoodPrice += ($row['veglunch'])*50;
  $monthlyFoodPrice += ($row['nonveglunch'])*60;
  $monthlyFoodPrice += ($row['vegdinner'])*50;
  $monthlyFoodPrice += ($row['nonvegdinner'])*60;
  $numMaster += $row['number_rooms'];
  $costnormal += 350;
}

$expense = 0;
$expenseQuery = "SELECT * FROM expenditure WHERE (EXTRACT(MONTH FROM date)='$month') AND (EXTRACT(YEAR FROM date)='$year') ";
$res = mysqli_query($db, $expenseQuery);
while($row = mysqli_fetch_array($res)){
  $expense += $row['cost'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Home</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="../css/style_index.css">

<style media="screen">
.nav-pills .pill-1 .nav-link:not(.active) {

    background-color: #fff;
    color: #5F9EA0;
}

.nav-pills .pill-1 .nav-link {
    background-color: #5F9EA0;
    color: white;
}

table{
  margin-top: 25px;
}

/* .container{
  margin-bottom:100px;
} */
#check-form {
  width: 55%;
  margin: 0px auto;
  margin-top: 30px;
  margin-bottom: 30px;
  padding-top: 15px;
  padding-bottom: 0px;
  border: 1px solid #80C4DE;
  background: white;
  border-radius: 10px 10px 10px 10px;
}

</style>

</head>
<body>
  <div id="root" style="margin-bottom:100px;">
  <img src="../images/guest_hero.jpeg" class="imag rounded float-left" height="120">
  	<div class="header-nav">
  	  <h1>IIT PATNA</h1>
  	  <h2>Guest House Booking Portal</h2>
      <?php if(isset($_SESSION['username'])) {?>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #5F9EA0; ">
        <a class="navbar-brand" href="/Guest-House/admin/adminhome.php" style="font-size: inherit; color: #fff;">Home</a>
      <?php } else { ?>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #5F9EA0; ">
          <a class="navbar-brand" href="/Guest-House/index.php" style="font-size: inherit; color: #fff;">Home</a>
      <?php } ?>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

          <li class="nav-item active">
            <a class="nav-link" href="viewrequests.php" style="color: #fff;">Room-Requests</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="showrooms.php" style="color: #fff;">All Bookings</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="rooms.php" style="color: #fff;">Room-Status & Availability</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="monthlycost.php" style="color: #fff;">Monthly Cost</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../calendarview.php" style="color: #fff;">Staff Duty</a>
          </li>
        </ul>
      </div>
      <?php if (isset($_SESSION['username'])){ ?>
      <span class="navbar-text">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff">
            <?php echo $_SESSION['username']; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../server.php?logout='1'" style="color: red;"> Logout</a>
          </div>


      </ul>
      </span>
    <?php } ?>
      </nav>
  </div>

  <div class="wrapper0">
    <div class="wrapper1">
      <h2>Monthly Expenses</h2>
      <form action="" method="post">
          <input type="month" name="pickMonth">
          <button name="submitMonth">Search</button>
      </form>
      <table>
        <tr>
          <td>Room Booked type - Normal</td>
          <td>:</td>
          <td><?php echo $numNormal;?></td>
        </tr>
        <tr>
          <td>Earning type - Normal</td>
          <td>:</td>
          <td><?php echo $costnormal;?></td>
        </tr>
        <tr>
          <td>*</td>
          <td>*</td>
          <td>*</td>
        </tr>
        <tr>
          <td>Room Booked type - Deluxe</td>
          <td>:</td>
          <td> <?php echo $numMaster;?></td>
        </tr>
        <tr>
          <td>Earning type - Deluxe</td>
          <td>:</td>
          <td><?php echo $costmaster;?></td>
        </tr>
        <tr>
          <td>*</td>
          <td>*</td>
          <td>*</td>
        </tr>
        <tr>
          <td>Monthly Food Price Earning</td>
          <td>:</td>
          <td><?php echo $monthlyFoodPrice;?></td>
        </tr>
        <tr>
          <td>Monthly Other workExpenses</td>
          <td>:</td>
          <td><?php echo $expense;?></td>
        </tr>

      </table>

    </div>

  </div>

</body>
</html>
