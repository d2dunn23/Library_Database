<?php
require('connectdb.php');
include("auth.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Library Search</title>
	<link rel="stylesheet" href="style.css" />
</head>
	<body>
	<?php
		$session=$_SESSION['email'];

		//set variables and escape special characters
		$search=mysqli_real_escape_string($con, $_POST['sname']);
		
		//search query
		$sel_query="Select * FROM books, writtenby, authors WHERE books.isbn=writtenby.isbn AND writtenby.authorid=authors.authorid AND (authors.lname LIKE '%{$search}%' OR authors.fname LIKE '%{$search}%') ORDER BY books.title";
		$result=mysqli_query($con,$sel_query);
		
		//reservation query
		$sel_query2="Select * FROM books, reservedby WHERE books.isbn=reservedby.isbn AND reservedby.email='$session' ORDER BY books.title";
		$result2 = mysqli_query($con,$sel_query2);
		CloseCon($con);?>
		
		<!-- display $result query -->
		<div class="pagenote">
			<h1>Library Catalog</h1>
			<p align="right">Welcome <?php echo $_SESSION['email']; ?><br><a href="logout.php">Logout</a></p>
			
			<div>
				<h2>Browse Catalog</h2>
				<table class="beta">
				<tr>
				<th><strong>ISBN</strong></th>
				<th><strong>Title</strong></th>
				<th><strong>Page Count</strong></th>
				<th><strong>Available?</strong></th>
				<th><strong>Author ID</strong></th>
				<th><strong>Author First</strong></th>
				<th><strong>Last</strong></th>
				</tr>
				<?php
				while($row = mysqli_fetch_array($result)) {
					echo "<tr>"."<td>".$row['isbn']."</td>";
					echo "<td>".$row['title']."</td>";
					echo "<td>".$row['pagecount']."</td>";
					echo "<td>".$row['available']."</td>";
					echo "<td>".$row['authorid']."</td>";
					echo "<td>".$row['fname']."</td>";
					echo "<td>".$row['lname']."</td>"."</tr>";
				}?>
				</table>
				<button onclick="window.location.href = 'index.php';">Reset Search</button>
			</div></div>			<!-- display reservation form query -->
			<div class="pagenote">
			<div>
				<h2>Reserve a Book</h2>
				<table>
				<tr>
				<th><strong>ISBN</strong></th>
				</tr>
				<?php
					echo "<tr><form action=resbook.php method=post>";
					echo "<td><input type=text name=isbn value=''></td>";
					echo "<td><input type=hidden name=email value='".$_SESSION['email']."'></td>";
					echo "<td><input type=hidden name=date value='".date("Y-m-d")."'></td>";
					echo "<td><input type=submit>";
					echo "</form></tr>";
				?>
				</table>
			</div></div>
			
			<!-- display $result2 query -->
			<div class="pagenote">
			<div>
				<h2>My Reserved Books</h2>
				<table class="beta">
				<tr>
				<th><strong>ISBN</strong></th>
				<th><strong>Title</strong></th>
				<th><strong>Available?</strong></th>
				</tr>
				<?php
				while($row = mysqli_fetch_array($result2)) {
					echo "<tr>"."<td>".$row['isbn']."</td>";
					echo "<td>".$row['title']."</td>";
					echo "<td>".$row['available']."</td>"."</tr>";
				}?>
				</table>
			</div></div>
		</div>
	</body>
</html>