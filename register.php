<?php
//session_start();
/*
if(isset($_SESSION['user_name'])){
	header("Location: /myDoctor");
}*/
require 'class/database.php';

@$email = $_POST['email'];
@$pass = $_POST['pass'];
@$confirm = $_POST['confirm'];
$message = "";

if(isset($_POST['email'])){
	if(!empty($email) && !empty($pass) && !empty($confirm)){
		$db = new database();
		$results = $db->db_login('doctor');

		if(!empty($results)){
			$message = "User already exists, try using differnt email-id";
		}

		else{
			if($pass === $confirm){
			$db->db_reg('doctor');
			header("Location: /my_test/login.php");
			}else{
				$message = "Password do not match";
			}
		}
	}
	else{
		$message = "Fill up all the fields";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
<title>My Doctor</title>
<meta charset="utf-8" name="viewpoiint" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/navbar.css">
<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
</head>

<body>
<ul class="topnav">
	<li class="nav"><a href="index.php">Home</a></li>
	<li class="nav"><a href="about.php">About</a></li>
	<li class="nav" style="float:right"><a href="login.php">Login</a></li>
	<li class="nav" style="float:right"><a class="active" href="register.php">Register</a></li>
</ul>

<h1 style="margin-top:100px">Register</h1>

<form action="register.php" method="POST">
	<input style="width:135px;display:inline;" type="text" name="fname" placeholder="First Name">
	<input style="width:135px; display:inline;" type="text" name="lname" placeholder="Last Name">
	<input type="text" name="phone" placeholder="+88 eg.01*********">
	<input type="text" name="email" placeholder="Enter your email id">
	<input type="password" name="pass" placeholder="Enter password">
	<input type="password" name="confirm" placeholder="Re-type password">
	<input type="submit" name="submit" value="Register">
</form>
<p style="color:red"><?php echo $message;?></p>
</body>
</html>