<?php

  $con = OpenCon();
  
//function to open databse connection  
  function OpenCon(){
	$dbhost = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "librarycatalog";

    $conn=new mysqli($dbhost,$dbusername, $dbpassword,$dbname) or die ("Database connetion failed: %s\n". $conn->error);
    
     return $conn;
  }

//function to close database connection
   function CloseCon($conn)
  {
    $conn->close();
  } 
?>
