

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
                Sign Up Form
        </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<div class = "container">
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<div class = "header"> 
        <h2>
                Enter roster entry details. If entry exists, it will be updated.
        </h2>
</div>

<form action = "rosterupdateserver.php" method="post">

// date area gardenerid
<div class="mb-3">
        <label for="Name" class="form-label">
                Date
        </label>
        <input type="date" name = "date" class="form-control" required>
</div>
<div class="mb-3">
        <label for="Name" class="form-label">
                Area
        </label>
        <input type="text" name = "area" class="form-control" required>
</div>


<div class="mb-3">
        <label for="address" class="form-label">
                GardenerID
        </label>
        <input type="number" name = "gardenerid" class="form-control" required>
</div>





<button type = "submit" class="btn btn-outline-primary" name = "gardenerdetailsubmit">
        Submit
</button>

</form>

 
</body>
</div>

</html>
