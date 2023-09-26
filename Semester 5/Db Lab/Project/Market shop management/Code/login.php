<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>
        Login
    </title>
    <link rel="stylesheet" href="style.css"/>

</head>
<body>
<?php
    require('db.php');
    session_start();
    if (isset($_REQUEST['mob'])) {
        $mob = $_REQUEST['mob'];
        $pass =$_REQUEST['password'];
        $password = md5($pass);

        $query = "SELECT * FROM `Shopkeeper` WHERE contact='$mob'";
        $result = mysqli_query($db, $query);
        $rows = mysqli_fetch_assoc($result);
        if ($password === $rows['password']) {
            $_SESSION['skid'] = $rows['skid'];
            header("Location: profile_sr.php");
        } 
        else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>
                    Click here to 
                        <a href='login.php'>
                            Login
                        </a> again.
                    </p>
                  </div>";
        }
    } 
    else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">
            Login
        </h1>
        <input type="text" class="login-input" name="mob" placeholder="Enter your mobile number" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Enter your Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">
            <a href="register_sk.php">
                New Registration
            </a>
        </p>
  </form>
<?php }?>
</body>
</html>
