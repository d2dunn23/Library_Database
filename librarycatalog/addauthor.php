<?php
require('connectdb.php');
include("adminauth.php");

//set variables and escape special characters
$fname=mysqli_real_escape_string($con, $_POST['fname']);
$lname=mysqli_real_escape_string($con, $_POST['lname']);
$aid=mysqli_real_escape_string($con, $_POST['authorid']);

//define query
$query="START TRANSACTION;
INSERT INTO authors (fname, lname, authorid) VALUES ('$fname','$lname', '$aid');
COMMIT";

//run query
$result=$con->multi_query($query);

//query results
if ($result){
	echo "Author added, page will refresh soon.";
	header("refresh:1; url=admin.php");}
else{
	echo "Add product failed".mysqli_error($con);
	header("refresh:5; url=admin.php");
	}
	
CloseCon($con);
?>