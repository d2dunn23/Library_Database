<?php
require('connectdb.php');
include("auth.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Library Catalog</title>
	<link rel="stylesheet" href="style.css" />
</head>
	<body>
	<?php
		//query database for lists
		$sel_query="Select * FROM books, writtenby, authors WHERE books.isbn=writtenby.isbn AND writtenby.authorid=authors.authorid ORDER BY books.title";
		$result=mysqli_query($con,$sel_query);
		$session=$_SESSION['email'];
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
			</div></div>
			
			<!-- display search query form -->
			<div class="pagenote">
			<div>
				<h2>Find a Book</h2>
				<table>
				<tr>
				<th><strong>Author Name (First or Last)</strong></th>
				<th></th><th></th>
				<th><strong>Title</strong></th>
				</tr>
				<?php
					echo "<tr><form action=findbook.php method=post>";
					echo "<td><input type=text name=sname value=''></td>";
					echo "<td><input type=submit value=Search></form>";
					echo "<td><form action=findtitle.php method=post></td>";
					echo "<td><input type=text name=stitle value=''></td>";
					echo "<td><input type=submit value=Search></form></tr>";
				?>
				</table>
			</div></div>
			
			<!-- display reservation form query -->
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