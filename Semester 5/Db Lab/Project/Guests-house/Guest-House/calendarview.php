<?php require_once('server.php');
if(empty($_SESSION['username'])) {
   header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title> Calendar View </title>

  <link rel="stylesheet" type="text/css" href="css/style_index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFSf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>


  <script>

  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:false,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'load.php',
    selectable:false,
    selectHelper:false,
    editable:false,

   });
  });

  </script>
 </head>
 <body>
   <div id="root" style="margin-bottom:100px;">
  <img src="images/guest_hero.jpeg" class="imag rounded float-left" height="120">
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
             <a class="nav-link" href="admin/viewrequests.php" style="color: #fff;">Room-Requests</a>
           </li>
           <li class="nav-item active">
             <a class="nav-link" href="admin/showrooms.php" style="color: #fff;">All Bookings</a>
           </li>
           <li class="nav-item active">
             <a class="nav-link" href="admin/rooms.php" style="color: #fff;">Room-Status & Availability</a>
           </li>
           <li class="nav-item active">
             <a class="nav-link" href="admin/monthlycost.php" style="color: #fff;">Monthly Cost</a>
           </li>
           <li class="nav-item active">
             <a class="nav-link" href="calendarview.php" style="color: #fff;">Staff Duty</a>
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


  <div class="container" style="max-width: 50%; margin-bottom:100px; margin-top:30px; ">
   <div id="calendar"></div>
  </div>
 </body>
</html>
