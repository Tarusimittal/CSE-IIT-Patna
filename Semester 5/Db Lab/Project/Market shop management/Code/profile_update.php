<?php
include('auth.php');
require('db.php');

$skid = $_SESSION['skid'];
$sql = "SELECT * from `Shopkeeper` where skid= '$skid'" ;
$query = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($query);
?>
<?php
$skid = $_SESSION['skid'];

if (isset($_REQUEST['submit'])) {
  $skname = $_REQUEST['skname'];
  $gender = $_REQUEST['gender'];
  $address = $_REQUEST['address'];
  $contact = $_REQUEST['contact'];
  $dob = $_REQUEST['dob'];

    $query1 = "Update shopkeeper SET skname = '$skname', gender = '$gender',
	 address='$address',contact = '$contact', dob='$dob' WHERE skid='$skid'";
    $result1 = mysqli_query($db, $query1);
    echo '<script type = "text/javascript">';
    echo 'alert("Changes Updated!");';
    echo 'window.location.href = "profile_sr.php"';
    echo '</script>';
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  </head>
  <body>
    <div class="container">
		<div class="main-body">
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Update Profile</a></li>
        </ol>
      </nav>
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
                <?php if($row['gender']=='M'): ?>
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
              <?php else: ?>
              <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="Admin" class="rounded-circle" width="150">
            <?php endif; ?>
                <div class="mt-3">
                  <h4><?php echo $row['skname']; ?></h4>
                  <p class="text-secondary mb-1">Shopkeeper ID</p>
                  <p class="text-muted font-size-sm"><?php echo $row['skid']; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
              <form>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="skname" class="form-control" value="<?php echo trim($row['skname']);?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Gender</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="gender" class="form-control" value="<?php echo $row['gender'];?>">
								</div>
							</div>
              <div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="address" class="form-control" value="<?php echo $row['address'];?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Phone</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" name="contact"  class="form-control" value="<?php echo $row['contact'];?> ">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Date Of Birth</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="date" name="dob" class="form-control" value=<?php echo $row['dob'];?>>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="submit" name="submit" class="btn btn-primary px-4" value="Save Changes">
								</div>
							</div>
            </form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
  </body>
</html>
