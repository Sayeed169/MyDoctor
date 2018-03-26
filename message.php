<?php
session_start();
require 'class/database.php';

$status = getPayStatus();
$info = expload(readTxt());
$message = $info[1]."<br>".$info[2];
if(!empty(@$_POST['bkash'])){
	setAppointment();
	$status = getPayStatus();
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>My Doctor</title>
	<meta charset="utf-8" name="viewpoiint" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/doctorPatient.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<!--link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet"-->
</head>

<body>
	<ul class="topnav">
		<li class="nav"><a href="index.php">Home</a></li>
		<li class="dropdown">
		<a class="dropbtn" href="#"><?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></a>
			<div class="dropdown-content">
			<a href="profile.php">Profile</a>
			<a href="logout.php">Logout</a>
			</div>
		</li>
		<li class="propic"><img src=<?php echo "/my_test/upload/propic/".$_SESSION['image'];?> id="propic" alt="Profile Picture"></li>
		
		<!--User is a patient-->
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
		<li class="nav"><a href="#">Chat</a></li>
		<li class="nav"><a href="#">Online Pharmacy</a></li>
		<li class="nav"><a href="about.php">About</a></li>
	</ul>

	<div style="padding-top:100px">
		<h2>Appointment date<p><?php echo $message;?></p></h2>
		<h2>Please Recharge Ammount 200/= Taka to Confirm Your Appointment</h2>
		<h1 style="color:red">01788-499-807</h1>
		<p>Submit Your Transaction ID</p>
		<form method="post" action="message.php">
			<input style="border:1px solid gray;" type="text" name="bkash" palceholder="eg. 0123"><br>
			<input type="submit" name="submit" value="Confirm">
		</form>
	</div>
	<?php if($status<0):?>
		<script type='text/javascript'>alert('submitted successfully!')</script>
		<script type="text/javascript">location.href = '/my_test/index.php';</script>
	<?php endif;?>
</body>

</html>

<?php
	/***
	*update user database with bkash number
	*@peram int
	*/
	function setPayStatus(){
		$i = 0;
		$db = new database();
		$conn = $db->db_connect();
		$sql = $conn->prepare("update doctor set bkash=:bkash where id=:id");
		$sql->bindParam(":bkash",$i);
		$sql->bindParam(":id",$_SESSION['user_id']);
		$sql->execute();
		$conn = null;
	}

	/***
	*fetch bkash column data from user database
	*@returns int
	*/
	function getPayStatus(){
		$db = new database();
		$conn = $db->db_connect();
		$sql = $conn->prepare("select * from doctor where id=:id");
		$sql->bindParam(':id',$_SESSION['user_id']);
		$sql->execute();
		$result = $sql->fetchAll();

		return $result[0]['bkash'];
	}

	/***
	*@return String
	*/
	function readTxt(){
		$user = $_SESSION['user_id'];
		$folder = "./upload/report/$user/appointment.txt";
		$file = fopen($folder, 'r');
		$i = 0;
		$str = "";
		while(!feof($file)){
			$str = fgets($file);
		}
		fclose($file);

		return $str;
	}

	/***
	*
	*/
	function expload($str){
		$data[0] = substr($str, 0, 12);
		$data[1] = substr($str, 19, 2)."/".substr($str, 17, 2)."/".substr($str, 15, 2);
		$data[2] = substr($str, 26);

		return $data;
	}

	/***
	*
	*/
	function setAppointment(){
		$db = new database();
		$conn = $db->db_connect();
		$sql = $conn->prepare("update doctor set bkash=-1 where id=:id");
		$sql->bindParam(":id",$_SESSION['user_id']);
		$sql->execute();
	}
?>