<?php
session_start();

include "class/database.php";

if(isset($_POST['image'])){
	$db = new database();
	$img = $db->db_insert_image('doctor',$_SESSION['user_id']);
	if($img != null){
		$_SESSION['image'] = $img;
	}
	
}
else if(isset($_POST['info'])){

}
?>

<!DOCTYPE html>
<html>

<head>
<title>My Doctor</title>
<link rel="stylesheet" type="text/css" href="css/navbar.css">
<link rel="stylesheet" type="text/css" href="css/profile.css">
<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
<meta charset="utf-8" name="viewpoiint" content="width=device-width, initial-scale=1.0">
</head>

<body>

<!--Navigation bar-->
<ul class="topnav">
	<li class="nav"><a href="index.php">Home</a></li>


	<?php if(isset($_SESSION["first_name"])): ?>
		<li class="dropdown">
		<a class="dropbtn" href="#"><?php echo $_SESSION['first_name']; ?></a>
			<div class="dropdown-content">
				<a href="profile.php">Profile</a>
				<a href="logout.php">Logout</a>
			</div>
		</li>
		<li class="propic">
			<img src=<?php echo "/my_test/upload/propic/".$_SESSION['image'];?> id="propic" alt="Profile Picture">
		</li>
		<li>
			<?php if($_SESSION['dept']==0):?>
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
				<a href="./report_format/image.php">New Image Report</a>
				</div>
			</li>
			<?php else:?>
			<li class="nav"><a href="doctor.php">Doctor Chamber</a></li>
		<?php endif;?>
		</li>
	<?php else: ?>
		<li class="dropdown">
		<a class="dropbtn" href="#">Login/Register</a>
			<div class="dropdown-content">
				<a href="login.php">Login</a>
				<a href="register.php">Register</a>
			</div>
		</li>
	<?php endif; ?>
	<li class="nav"><a href="about.php">About</a></li>
</ul>

<!--Profile picture-->
<div class="profile"><table>
<tr>
<td>
<img class="profile" src=<?php echo "/my_test/upload/propic/".$_SESSION['image']; ?> alt="Profile Picture">
<form action="profile.php" method="POST" enctype="multipart/form-data">
<input type="file" name="file">
<input class="profiling" type="submit" name="image" value="Change Image">
</td>

<!--Profile Details-->
<td>
First Name:<input type="text" name="fname" placeholder=<?php  echo $_SESSION['first_name']; ?>>
Last Name:<input type="text" name="lname" placeholder=<?php  echo $_SESSION['last_name']; ?>>
Phone:<input type="text" name="phn" placeholder=<?php  echo $_SESSION['phone']; ?>>
e-mail:<input type="text" name="email" placeholder=<?php  echo $_SESSION['email']; ?>>
<input type="submit" name="info" value="Update">
</td>
</tr>

</form></table></div>

</body>
</html>