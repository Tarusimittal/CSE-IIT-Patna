<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>
        Registration
    </title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['skname'])) {
        $skname = $_REQUEST['skname'];
        $gender = $_REQUEST['gender'];
        $address = $_REQUEST['address'];
        $contact = $_REQUEST['contact'];
        $dob = $_REQUEST['dob'];

        $pass = $_REQUEST['password'];
        $password = md5($pass);
        $checkmob = "SELECT skid FROM `Shopkeeper` WHERE contact = '$contact'";
        $checkmobresult = mysqli_query($db, $checkmob);
        $fetch_rows = mysqli_num_rows($checkmobresult);
        if($fetch_rows>0){
          echo "<div class='form'>
                <h3>Mobile Number already exists</h3><br/>
                <p class='link'>Click here to <a href='register_sk.php'>register</a> again.</p>
                </div>";
        } 
        else {
          $query    = "INSERT into `Shopkeeper` (skname, gender, address, contact, dob, password)
                       VALUES ('$skname','$gender','$address', '$contact', '$dob', '$password')";

          $result   = mysqli_query($db, $query);
          if ($result) {
              echo "<div class='form'>
                    <h3>You are registered successfully.</h3><br/>
                    <p class='link'>Click here to <a href='login.php'>Login</a></p>
                    </div>";
          } 
          else {
              echo "<div class='form'>
                    <h3>There was an error, Please try again !</h3><br/>
                    <p class='link'>Click here to <a href='register_sk.php'>register</a> again.</p>
                    </div>";
          }
        }

    } 
    else {
?>
    <form class="form" action="register_sk.php" method="post">
        <h1 class="login-title">
            Registration
        </h1>
        <input type="text" class="login-input" name="skname" placeholder="Enter your name" required />
        <input type="text" class="login-input" name="gender" placeholder="Enter your Gender: M or F only" required />
        <input type="text" class="login-input" name="address" placeholder="Entere your address" required>
        <input type="number" class="login-input" name="contact" placeholder="Enter 10 digit mobile number">
        <input type="date" class="login-input" name="dob" placeholder="Enter your Dob">
        <input type="password" class="login-input" name="password" placeholder="Password">

        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">
            <a href="login.php">
                Click to Login
            </a>
        </p>
    </form>
<?php
    }
?>
</body>
</html>
