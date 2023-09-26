<?php

include('db.php');

// gardenerid	Name	DoB	Address	contactno	password	gender	username	DoJ

$name = $_POST['name'];
$dob = $_POST['dob'];
$contactno = $_POST['contactno'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$username = $_POST['username'];
$password = $_POST['password'];
$doj = $_POST['doj'];
$password = md5($password);


$sql = "insert into gardener(name,dob,contactno,password,address,gender,username,doj) values('$name','$dob','$contactno','$password','$address','$gender','$username','$doj')";

$result = mysqli_query($db,$sql);

if($result){
        header('location: gardenerlogin.php');
}
else{
    echo mysqli_error($db);
}

// echo '\nQuery execution status: ';


?>
