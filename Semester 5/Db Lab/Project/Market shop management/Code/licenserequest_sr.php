
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Shop License</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>


<div class = "container">
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<div class = "header"> 
        <h2>
                Enter the Details
        </h2>
</div>

<form action = "licenserequestserver_sr.php" method="post">



<div class="mb-3">
        <label for="GardenerID" class="form-label">
                Shopkeeper ID
        </label>
        <input type="text" name = "skid" class="form-control" placeholder="Enter Shopkeeper ID" required>
</div>

<div class="mb-3">
        <label for="GardenerID" class="form-label">
                Shop ID
        </label>
        <input type="text" name = "sid" class="form-control" placeholder="Enter Shop ID" required>
</div>



<button type = "submit" class="btn btn-outline-primary" name = "gardenerdetailsubmit">
        Request license
</button>

</form>

 
</body>
</div>

</html>