<?php
require('connectdb.php');
include("auth.php");

//set variables and escape special characters
$isbn=mysqli_real_escape_string($con, $_POST['isbn']);
$email=mysqli_real_escape_string($con, $_POST['email']);
$date=$_POST['date'];

//define query
$query="START TRANSACTION;
INSERT INTO reservedby (email, isbn, Resdate) VALUES ('$email','$isbn', '$date');
COMMIT";

//run query
$result=$con->multi_query($query);

//query result
if ($result){
	echo "The book has been reserved, page will refresh soon.";
	header("refresh:1; url=index.php");}
else{
	echo "Add product failed".mysqli_error($con);
	header("refresh:5; url=index.php");
	}
	
CloseCon($con);
?>