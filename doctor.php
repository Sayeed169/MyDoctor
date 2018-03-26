<?php
session_start();
require './class/database.php';
$doctor = getlist();
$routine = schedule($doctor[0]['time_slot']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Doctor</title>
	<meta charset="utf-8" name="viewpoiint" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<!--link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet"-->
</head>

<style type="text/css">
table{
	height: 20%;
	width: 40%;
	margin: 100px;
	border: 5px solid gray;
}

th{
	vertical-align:middle;
	border: 1px solid gray;
}
td tr{
	vertical-align:middle;
}

</style>


<body>
<!--Navbar-->
<ul class="topnav">
	<li class="nav"><a href="index.php">Home</a></li>
	<li class="nav"><a class="active" href="doctor.php">Doctor Chamber</a></li>
	<li class="nav"><a href="#">Chat</a></li>
	<li class="nav"><a href="#">Pharmacy</a></li>
	<li class="nav"><a href="about.php">About</a></li>
	
	<?php  if(isset($_SESSION["first_name"])): ?>
		<li class="dropdown">
		<a class="dropbtn" href="#"><?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></a>
			<div class="dropdown-content">
			<a href="profile.php">Profile</a>
			<a href="logout.php">Logout</a>
			</div>
		</li>
		<li class="propic"><img src=<?php echo "/my_test/upload/propic/".$_SESSION['image'];?> id="propic" alt="Profile Picture"></li>
	<?php else: ?>
		<li class="dropdown">
		<a class="dropbtn" href="#">Login/Register</a>
			<div class="dropdown-content">
		<a href="login.php">Login</a>
			<a href="register.php">Register</a>
			</div>
		</li>
	<?php endif; ?>
</ul>

<div class="navpadding">
	<!--h1>This is Doctor Page</h1-->
	<table>
		<tr><th style="text-align:center;">Doctor's Todays Schedule</th></tr>

		<tr>
			<td>Total Patients</td>
			<td><?php echo $doctor[0]['total'];?></td>
		</tr>

		<tr><th>Time</th><th>Number Of Patient</th></tr>
		<?php
			for($i=0; $i<sizeof($routine); $i++){
				$col =  $routine[$i];
				$p = (int)(strlen("".($doctor[0]["t".$col]))/12);
				$str = "";
				echo "<tr><td>$col</td>";
				echo "<td>$p</td></tr>";
			}
		?>
	</table>
	
</div>
</body>
</html>

<?php
/***
*get doctor's schedule of the day
*@return array
**/
function getList(){
	$db = new database();
	$conn = $db->db_connect();

	$table = "t".date("dmy");
	$sql = $conn->prepare("select * from $table where id=:id");
	$sql->bindParam(':id',$_SESSION['user_id']);
	$sql->execute();
	return $sql->fetchAll();
}

/***
*
*
**/
function schedule($str){
	$out;
	$c = 0;
	for($i=0; $i<strlen($str); $i=$i+2){
		$out[$c] = substr($str, $i,2);
		$c++;
	}
	return $out;
}

?>