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
$result = "UPDATE books, authors, writtenby SET writtenby.Pubdate='$date', writtenby.authorid='$aid', books.isbn='$isbn',books.title='$title', books.pagecount='$pagecount',books.available='$available' WHERE books.isbn='$isbn' AND writtenby.isbn='$isbn'";

//run query and results
if (mysqli_query($con,$result)){
	echo "Catalog updated, page will refresh soon.";
	header("refresh:1; url=admin.php");}
else{
	echo "Upddate failed".mysqli_error($con);
	header("refresh:5; url=admin.php");}
	
CloseCon($con);
?>