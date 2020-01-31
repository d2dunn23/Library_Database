<?php
require('connectdb.php');
include("adminauth.php");

//set variables and escape special characters
$isbn=mysqli_real_escape_string($con, $_POST['isbn']);
$title=mysqli_real_escape_string($con, $_POST['title']);
$date=mysqli_real_escape_string($con, $_POST['Pubdate']);
$pagecount=mysqli_real_escape_string($con, $_POST['pagecount']);
$available=mysqli_real_escape_string($con, $_POST['available']);
$aid=mysqli_real_escape_string($con, $_POST['authorid']);

//define query
$query="START TRANSACTION;
INSERT INTO books (books.isbn, books.title, books.pagecount, books.available) VALUES ('$isbn','$title', '$pagecount','$available');
COMMIT;
INSERT INTO writtenby (writtenby.isbn, writtenby.authorid, writtenby.Pubdate) VALUES ('$isbn', '$aid', '$date')";

//run query
$result=$con->multi_query($query);

//query results
if ($result){
	echo "Book added, page will refresh soon";
	header("refresh:1; url=admin.php");}
else{
	echo "Add product failed".mysqli_error($con);
	header("refresh:5; url=admin.php");}
	
CloseCon($con);

?>