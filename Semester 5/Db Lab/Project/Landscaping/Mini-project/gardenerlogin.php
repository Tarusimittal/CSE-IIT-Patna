
<?php
    require_once('db.php');

    session_start();
     
    $wrong = 0;
    if(isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM gardener WHERE username = '$username'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        if($row['password'] === md5($password)) {
            $_SESSION['username'] = $username;
            $_SESSION['gardenerid'] = $row['gardenerid'];
            header("Location: userprofile.php");
        }
        else{
            $wrong = 1;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action = "gardenerlogin.php" method = "post">
        <div   class = "mb-3">
            <label for = "username" class = "form-label">Username</label>
            <input type = "text" name="username" class = "form-control"  placeholder = "username">
        </div>
        <div class = "mb-3">
            <label for = "exampleFormControlTextarea1" class = "form-label">Password</label>
            <input type = "password" name="password" class = "form-control"  placeholder = "********">
        </div>
        <?php
            if($wrong){
                echo "<p style='color:red'>wrong password or username</p>";
            }

        ?>
        <div class="col-auto">
            <button type="submit" name="gardenerlogin" class="btn btn-primary mb-3">Confirm identity</button>
        </div>
        </form>

    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
