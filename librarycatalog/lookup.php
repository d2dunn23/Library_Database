<?php
require('connectdb.php');
include("adminauth.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Library Admin</title>
	<link rel="stylesheet" href="style.css" />
</head>
	<body>
	<?php
	
		//query database
		$sel_query="Select * FROM authors";
		$result = mysqli_query($con,$sel_query);
		CloseCon($con);?>
		
		<!-- display author list -->
		<div class="pagenote">
			<h2>Author ID Lookup</h2>
			<p align="right">Welcome <?php echo $_SESSION['email']; ?><br><a href="logout.php">Logout</a></p>
			
			<div>
				<h2>Authors</h2>
				<table>
				<tr>
				<th><strong>First Name</strong></th>
				<th><strong>Last Name</strong></th>
				<th><strong>Author ID</strong></th>
				</tr>
				<?php
				while($row = mysqli_fetch_array($result)) { 
					echo "<tr><td>".$row['fname']."</td>";
					echo "<td>".$row['lname']."</td>";
					echo "<td>".$row['authorid']."</td>";
					echo "</tr>";
				}?>
				</table>
			</div>
		</div>
	</body>
</html>