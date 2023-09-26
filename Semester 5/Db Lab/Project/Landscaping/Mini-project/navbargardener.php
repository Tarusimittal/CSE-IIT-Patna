<?php
    session_start();
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
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="#">Welcome, <?php

echo $_SESSION['username'];
?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item active"><a class="nav-link" href="userprofile.php">Home</a></li>
    <li class="nav-item active"><a class="nav-link" href="https://goo.gl/maps/XWEiepW9Gjkksem79">How to Reach IIT Patna</a></li>
    <li class="nav-item active"><a class="nav-link" href="requestholiday.php">Request Holiday</a></li>
    <li class="nav-item active"><a class="nav-link" href="https://www.iitp.ac.in/saifiitp/index.php/contact-us">Contact Us</a></li>
  </div>
</nav>
</body>
</html>
