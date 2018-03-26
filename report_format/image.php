<?php
session_start();
if(@$_FILES['file']){
	$post_photo=$_FILES['file']['name'];
	$post_photo_tmp=$_FILES['file']['tmp_name'];
	$ext = pathinfo($post_photo, PATHINFO_EXTENSION);
	// getting image extension

	date_default_timezone_set("Asia/Dhaka");
	$_FILES['file']['name'] = date("d.m.y_h.s").".".$ext;
	$post_photo = $_FILES['file']['name'];
	$folder = "../upload/report/".$_SESSION['user_id']."/";
	compressImage($post_photo,$post_photo_tmp,$ext,$folder);

}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Report</title>
	<meta charset="utf-8" name="viewpoiint" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
	<link rel="stylesheet" type="text/css" href="../css/report.css">
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
</head>

<body>
	<ul class="topnav">
		<li class="nav"><a href="../index.php">Home</a></li>
		
		<?php  if(isset($_SESSION["first_name"])): ?>
			<li class="dropdown">
			<a class="dropbtn"><?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></a>
				<div class="dropdown-content">
				<a href="../profile.php">Profile</a>
				<a href="../logout.php">Logout</a>
				</div>
			</li>
			<li class="propic"><img src=<?php echo "/my_test/upload/propic/".$_SESSION['image'];?> id="propic" alt="Profile Picture"></li>
			
			<!--User is doctor or patient-->
			<?php if($_SESSION['dept']==0): ?>
				<li class="nav"><a href="../appointment.php">Make an appointment</a></li>
				<li style="background-color:black; float:left;"class="dropdown">
				<a class="dropbtn" href="#">Upload Report</a>
					<div class="dropdown-content">
					<a href="#">Old records</a>
					<a href="hematology.php">New Blood Report</a>
					<a href="stool.php">New Stool Report</a>
					<a href="urine.php">New Urine Report</a>
					<a href="image.php">New Image Report</a>
					</div>
				</li>
			<?php else: ?>
				<li class="nav"><a href="../doctor.php">Doctor Chamber</a></li>
			<?php endif;?>

		<?php else: ?>
			<li class="dropdown">
			<a class="dropbtn" href="#">Login/Register</a>
				<div class="dropdown-content">
				<a href="../login.php">Login</a>
				<a href="../register.php">Register</a>
				</div>
			</li>
		<?php endif; ?>
		<li class="nav"><a href="../about.php">About</a></li>
	</ul>

	<div style="padding:200px;">
	<form action="image.php" method="post" enctype="multipart/form-data">
		<input type="file" name="file" required alt="Upload A Photo">
		<input type="submit" name="submit" value="Upload">
	</form>

	<?php if(@$_FILES['file']):?>
		<div style="padding:10px;">
			<img src="<?php echo "$folder/$post_photo"; ?>">
		</div>
	<?php endif;?>
	</div>
</body>
</html>

<?php
function compressImage($image,$imageTemp,$ext,$path){

	if(   $ext=='png' || $ext=='PNG' || 
		$ext=='jpg' || $ext=='jpeg' || 
		$ext=='JPG' || $ext=='JPEG' || 
		$ext=='gif' || $ext=='GIF'  )  // checking image extension 
	{
		if($ext=='jpg' || $ext=='jpeg' || $ext=='JPG' || $ext=='JPEG')
		{	 
			$src=imagecreatefromjpeg($imageTemp);
		}
		if($ext=='png' || $ext=='PNG')
		{	 
			$src=imagecreatefrompng($imageTemp);
		}
		if($ext=='gif' || $ext=='GIF')
		{	 
			$src=imagecreatefromgif($imageTemp);
		}

		list($width_min,$height_min)=getimagesize($imageTemp); 
		// fetching original image width and height 
			
		$newwidth_min=350; // set compressing image width 
		
		$newheight_min=($height_min / $width_min) * $newwidth_min; // equation for compressed image height
		
		$tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image
		
		imagecopyresampled($tmp_min, $src, 0,0,0,0,$newwidth_min, $newheight_min, $width_min, 
		$height_min); // compressing image
		
		imagejpeg($tmp_min,$path.$image,80); //copy image in folder//	
	}
}
?>