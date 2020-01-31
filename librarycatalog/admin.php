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
		//only allow admin users on page
		if ($_SESSION['user']=="no")
		{
			echo "Access not permitted";
			header("Location: index.php"); // Redirect user to index.php
			CloseCon($con);
		}
		
		//query database
		$sel_query="Select * FROM books, writtenby, authors WHERE books.isbn=writtenby.isbn AND writtenby.authorid=authors.authorid ORDER BY books.title";
		$result = mysqli_query($con,$sel_query);
		$sel_query2="Select * FROM books, reservedby WHERE books.isbn=reservedby.isbn ORDER BY books.title";
		$result2 = mysqli_query($con,$sel_query2);
		CloseCon($con);?>
		
		<!-- display $result query -->
		<div class="pagenote">
			<h1>Library Admin</h1>
			<p align="right">Welcome <?php echo $_SESSION['email']; ?><br><a href="logout.php">Logout</a></p>
			
			<div>
				<h2>Update Catalog</h2>
				<table>
				<tr>
				<th><strong>ISBN</strong></th>
				<th><strong>Title</strong></th>
				<th><strong>Pub Date</strong></th>
				<th><strong>Page Count</strong></th>
				<th><strong>Available?</strong></th>
				<th><strong>Author ID</strong></th>
				<th><strong>Author First</strong></th>
				<th><strong>Last</strong></th>
				</tr>
				<?php
				while($row = mysqli_fetch_array($result)) {
					echo "<tr><form action=update.php method=post>";
					echo "<td><input type=text name=isbn value='".$row['isbn']."'></td>";
					echo "<td><input type=text name=title value='".$row['title']."'></td>";
					echo "<td><input type=text name=Pubdate value='".$row['Pubdate']."'></td>";
					echo "<td><input type=text name=pagecount value='".$row['pagecount']."'></td>";
					echo "<td><input type=text name=available value='".$row['available']."'></td>";
					echo "<td><input type=text name=authorid value='".$row['authorid']."'></td>";
					echo "<td>".$row['fname']."</td>";
					echo "<td>".$row['lname']."</td>";
					echo "<td><input type=submit>";
					echo "</form></tr>";
				}?>
				</table>
			</div></div>
			
			<!-- display new book form -->
			<div class="pagenote">
			<div>
				<h2>Add New Book</h2>
				<table>
				<tr>
				<th><strong>ISBN</strong></th>
				<th><strong>Title</strong></th>
				<th><strong>Pub Date</strong></th>
				<th><strong>Page Count</strong></th>
				<th><strong>Available?</strong></th>
				<th><strong><a href="lookup.php" target="blank">Author ID</a></strong></th>
				</tr>
				<?php
					echo "<tr><form action=addbook.php method=post>";
					echo "<td><input type=text name=isbn value=''></td>";
					echo "<td><input type=text name=title value=''></td>";
					echo "<td><input type=text name=Pubdate value=''></td>";
					echo "<td><input type=text name=pagecount value=''></td>";
					echo "<td><input type=text name=available value=''></td>";
					echo "<td><input type=text name=authorid value=''></td>";
					echo "<td><input type=submit>";
					echo "</form></tr>";
				?>
				</table>
			</div></div>
			
			<!-- display form to delete a book -->
			<div class="pagenote">
			<div>
				<h2>Delete a Book</h2>
				<table>
				<tr>
				<th><strong>ISBN</strong></th>
				</tr>
				<?php
					echo "<tr><form action=deletebook.php method=post>";
					echo "<td><input type=text name=isbn value=''></td>";
					echo "<td><input type=submit>";
					echo "</form></tr>";
				?>
				</table>
			</div></div>
			<div class="pagenote">

			<!-- display form to add an author -->
			<div>
				<h2>Add New Author</h2>
				<table>
				<tr>
				<th><strong>First Name</strong></th>
				<th><strong>Last Name</strong></th>
				<th><strong>Author ID (LLNNNN)</strong></th>
				</tr>
				<?php
					echo "<tr><form action=addauthor.php method=post>";
					echo "<td><input type=text name=fname value=''></td>";
					echo "<td><input type=text name=lname value=''></td>";
					echo "<td><input type=text name=authorid value=''></td>";
					echo "<td><input type=submit>";
					echo "</form></tr>";
				?>
				</table>
			</div></div>
			
			<!-- display for to delete an author -->
			<div class="pagenote">
				<div>
				<h2>Delete an Author</h2>
				<table>
				<tr>
				<th><strong><a href="lookup.php" target="blank">Author ID</a></strong></th>
				</tr>
				<?php
					echo "<tr><form action=deleteauthor.php method=post>";
					echo "<td><input type=text name=authorid value=''></td>";
					echo "<td><input type=submit>";
					echo "</form></tr>";
				?>
				</table>
			</div>

		</div>
		
		<!-- display $result2 query -->
		<div class="pagenote">
			<div>
				<h2>Reserved Books</h2>
				<table class="beta">
				<tr>
				<th><strong>ISBN</strong></th>
				<th><strong>Title</strong></th>
				<th><strong>Available?</strong></th>
				<th><strong>User Email</strong></th>
				</tr>
				<?php
				while($row = mysqli_fetch_array($result2)) {
					echo "<tr><form action=deleteres.php method=post>";
					echo "<td><input type=none name=isbn value='".$row['isbn']."'></td>";
					echo "<td>".$row['title']."</td>";
					echo "<td>".$row['available']."</td>";
					echo "<td><input type=none name=email value='".$row['email']."'></td>";
					echo "<td><input type=submit value=Remove>";
					echo "</form></tr>";
				}?>
				</table>
			</div></div>
		</div>
	</body>
</html>