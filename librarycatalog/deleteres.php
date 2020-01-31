<?php
require('connectdb.php');
include("adminauth.php");

//set variables and escape special characters
$isbn=mysqli_real_escape_string($con, $_POST['isbn']);
$email=mysqli_real_escape_string($con, $_POST['email']);

//define database query
$result = "DELETE FROM reservedby WHERE isbn='$isbn' AND email='$email'";

//run query and results
if (mysqli_query($con,$result)){
	echo "Reserves updated, page will refresh soon.";
	header("refresh:1; url=admin.php");}
else{
	echo "Upddate failed".mysqli_error($con);
	header("refresh:5; url=admin.php");}
	
CloseCon($con);
?>