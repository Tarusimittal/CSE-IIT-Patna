<?php require_once('../server.php');
//IF user is not logged in, this page cannot be accessed.
if(empty($_SESSION['username'])) {
   header('location: ../login.php');
}

// $month = date('m',time());
// $year = date('Y', time());
if(isset($_POST['submit'])){
  $title = $_POST['title'];
  $date = $_POST['date'];
  $cost = $_POST['cost'];
  $description = $_POST['description'];



  $query = "INSERT INTO expenditure(Title, date, cost, Description) VALUES('$title','$date','$cost','$description')";
  $res = mysqli_query($db, $query);

  if($res){
      header('location: http://localhost/Guest-House/admin/adminhome.php');
  }
  else{
      echo mysqli_error($db);
  }

}


// $bookingDetailsNormal = "SELECT * FROM bookings WHERE (EXTRACT(MONTH FROM arrival)='$month' or EXTRACT(MONTH FROM departure)='$month') AND (EXTRACT(YEAR FROM arrival)='$year' or EXTRACT(YEAR FROM departure)='$year') AND accomodation='Normal' ";
// $res = mysqli_query($db, $bookingDetailsNormal);
// // echo mysqli_error($db);
// // $row = mysqli_fetch_array($res);
// // echo $row['username'];

// $numNormal = 0;
// while($row = mysqli_fetch_array($res)){
//   $numNormal += $row['number_rooms'];
// }

// $numMaster = 0;
// $bookingDetailsMaster = "SELECT * FROM bookings WHERE (EXTRACT(MONTH FROM arrival)='$month' or EXTRACT(MONTH FROM departure)='$month') AND (EXTRACT(YEAR FROM arrival)='$year' or EXTRACT(YEAR FROM departure)='$year') AND accomodation='Master' ";
// $res = mysqli_query($db, $bookingDetailsMaster);
// while($row = mysqli_fetch_array($res)){
//   $numMaster += $row['number_rooms'];
// }



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
    /* background-color: rgba(95,158,160,0.7); */
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
    <img src="../images/iitp_logo.png" class="rounded float-left">
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
            <a class="nav-link" href="viewrequests.php" style="color: #fff;">Requests</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="showrooms.php" style="color: #fff;">Bookings</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="rooms.php" style="color: #fff;">Rooms</a>
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
            <!-- <a class="dropdown-item" href="/Guest-House/adminlogin.php" >option</a> -->
            <!-- <a class="dropdown-item" href="/Guest-House/login.php" >option</a> -->
            <!-- <a class="dropdown-item" href="/Guest-House/login.php" >option</a> -->
            <a class="dropdown-item" href="../server.php?logout='1'" style="color: red;"> Logout</a>
          </div>


      </ul>
      </span>
    <?php } ?>
      </nav>
  </div>
  <div>
    <form action="" method="post">
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" placeholder="XYZ">
        </div>
        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" class="form-control">
        </div>
        <div class="form-group">
            <label>Cost</label>
            <input type="int" name="cost" class="form-control"  placeholder="300">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <input type="text" name="description" class="form-control" placeholder="explain in detail">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

</body>
</html>
