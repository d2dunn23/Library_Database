
<?php
require('connectdb.php');
include("adminauth.php"); //include auth.php file on all secure pages

//set variables and escape special characters
$aid=mysqli_real_escape_string($con, $_POST['authorid']);

//define query
$query="START TRANSACTION;
DELETE FROM authors WHERE authorid='$aid';
COMMIT";

//run query
$result=$con->multi_query($query);

//query results
if ($result){
	echo "Author Deleted, page will refresh soon.";
	header("refresh:1; url=admin.php");}
else{
	echo "Add product failed".mysqli_error($con);
	header("refresh:5; url=admin.php");}

CloseCon($con);

?>