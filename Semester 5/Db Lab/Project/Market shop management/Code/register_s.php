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
    if (isset($_REQUEST['skid'])) {
        $skid = $_REQUEST['skid'];
        $sname = $_REQUEST['sname'];
        $address = $_REQUEST['address'];
        $contact = $_REQUEST['contact'];


        $query    = "INSERT into `Shop` (skid, sname,address, contact)
                     VALUES ('$skid','$sname','$address', '$contact')";

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
    else {
?>
    <form class="form" action="register_s.php" method="post">
        <h1 class="login-title">
            Registration
        </h1>
        <input type="text" class="login-input" name="skid" placeholder="Enter your ShopKeeper_ID" required />
        <input type="text" class="login-input" name="sname" placeholder="Enter your shop name" required />
        <input type="text" class="login-input" name="address" placeholder="Enter your shop address" required>
        <input type="number" class="login-input" name="contact" placeholder="Enter 10 digit mobile number">
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
