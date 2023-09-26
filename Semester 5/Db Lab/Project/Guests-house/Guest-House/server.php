<?php
session_start();

            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

$username = "";
$email="";
$designation = "";
$phone = "";
$employeeid = "";
$name = "";
$errors = array();
//connect to database
require_once('connectVars.php');

$db= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}
//if the register button is clicked

if(isset($_POST['register']))
 {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $employeeid= $_POST['employeeid'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    //checks if form fields are filled
    if(empty($username))
    {
      array_push($errors, "Username is required.");
    }
    if(empty($name))
    {
      array_push($errors, "Name is required.");
    }
    if(empty($email))
    {
      array_push($errors, "Email is required.");
    }
    if(empty($designation))
    {
      array_push($errors, "Designation is required.");
    }
    if(empty($employeeid))
    {
      array_push($errors, "Employee id is required.");
    }
    if(empty($phone))
    {
      array_push($errors, "Phone No. is required.");
    }
    if(empty($password_1))
    {
      array_push($errors, "Password is required.");
    }
    if($password_1!=$password_2)
    {
      array_push($errors,"The two passwords do not match.");
    }

    //if no errors are found, registration will be complete.
    if(count($errors)==0)
    {
      $password = md5($password_1);
      //password is encrypted before storing in the database.
      $query1 = "SELECT * FROM users WHERE email = '$email'";
  		$query2 = "SELECT * FROM users WHERE username = '$username'";
  	    $result1 = mysqli_query($db,$query1);
  	    $result2 =  mysqli_query($db,$query2);
  	    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
  	    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
  	    $count1 = mysqli_num_rows($result1);
  	    $count2 = mysqli_num_rows($result2);

      if($count1+$count2==0)
        {
          $sql = "INSERT INTO users (username,name,email,designation,employeeid,phone,department,password) VALUES ('$username','$name','$email','$designation','$employeeid','$phone','$department','$password')";
          if(mysqli_query($db,$sql))
          {
            // Sending mail and then redirecting to homepage
            $_SESSION['username']=$username;
            $_SESSION['success'] = "You are now logged in.";

            header('location: homepage.php');
        }
      }
      else{
              	if($count1>=1)
              	{
                array_push($errors, "The email id is already registered.");;
                }
                if($count2>=1)
                {
                array_push($errors, "The username already exists.");
                }
                //header("location: signup.php?type=null");
        }
    }
  }

//logging in (from loginpage)
if(isset($_POST['login']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  //ensure fields are entered.
  if(empty($username))
  {
    array_push($errors, "Username is required.");
  }
  if(empty($password))
  {
    array_push($errors, "Password is required.");
  }
  if(count($errors)==0)
  {
    $password= md5($password); // encrypting password for security.
    $query= "SELECT * FROM users WHERE username= '$username' AND password='$password' ";
    $result = mysqli_query($db,$query);

    $query1 = "SELECT password FROM users WHERE username = '$username'";
    $query2 = "SELECT username FROM users WHERE password = '$password'";
      $result1 = mysqli_query($db,$query1);
      $result2 =  mysqli_query($db,$query2);
      $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
      $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
      $count1 = mysqli_num_rows($result1);
      $count2 = mysqli_num_rows($result2);

    if(mysqli_num_rows($result)==1)
    {
      //log user in
      $_SESSION['username']=$username;
      $_SESSION['success'] = "You are now logged in.";
      header('location: homepage.php');
    }
    else
    {
      array_push($errors, "The username/password combination is incorrect.");
      if($count1==0)
      {
        array_push($errors," The Username does not exist.");
      }
      else if ($count1==1)
      {
        array_push($errors, "Incorrect password.");
      }
    }
  }
}


//logging in (from admin)
if(isset($_POST['adminlogin']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  //ensure fields are entered.
  if(empty($username))
  {
    array_push($errors, "Username is required.");
  }
  if(empty($password))
  {
    array_push($errors, "Password is required.");
  }
  if(count($errors)==0)
  {
// encrypting password for security.
    $query= "SELECT * FROM admin WHERE username= '$username' AND password='$password' ";
    $result = mysqli_query($db,$query);

    $query1 = "SELECT password FROM admin WHERE username = '$username'";
    $query2 = "SELECT username FROM admin WHERE password = '$password'";
      $result1 = mysqli_query($db,$query1);
      $result2 =  mysqli_query($db,$query2);
      $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
      $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
      $count1 = mysqli_num_rows($result1);
      $count2 = mysqli_num_rows($result2);

    if(mysqli_num_rows($result)==1)
    {
      //log user in
      $_SESSION['username']=$username;
      $_SESSION['success'] = "You are now logged in.";
      $home_url = 'http://' . $_SERVER['HTTP_HOST'] .'/Guest-House/calendarview.php';
      header('Location: ' . $home_url);
    }
    else
    {
      array_push($errors, "The username/password combination is incorrect.");
      if($count1==0)
      {
        array_push($errors," The Username does not exist.");
      }
      else if ($count1==1)
      {
        array_push($errors, "Incorrect password.");
      }
    }
  }
}


  //Logout
  if(isset($_GET['logout']))
  {
    session_destroy();
    unset($_SESSION['username']);
    header('location: index.php');
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] .'/Guest-House/index.php';
    header('Location: ' . $home_url);
  }

    ?>
