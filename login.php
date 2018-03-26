<?php
session_start();
require 'class/database.php';

if(isset($_SESSION['user_name'])){
	header("Location: /my_test");
}

$message = "";
if(empty($_POST['email']) && empty($_POST['pass'])){
}

else if(empty($_POST['email']) || empty($_POST['pass'])){
	$message = "username or password is empty";
}

else{
	$db = new database();
	$results = $db->db_login('doctor');

	if(count($results)>0 && password_verify($_POST['pass'], $results['password'])){
		$_SESSION['first_name'] = $results['f_name'];
		$_SESSION['last_name'] = $results['l_name'];
		$_SESSION['user_id'] = $results['id'];
		$_SESSION['dept'] = $results['dept_id'];
		$_SESSION['phone'] = $results['phn'];
		$_SESSION['email'] = $results['username'];
		$_SESSION['image'] = $results['image'];
		header("Location: /my_test");
	}else{
		$message = "email or password is incorrect";
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
<!---Navigation Bar-->
<ul class="topnav">
	<li class="nav"><a href="index.php">Home</a></li>
	<!--li class="nav"><a href="patient.php">Patient</a></li>
	<li class="nav"><a href="doctor.php">Doctor</a></li-->
	<li class="nav"><a href="about.php">About</a></li>
	<li  class="nav" style="float:right"><a class="active" href="login.php">Login</a></li>
	<li  class="nav" style="float:right"><a href="register.php">Register</a></li>
</ul>

<h1 style="margin-top:150px; padding:20px">User Login</h1>

<form action="login.php" method="POST">
	<input type="text" name="email" placeholder="Enter your email">
	<input type="password" name="pass" id="pass" placeholder="Enter password">
	<input type="submit"name="submit" value="Log In">
</form>
<?php if(!empty($message)): ?>
<p style="color:red"><?= $message ?></p>
<?php  endif?>
or <a href="register.php">Register</a> for a new Account

</body>

</html>