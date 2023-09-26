<?php include('server.php');
if(!isset($_SESSION['user_role']))
$_SESSION['user_role']="guest";
?>

<!DOCTYPE html>
<html>
<head>
	<title>IIT PATNA Guest House Portal</title>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="css/style_index.css">

</head>
<body>
	<img src="images/guest_hero.jpeg" class="imag rounded float-left" height="120">
	<div class="header-nav">
	  <h3>IIT PATNA</h3>
	  <h4>Guest House Booking Portal</h4>

	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: black; ">
	  <a class="navbar-brand" href="/Guest-House/index.php" style="font-size: inherit; color: #fff;">Home</a>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	  <ul class="navbar-nav mr-auto">
	    <?php if(!isset($_SESSION['username']) || $_SESSION['user_role']!='admin'){ ?>

	    <li>
	      <a class="btn btn-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="color:#fff;">
	        Contact us
	      </a>
	    </li>
	    <?php } ?>
	    <?php if(isset($_SESSION['username']) && $_SESSION['user_role']=='admin'){ ?>
	    <li class="nav-item active">
	      <a class="nav-link" href="#">Bookings</a>
	    </li>

	    <?php } ?>
	  </ul>

	  <span class="navbar-text">
	  <ul class="navbar-nav mr-auto">
	    <li class="nav-item dropdown active">
	      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff">
	        Login
	      </a>
	      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	        <a class="dropdown-item" href="/Guest-House/adminlogin.php">Admin</a>
	        <a class="dropdown-item" href="/Guest-House/login.php">Faculty/Staff</a>
	        <a class="dropdown-item" href="/Guest-House/login.php">Student</a>
	      </div>

	  </ul>
	</nav>

	<div class="collapse" id="collapseExample">
	  <div class="card card-body">
	    <footer>
	      <h3>Contact Us</h3>
	      <article>
	      <h4>Address</h4>
	      <p>IIT PATNA Guest House</p>
	      </article>

	      <article>
	      <h4>Mail</h4>
	      <p><a href="#">guestHouse_IITP@gmail.com</a></p>
	      </article>

	      <article>
	      <h4>Phone</h4>
	      <p>(+91) 909885827</p>
	      </article>
	    </footer>
	  </div>
	</div>

</div>
<br><br><br>
 <div >
	 <div class = "wrapper0">
 		<div class="wrapper1">
			<h2> About Us </h2>
 			Indian Institute of Technology Patna is one of the new IITs established by an Act of the Indian Parliament on August 06, 2008.

 			Patna which was known as Patliputra has been a center of knowledge since long has been attracting visitors and scholars from many parts of the world such as China, Indonesia, Japan, Korea, Sri Lanka, among others. This has been a land of visionaries. Some of the legends from this region include Lord Gautam Buddha, Lord Mahavir, Guru Gobind Singh, the famous astronomer Aryabhatta and the first President of India, Dr. Rajendra Prasad.
 			<br><br>
 			<pre>IIT Patna has ten departments: These are
 			Computer Science & Engineering
 			Electrical Engineering
 			Mechanical Engineering
 			Chemical and Biochemical Engineering
 			Civil & Environmental Engineering
 			Materials Science & Engineering
 			Chemistry
 			Physics
 			Mathematics
 			Humanities & Social Science departments.</pre>
 		</div>
 		</div>

 	</div>
 </div>

</body>
</html>
