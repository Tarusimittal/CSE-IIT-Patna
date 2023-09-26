<?php require_once('db.php'); 
session_start();?>

<div style="display:inline-block;width:100%">
<h1 style="display:inline;float:left">IIT PATNA</h1>
<h1 style="display:inline;float:right;margin-right:20px">Landscaping portal</h1>
</div>
<div class="header-nav">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #5F9EA0; ">
<?php if(isset($_SESSION['username'])) {?>

  <a class="navbar-brand" href="/Mini-project/attendance.php" style="margin-left:10px;font-size: inherit; color: #fff;">Home</a>
<?php } ?>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/Mini-project/dutyroasterhome.php" style="color: #fff;">Duty Roaster</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="/Mini-project/gardenerstatus.php"  style="color: #fff;">Gardener Status Today</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="/Mini-project/grasscuttingrequest.php"  style="color: #fff;">Grass Cutting Requests</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="/Mini-project/equipmentrequest.php"  style="color: #fff;">Equipments Requests</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="/Mini-project/approverequest.php"  style="color: #fff;">Holiday Request</a>
    </li>

  </ul>
  <?php if (isset($_SESSION['username'])){ ?>
  <span class="navbar-text">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff">
        <?php echo $_SESSION['username']; ?>
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/Mini-project/index.php" style="color: red;"> Logout</a>
        <a class="dropdown-item" href="/Mini-project/admin_gardenerlist.php" style="color: black;"> Gardener List</a>
      </div>
  </ul>
  </span>
<?php }else{ ?>

  <span class="navbar-text">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff">
        Login
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="/Mini-project/adminlogin.php" >Admin</a>
        <a class="dropdown-item" href="/Mini-project/gardenerlogin.php" >Gardener</a>
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
      <p><a href="#">mail_guest_house@gmail.com</a></p>
      </article>

      <article>
      <h4>Phone</h4>
      <p>(+91)9999999999</p>
      </article>
    </footer>
  </div>
</div>
</div>
</div>
