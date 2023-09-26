<?php
  require_once('server.php');
  require_once('templates/navbar.php');
  if(empty($_SESSION['username'])) {
  header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/style_index.css">
    <link rel="stylesheet" type="text/css" href="css/matrix.css">

  <script type="text/javascript" language="javascript">
  function checkThis(oCheckbox, limit)
  {
    limit=0;
  	var el, i = 0, n = limit, oForm = oCheckbox.form;
  	while (el = oForm.elements[i++])
  	{
  		if (el.className == 'single-checkbox' && el.checked)
  			--n;
  		if (n < 0)
  		{
  			alert('You cannot select any rooms from here. Please make a booking request instead.')
  			return false;
  		}
  	}
  	return true;
  }

  </script>
  <style media="screen" type="text/css">
    #roomsubmit{
      visibility: collapse;
    }

    .room label{
      /* background: darkseagreen; */
    }

    .screen-side .select-text {
    color: #969696;
    visibility: hidden;
    }

    #check-form {
      width: 40%;
      margin: 0px auto;
      margin-top: 30px;
      padding-top: 15px;
      padding-bottom: 0px;
      border: 1px solid #80C4DE;
      background: white;
      border-radius: 10px 10px 10px 10px;
    }

    h3{
      text-align: center;
      margin-bottom: -10px;
      margin-top: 50px;
    }
  </style>

  </head>
  <body class="root">
    <form>
      <div class="check-form" id="check-form">
      <div class="form-row"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" >
        <div class="form-group col-md-4" style="margin-left:25px;">
          <input type="date" class="form-control" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date'];} ?>" placeholder="from_date" name="from_date" min=<?php echo date('Y-m-d');?> required >
        </div>
        <div class="form-group col-md-4">
          <input type="date" class="form-control" placeholder="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date'];} ?>" name="to_date" min=<?php echo date('Y-m-d');?> required>
        </div>
      <div class="form-group col-md-2" >
        <button type="submit" class="btn btn-primary" name="check" style="margin-left:50px;">Check</button>
      </div>
      </div>
      </div>
    </form>

    <?php
     if(isset($_GET['check'])) {
      $to_date=$_GET['to_date'];
      $from_date=$_GET['from_date'];
      if($to_date<$from_date){
        echo ' </br> <div class="container"><div class="alert alert-danger alert-dismissible fade show" role="alert">' .
          'Please ensure that the dates are entered in a correct order.' . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' .
          '<span aria-hidden="true">&times;</span></button></div></div>';
      }
      else{
       ?>
      <h3>ROOMS</h3>
      <?php require_once("templates/matrix.php"); ?>
    <?php } } ?>

  </body>
</html>
