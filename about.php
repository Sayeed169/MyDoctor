<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/navbar.css">
<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
<title>My Doctor</title>
<meta charset="utf-8" name="viewpoiint" content="width=device-width, initial-scale=1.0">
</head>

<body>

<ul class="topnav">
		<li class="nav"><a href="index.php">Home</a></li>
		
		<?php  if(isset($_SESSION["first_name"])): ?>
			<li class="dropdown">
			<a class="dropbtn"><?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></a>
				<div class="dropdown-content">
				<a href="profile.php">Profile</a>
				<a href="logout.php">Logout</a>
				</div>
			</li>
			<li class="propic"><img src=<?php echo "/my_test/upload/propic/".$_SESSION['image'];?> id="propic" alt="Profile Picture"></li>
			
			<!--User is doctor or patient-->
			<?php if($_SESSION['dept']==0): ?>
				<li style="float:left; color:black;" class="dropdown">
				<a class="dropbtn" href="#">Make an Appointment</a>
					<div class="dropdown-content">
					<a href="appointment.php">New Appointment</a>
					<a href="oldRecord.php">From Old Record</a>
					</div>
				</li>
				<li style="float:left;"class="dropdown">
				<a class="dropbtn" href="#">Upload Report</a>
					<div class="dropdown-content">
					<a href="#">Old records</a>
					<a href="./report_format/hematology.php">New Blood Report</a>
					<a href="./report_format/stool.php">New Stool Report</a>
					<a href="./report_format/urine.php">New Urine Report</a>
					</div>
				</li>
			<?php else: ?>
				<li class="nav"><a href="doctor.php">Doctor Chamber</a></li>
			<?php endif;?>

		<?php else: ?>
			<li class="dropdown">
			<a class="dropbtn" href="#">Login/Register</a>
				<div class="dropdown-content">
			<a href="login.php">Login</a>
				<a href="register.php">Register</a>
				</div>
			</li>
		<?php endif; ?>
		<li class="nav"><a class="active" href="about.php">About</a></li>
	</ul>

<div class="navpadding">
	<h1><u>About</u></h1>
	<p>This is thesis project of a group from BRAC Univercity. The project is to provide health care via online.</p>
</div>
</body>
</html>