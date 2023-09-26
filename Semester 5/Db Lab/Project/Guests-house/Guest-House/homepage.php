<?php require_once('server.php');
require_once('templates/navbar.php');

//IF user is not logged in, this page cannot be accessed.
if(empty($_SESSION['username'])) {
  header('location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/style_index.css">

  <link rel="stylesheet" type="text/css" title="Cool stylesheet" href="css/style_main.css">
</head>
<body>

  <div class="wrap">
    <div class="wrapper0">
      <div class="wrapper1">
        <div style="  display: flex;justify-content: center; flex-direction: row; ">
          <div class="row">
            <div class="card">
              <h5 class="card-header">Book a room</h5>
              <div class="card-body">
                <h5 class="card-title">Spacious and comfortable rooms</h5>
                <p class="card-text">Book your rooms now.</p>
                <a href="booking.php" class="btn btn-primary">Visit</a>
              </div>
            </div>
            <div class="card">
              <h5 class="card-header">Room booking status</h5>
              <div class="card-body">
                <h5 class="card-title">Get all your updates at one place</h5>
                <p class="card-text">Check your status now.</p>
                <a href="checkbooking.php?username=<?php echo $_SESSION['username']; ?>" class="btn btn-primary">Visit</a>
              </div>
            </div>
          </div>
          <br><br>
          <div class="row">
            <div class="card">
              <h5 class="card-header">Room Availability</h5>
              <div class="card-body">
                <h5 class="card-title">Find all the available room</h5>
                <p class="card-text">Find out if your favorite room is free</p>
                <a href="showavailable.php" class="btn btn-primary">Visit</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
