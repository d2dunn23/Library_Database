
<?php
require('connectdb.php');
include("adminauth.php");

//set variables and escape special characters
$isbn=mysqli_real_escape_string($con, $_POST['isbn']);

//define query
$query="START TRANSACTION;
DELETE FROM writtenby WHERE isbn='$isbn';
COMMIT;
DELETE FROM books WHERE isbn='$isbn'";

//run query
$result=$con->multi_query($query);

//query results
if ($result){
	echo "Book deleted, page will refresh soon.";
	header("refresh:1; url=admin.php");}
else{
	echo "Add product failed".mysqli_error($con);
	header("refresh:5; url=admin.php");}

CloseCon($con);

?>