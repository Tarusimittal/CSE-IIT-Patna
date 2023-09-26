<?php include('server.php');
  include('templates/navbar.php');
  if(empty($_SESSION['username'])) {
      header('location: login.php');
    }

  $dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$dbc) {
   die("Connection failed: " . mysqli_connect_error());
  }
  $username=$_SESSION['username'];

  $phone_number= "";


  $query= "SELECT * FROM users WHERE username= '$username'";
  $data = mysqli_query($db,$query);
  $result=mysqli_fetch_array($data);
  $name=$result['name'];
  $designation=$result['designation'];
  $employeeid=$result['employeeid'];
  $department=$result['department'];
  $phone=$result['phone'];
  $email=$result['email'];
  $number_people = empty($_POST['number_people']) ? 0 : (int)$_POST['number_people'] ;


if(isset($_REQUEST['guest_name'])){
  $guest_name=$_REQUEST['guest_name'];
  $phone_number=$_REQUEST['phone_number'];
  $appartment_number=$_REQUEST['appartment'];
  $city=$_REQUEST['city'];
  $state=$_REQUEST['state'];
  $pin=$_REQUEST['pin'];
  $employee_id=$_REQUEST['employee_id'];
  $indentorname=$_REQUEST['indentorname'];
  $designation=$_REQUEST['designation'];
  $department=$_REQUEST['department'];
  $phone=$_REQUEST['phone'];
  $email=$_REQUEST['email'];
  $room_number_people=$_REQUEST['number_people'];

  $room_payment=$_REQUEST['payment'];
  $room_number_rooms=$_REQUEST['number_rooms'];
  $room_accomodation=$_REQUEST['accomodation'];
  $room_arrival=$_REQUEST['arrival'];
  $room_departure=$_REQUEST['departure'];
  $room_purpose=$_REQUEST['purpose'];
  $room_veg_breakfast=$_REQUEST['veg_breakfast'];
  $room_veg_lunch=$_REQUEST['veg_lunch'];
  $room_veg_dinner=$_REQUEST['veg_dinner'];
  $room_nonveg_breakfast=$_REQUEST['nonveg_breakfast'];
  $room_nonveg_lunch=$_REQUEST['nonveg_lunch'];
  $room_nonveg_dinner=$_REQUEST['nonveg_dinner'];



  $random_id = bin2hex(random_bytes(8));
  $_SESSION['id']=$random_id;

  $sql= "INSERT INTO bookings (id,username,guestname,guestphone,appartment,city,state,pin,employeeid,indentorname,designation,department,phone,email,number_people,payment,number_rooms,accomodation,arrival,departure,purpose,vegbreakfast,veglunch,vegdinner,nonvegbreakfast,nonveglunch,nonvegdinner) VALUES ('$random_id','$username','$guest_name','$phone_number','$appartment_number','$city','$state','$pin','$employee_id','$indentorname','$designation','$department','$phone','$email','$room_number_people','$room_payment','$room_number_rooms','$room_accomodation','$room_arrival','$room_departure','$room_purpose','$room_veg_breakfast','$room_veg_lunch','$room_veg_dinner','$room_nonveg_breakfast','$room_nonveg_lunch','$room_nonveg_dinner')";
  if(!mysqli_query($dbc,$sql)){
    throw new Exception(mysqli_error($dbc));
  }else
  {
    // redirect to homepage
    $_SESSION['username']=$username;
    $_SESSION['email']=$email;
    $_SESSION['id']=$random_id;
    $_SESSION['success'] = "You are now logged in.";

    // heading to chooseroom.php
    header('location: chooseroom.php');
  }


}



?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Guest House Booking Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="css/style_index.css">
<link rel="stylesheet"   href="css/style_booking.css">
</head>
<body>
<div id="root" style="margin-bottom:200px; margin-top:-50px;">
<script src="main.js" type="text/javascript"></script>
<div class="container">
  <form id="contact" action="bookingform.php" method="post">
  <div class="first-container">
    <div id="guestname">
     <h3>GUEST INFORMATION</h3>
     <fieldset>
       <input name="guest_name" placeholder="Guest/Visitor Name" type="text" tabindex="1" required autofocus>
     </fieldset>
     <fieldset>
       <input name="phone_number" placeholder="Phone Number " type="tel" tabindex="2" required>
     </fieldset>
      </div>
    <div id="address">
     <h3>GUEST ADDRESS</h3>
     <fieldset>
       <input name="appartment" placeholder="Flat/appartment/street number" type="text" tabindex="1" required autofocus>
     </fieldset>
     <fieldset>
       <input name="city" placeholder="City" type="text" tabindex="3" required>
     </fieldset>
     <fieldset>
       <input name="state" placeholder="State" type="text" tabindex="4" required>
     </fieldset>
     <fieldset>
       <input name="pin" placeholder="Pin" type="text" tabindex="5" required></>
     </fieldset>
    </div>
    <div id="indentorinfo">
      <h3>INDENTOR INFORMATION</h3>
      <fieldset>
        <input name="employee_id" placeholder="Employee ID" type="text" tabindex="16" required autofocus value="<?php if(isset($employeeid)) {echo $employeeid;} ?> ">
      </fieldset>
      <fieldset>
        <input name="indentorname" placeholder="Indentor Name" type="text" tabindex="17" required value="<?php if(isset($name)){ echo $name;} ?>">
      </fieldset>
      <fieldset>
        <input name="designation" placeholder="Designation" type="text" tabindex="18" required value="<?php if(isset($designation)){ echo $designation;} ?>">
      </fieldset>
      <fieldset>
        <input name="department" placeholder="Department" type="text" tabindex="19" required value="<?php {if(isset($department)) echo $department;} ?>">
      </fieldset>
      <fieldset>
        <input name="phone" placeholder="Phone number" type="tel" tabindex="20" required value="<?php {if(isset($phone)) echo $phone;} ?>">
      </fieldset>
      <fieldset>
        <input name="email" placeholder="Email ID" type="email" tabindex="21" required  value="<?php if(isset($email)) {echo $email;} ?>">
      </fieldset>
      </div>
  </div>
  <div class="second-container">
      <div id="roomrequirement">
        <h3>ROOM DETAILS</h3>
        <fieldset>
          <input id="member" name="number_people" placeholder="Number of person" type="text" tabindex="6" required autofocus>
          <a href="#" id="filldetails" onclick="addFields()">Fill Details</a>
        </fieldset>
        <div id="addinput" />

        </div>
        Payment: <br>
        <fieldset>
        <select name="payment" id="payment">
        <option value="">Please choose an option</option>
        <option value="On Arrival">On Arrival</option>
        <option value="Credit Card">Credit Card</option>
        <option value="Debit Card">Debit Card</option>
        <option value="Beared by Institute.">Beared by Institute</option>
        <!-- <option value="spider"></option> -->
        </select>
        </fieldset>
        <fieldset>
          Number of Rooms: <br>
          <input name="number_rooms" placeholder="Maximum 4 people can stay in one room" type="number" tabindex="7" required>
        </fieldset>
        Accomodation Type: <br>
        <fieldset>
        <select name="accomodation" id="accomodation">
        <option value="">Please choose an option</option>
        <option value="Deluxe">Deluxe</option>
        <option value="Normal">Normal</option>
        <!-- <option value="parrot">Parrot</option>
        <option value="spider">Spider</option>
        <option value="goldfish">Goldfish</option> -->
        </select>
        </fieldset>
        <fieldset>
          Date & Time of arrival : <br>
          <input name="arrival" placeholder="Date & Time of Arrival: " type="datetime-local" tabindex="8" required min=<?php echo date('Y-m-d');?> >
        </fieldset>
        <fieldset>
          Date & Time of departure : <br>
          <input name="departure" placeholder="Date & Time of Departure: " type="datetime-local" tabindex="9" required min=<?php echo date('Y-m-d');?> >
        </fieldset>
        <fieldset>
        Purpose of visit: <br>
        <select name="purpose" id="purpose">
        <option value="">Please choose an option</option>
        <option value="Meeting">Meeting</option>
        <option value="Guest Lecture">Guest Lecture</option>
        <option value="Workshop">Workshop</option>
        <option value="Event">Event</option>
        <!-- <option value="spider">Spider</option>
        <option value="goldfish">Goldfish</option> -->
        </select>
        </fieldset>
        <fieldset>
          Numbers of food Type: <br>
          <ul>
          <li>Veg:
            <ul style="list-style-Type: none;">
            <li><input name="veg_breakfast" type="number" name="Breakfast" tabindex="10"></li>
            <li><input name="veg_lunch" type="number" name="Lunch" tabindex="11"></li>
            <li><input name="veg_dinner" type="number" name="Dinner" tabindex="12"></li>
            </ul>
          </li>
          <br>
          <li>Non-Veg:
            <ul style="list-style-Type: none;">
            <li><input name="nonveg_breakfast" type="number" name="Breakfast" tabindex="13"></li>
            <li><input name="nonveg_lunch" type="number" name="Lunch" tabindex="14"></li>
            <li><input name="nonveg_dinner" type="number" name="Dinner" tabindex="15"></li>
            </ul>
          </ul>
        </fieldset>
        </div>
  </div>
     <fieldset>
       <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
     </fieldset>
   </form>
  </div>
</div>
</body>
</html>
<script type='text/javascript'>
        function addFields(){
            console.log("hi");
            var number = document.getElementById("member").value;
            console.log(number);
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("addinput");
            // Clear previous contents of the container
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
            for (i=1;i<=number;i++){

                // Create an <input> element, set its type and name attributes
                var input = document.createElement("input");
                input.type = "text";
                input.placeholder = "Enter Name of person " + i;
                input.name = "member" + i;
                container.appendChild(input);
                // Append a line break
                container.appendChild(document.createElement("br"));
            }
        }
    </script>
