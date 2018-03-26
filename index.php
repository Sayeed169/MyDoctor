<?php
session_start();
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
	<li class="nav"><a class="active" href="index.php">Home</a></li>
	
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
			<li style="float:left;" class="dropdown">
			<a class="dropbtn" href="#">Upload Report</a>
				<div class="dropdown-content">
				<a href="#">Old records</a>
				<a href="./report_format/hematology.php">New Blood Report</a>
				<a href="./report_format/stool.php">New Stool Report</a>
				<a href="./report_format/urine.php">New Urine Report</a>
				<a href="./report_format/image.php">New Image Report</a>
				</div>
			</li>
			<li class="nav"><a href="#">Chat</a></li>
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
	<li class="nav"><a href="#">Online Phar</a></li>
	<li class="nav"><a href="about.php">About</a></li>
</ul>

<!--Slide  View-->
<script type="text/javascript">
var image1=new Image()
image1.src="http://wallpapersonthe.net/wallpapers/b/1920x1080/1920x1080-dna_dna_strand_digital_strand_art-17178.jpg"
var image2=new Image()
image2.src="http://il8.picdn.net/shutterstock/videos/3048262/thumb/1.jpg"
var image3=new Image()
image3.src="http://wallpapersonthe.net/wallpapers/b/1920x1080/1920x1080-dna_dna_strand_digital_strand_art-17178.jpg"
var image4=new Image()
image4.src="http://il8.picdn.net/shutterstock/videos/3048262/thumb/1.jpg"
var image5=new Image()
image5.src="http://wallpapersonthe.net/wallpapers/b/1920x1080/1920x1080-dna_dna_strand_digital_strand_art-17178.jpg"
var image6=new Image()
image6.src="http://il8.picdn.net/shutterstock/videos/3048262/thumb/1.jpg"
var image7=new Image()
image7.src="http://wallpapersonthe.net/wallpapers/b/1920x1080/1920x1080-dna_dna_strand_digital_strand_art-17178.jpg"
var image8=new Image()
image8.src="http://il8.picdn.net/shutterstock/videos/3048262/thumb/1.jpg"
var image9=new Image()
image9.src="http://wallpapersonthe.net/wallpapers/b/1920x1080/1920x1080-dna_dna_strand_digital_strand_art-17178.jpg"
var image10=new Image()
image10.src="http://il8.picdn.net/shutterstock/videos/3048262/thumb/1.jpg"
</script>








<div style="padding-top: 80px;" class="NewFemusaAdd" id="newfemusadd">            
    <a href="http://www.google.com"><img src="Picture/code-computer-wallpaper.jpg" name="slide" width="80%" height="400px"></a>
    <script type="text/javascript">
    <!--
    var step=1
    function slideit(){
    document.images.slide.src=eval("image"+step+".src")
    if(step<10)
    step++
    else
    step=1
    setTimeout("slideit()",7500)
    }
    slideit()
    </script>
</div>	
<!--slide view ends-->

<div class="navpadding">

<?php  if(isset($_SESSION['first_name'])): ?>
	<p>Welcome <?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></p>
<?php else: ?>
	<h1>Please Register or login</h1>
<?php endif; ?>
</div>
</body>
</html>