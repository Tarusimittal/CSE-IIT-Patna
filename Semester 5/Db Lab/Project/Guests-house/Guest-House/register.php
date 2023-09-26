<?php require_once('server.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="css/style_index.css">
  <link rel="stylesheet" type="text/css" title="Cool stylesheet" href="css/style_main.css">
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
  <div id="root" style="margin-bottom:200px;">
  <!-- <script src="main.js" type="text/javascript"></script> -->
<div class="header">
  <h2>Register</h2>
</div>
<form class="registration-form" action="register.php" method="post">

<!-- The erros are displayed here-->
<?php include('errors.php'); ?>

  <div class="input-group">
    <label>Username</label>
    <input type="text" name="username" required placeholder="Enter Your Username" value="<?php echo $username; ?>">
  </div>
  <div class="input-group">
    <label>Name</label>
    <input type="text" name="name" required placeholder="Enter your full name" value="<?php echo $name; ?>">
  </div>
  <div class="input-group">
    <label>Email</label>
    <input type="email" name="email" required placeholder= "Enter your email id" value="<?php echo $username; ?>">
  </div>
  <div class="input-group">
    <label>Designation</label>
    <input type="text" name="designation" required placeholder="Enter your Designation" value="<?php echo $designation; ?>">
  </div>
  <div class="input-group">
    <label>Employee id</label>
    <input type="text" name="employeeid" required placeholder= "Enter your Employee id" value="<?php echo $employeeid; ?>">
  </div>
  <div class="input-group">
    <label>Phone No.</label>
    <input type="text" name="phone" required placeholder= "Enter your Phone No." value="<?php echo $phone; ?>">
  </div>
  <div class="wrapper">
    <div class="form-group form-inline">
      <label for="department">Department</label>
      <select id="department" class="form-control" name="department" value="<?php {if(isset($data['department'])) echo $data['department'];} ?>">
        <option selected>Computer Science and Engineering</option>
        <option>Electrical Engineering</option>
        <option>Mechanical Engineering</option>
        <option>Civil Engineering</option>
        <option>Chemical Engineering</option>
        <option>Metallurgical Engineering</option>
        <option>Others</option>
      </select>
    </div>
  </div>

  <div class="input-group">
    <label>Password</label>
    <input type="password" required placeholder="******" name="password_1">
  </div>
  <div class="input-group">
    <label>Confirm Password</label>
    <input type="password" required placeholder="******" name="password_2">
  </div>
  <div class="input-group">
    <button type="submit" name="register" class="button">Register</button>
  </div>
  <p>
     Already a member? <a href="login.php">Sign in</a>
   </p>
</form>
</div>
</body>
</html>
