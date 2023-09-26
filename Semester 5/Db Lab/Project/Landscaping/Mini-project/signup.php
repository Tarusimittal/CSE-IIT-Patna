
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Sign Up Form</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>


<div class = "container">
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<div class = "header">
        <h2>
                Enter Gardener Details
        </h2>
</div>

<form action = "signupserver.php" method="post">



<div class="mb-3">
        <label for="Name" class="form-label">
                Name
        </label>
        <input type="text" name = "name" class="form-control" placeholder="firstname lastname" required>
</div>
<div class="mb-3">
        <label for="Name" class="form-label">
                Dob
        </label>
        <input type="date" name = "dob" class="form-control" placeholder="firstname lastname" required>
</div>


<div class="mb-3">
        <label for="address" class="form-label">
                Address
        </label>
        <input type="text" name = "address" class="form-control" required>
</div>



<div class="mb-3">
        <label for="contactno" class="form-label">
                Contact Number
        </label>
        <input type="number" name = "contactno" class="form-control" placeholder="10 digit number"required>
</div>


<div class="mb-3">
        <label for="gender" class="form-label">
                Password
        </label>
        <input type="password" name = "password" class="form-control"  required>
</div>

<div class="mb-3">
        <label for="gender" class="form-label">
                Gender
        </label>
        <input type="text" name = "gender" class="form-control" placeholder = "M/F" required>
</div>

<div class="mb-3">
        <label for="gender" class="form-label">
                Username
        </label>
        <input type="text" name = "username" class="form-control"  required>
</div>

<div class="mb-3">
        <label for="Name" class="form-label">
                Doj
        </label>
        <input type="date" name = "doj" class="form-control" required>
</div>

<button type = "submit" class="btn btn-outline-primary" name = "gardenerdetailsubmit">
        Submit
</button>

</form>


</body>
</div>

</html>
