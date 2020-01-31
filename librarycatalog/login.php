<?php
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
	<?php
		require('connectdb.php');
		session_start();			
		// If form submitted, insert values into the database.
		if (isset($_POST['email'])){
			//set variables and escape special characters
			$user="no";
			$email = stripslashes($_REQUEST['email']);
			$email = mysqli_real_escape_string($con,$email);
			$pw = stripslashes($_REQUEST['pw']);
			$pw = mysqli_real_escape_string($con,$pw);
			
			//query to check for user
			$query = "SELECT * FROM `users` WHERE email='$email' and password='".md5($pw)."'";
			$result = mysqli_query($con,$query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			if($rows==1){
				$_SESSION['email'] = $email;
				$_SESSION['user'] = $user;
				header("Location: index.php"); // Redirect user to index.php
				CloseCon($con);
				}
			else{?>
			<div class="pagenote">
			<h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>;
				<?php }
		}
		else{?>
		
		<!-- display login form -->
		<div class="pagenote">
		<h2>Library User Log In</h2>
		<form action="" method="post" name="login">
			<input type="text" name="email" placeholder="email" required />
			<input type="password" name="pw" placeholder="Password" required />
			<input name="submit" type="submit" value="Login" />
		</form>
		<p>Not registered yet? <a href='registration.php'>Register Here</a></p>
		<p><a href='adminlogin.php'>Admin Login</a></p>
	</div>
	<?php } ?>
</body>
</html>
