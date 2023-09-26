<?php require_once('server.php');

$var1 = "nothing";
if(isset($_SESSION['username'])){
	$var1 = $_SESSION['username'];
}

$sql = "SELECT * from `users` where username= '$var1'" ;
$query = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($query);

?>
	<img src="images/guest_hero.jpeg" class="imag rounded float-left" height="120">
<div class="header-nav">
  <h3>IIT PATNA</h3>
  <h4>Guest House Booking Portal</h4>

<?php if(isset($_SESSION['username'])) {?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #5F9EA0; ">
  <a class="navbar-brand" href="/Guest-House/homepage.php" style="font-size: inherit; color: #fff;">Home</a>
<?php } else { ?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #5F9EA0; ">
    <a class="navbar-brand" href="/Guest-House/index.php" style="font-size: inherit; color: #fff;">Home</a>
<?php } ?>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">


    <li>
      <b> <a class="btn btn-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="color:#fff; padding-top:8px; font-size:95%; font-weight:200%;">
        Contact us
      </a>
    </b>
    </li>

  </ul>
  <?php if (isset($_SESSION['username'])){ ?>
  <span class="navbar-text">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff">
        <?php echo $row['name']; ?>
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/Guest-House/profile.php" >My Profile</a>
        <a class="dropdown-item" href="/Guest-House/server.php?logout='1'" style="color: red;"> Logout</a>
      </div>
  </ul>
  </span>
<?php }else{ ?>

  <span class="navbar-text">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff">
        Institute Login
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/Guest-House/adminlogin.php" >Admin</a>
        <a class="dropdown-item" href="/Guest-House/login.php" >Faculty/Staff</a>
        <a class="dropdown-item" href="/Guest-House/login.php" >Student</a>
      </div>
  </ul>
  </span>
<?php } ?>
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
      <p>(+91) 9098858227</p>
      </article>
    </footer>
  </div>
</div>
</div>
</div>
