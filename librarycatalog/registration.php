<?php ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration</title>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
	<?php
		require('connectdb.php');
		
		// If form submitted, insert values into the database.
		if (isset($_REQUEST['email'])){
			//set variables and escape special characters
			$name = stripslashes($_REQUEST['name']);
			$name = mysqli_real_escape_string($con,$name);
			$email = stripslashes($_REQUEST['email']);
			$email = mysqli_real_escape_string($con,$email);
			$pw = stripslashes($_REQUEST['pw']);
			$pw = mysqli_real_escape_string($con,$pw);
			//define query
			$query = "INSERT into `users` (email, name, password) VALUES ('$email', '$name', '".md5($pw)."')";
			$result = mysqli_query($con,$query);
			if($result){
				echo "<div class='pagenote'><h3>You have registered successfully. Welcome to the Library!</h3><br/>Click here to <a href='login.php'>Login</a></div>";
			CloseCon($con);
			}
		}else{
	?>
		<!-- display registration form -->
		<div class="pagenote">
			<h2>Library: User Registration</h2>
			<form name="registration" action="" method="post">
				<input type="text" name="name" placeholder="Full Name" required />
				<input type="text" name="email" placeholder="Email" required />
				<input type="password" name="pw" placeholder="Password" required />
				<input type="submit" name="submit" value="Register" />
			</form>
			<p>Already a user? <a href="login.php">Sign in</a></p?
		</div>
	<?php } ?>
</body>
</html>
