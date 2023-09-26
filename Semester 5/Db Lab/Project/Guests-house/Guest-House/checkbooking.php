<?php
  // Start the session
  require_once('server.php');
  require_once('templates/navbar.php');

  //IF user is not logged in, this page cannot be accessed.
  if(empty($_SESSION['username'])) {
    header('location: login.php');
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="css/style_index.css">

  <link rel="stylesheet" type="text/css" title="Cool stylesheet" href="css/style_main.css">
</head>
<body>
<!--html code-->
<br>
<div class="wrap">
  <div class="wrapper0">
    <div class="wrapper1">
      <table id="users">
        <tr>
            <th >S.No.</th>
            <th >Username</th>
            <th >Guest Name</th>
            <th >Guest Number</th>
            <th >Status</th>
            <th>Bill</th>
          </tr>

        <?php
        $db_connect= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$db_connect) {
          die("Connection failed: " . mysqli_connect_error());
        }
        $username_connect = mysqli_real_escape_string($db_connect, trim($_GET['username']));
        $query_connect = "SELECT * FROM bookings WHERE username='$username_connect'";
          $data = mysqli_query($db_connect, $query_connect);
          if(mysqli_num_rows($data) != 0){
        ?>
        <tbody>
          <?php
            $curr = 1;
            while($row = mysqli_fetch_array($data)){
              echo '<tr><td>' . $curr . '</td>' .
                        '<td>' . $row["username"] . '</td>' .
                        '<td>' . $row["guestname"] . '</td>' .
                        '<td>' . $row["guestphone"] . '</td>' .
                        '<td>' . $row["status"] . '</td>' .
                         '<td><a href="bill.php?id=' . $row["id"] . '"><button type="generateBill" class="btn btn-outline-success" name="id" >BILL</button></a></td>'.
                    '</tr>';
              $curr = $curr + 1;
            }
          ?>
        </tbody>
        <?php } else { ?>
          <tr>
            <td>No data</td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>

</div>


</div>
</body>
</html>
