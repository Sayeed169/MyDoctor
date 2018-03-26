<?php
require './class/database.php';
session_start();
$data = setData();
$dept_table = getDept();
$status = getPayStatus();
$message = "";

if($status>-1){
	header("Location: /my_test/payment.php");
}

if(@$data[0][@$_POST['rb']]>0){
	makeAppoint(@$data[0][@$_POST['rb']]);
	header("Location: /my_test/message.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Doctor</title>
	<meta charset="utf-8" name="viewpoiint" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/report.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
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
			<a href="./report_format/image.php">New Image Report</a>
			</div>
		</li>
		<li class="nav"><a href="#">Chat</a></li>
		<li class="nav"><a href="#">Pharmacy</a></li>
		<li class="nav"><a href="about.php">About</a></li>
	</ul>

	<div style="padding-top:100px">
	
	<!--Display Old Appoint Record-->
	<form action="oldRecord.php" method="post">
	<table style="width=80%;">
		<tr>
		<td>Select</td>
		<td>Department</td>
		<td>Time</td>
		</tr>

		<tr><td>
			<input type='radio' name='rb'checked='checked' value='-1'>none
		</td></tr>

		<?php
			$doc = $data[0];
			$dept = $data[1];
			$time = $data[2];

			for($i=1; $i<sizeof($doc); $i++){
				echo "<tr>";
				echo "<td><input type='radio' name='rb' value='$i'></td>";
				echo "<td>".$dept_table[$dept[$i]]['name']."</td>";
				echo "<td>".explodeTime($time[$i])."</td>";
				echo "</tr>";
			}
		?>
	</table>
	<input type="submit" method="post" value="Make an Appointment">
	<span style="color:red"><?php echo $message;?></span>
	</form>
	</div>

</body>
</html>

<?php
/**
*
**/
function makeDept($id){
	$table = date("ymd");
	$db = new database();
	$conn = $db->db_connect();
	$sql = $conn->prepare("insert into $table where id=:id and time=:time");
	$sql->bindParam(":id",$id);
	$sql->bindParam(":time",getTime($id));
	$sql->execute();
	$conn = null;
}

/**
*
**/
function getTime($id){
	$db = new database();
	$conn = $db->db_connect();
	$sql = $conn->prepare("select * from doctor where id=:id");
	$sql->bindParam(":id",$id);
	$sql->execute();
	$result = $sql->fetchAll();
	$conn = null;
	return $result;
}

/**
*
**/
function getDept(){
	$db = new database();
	$conn = $db->db_connect();
	$sql = $conn->prepare("select * from dept");
	$sql->execute();
	$result = $sql->fetchAll();
	$conn = null;
	return $result;
}

/***
*
**/
function setData(){
	$user = $_SESSION['user_id'];
	$folder = "./upload/report/$user/appointment.txt";
	$file = fopen($folder, 'r');
	$i = 0;
	while(!feof($file)){
		$str = fgets($file);
		$doc[$i]= substr($str, 0, 12);
		$dept[$i]=substr($str, 13, 1);
		$time[$i]=substr($str, 15);
		$i++;
	}
	fclose($file);
	$data[0]=$doc;
	$data[1]=$dept;
	$data[2]=$time;
	return $data;
}

/***
*
**/
function explodeTime($str){
	$s = substr($str, 0, 2)."/".substr($str, 2, 2)."/".substr($str, 4, 2);
	$s = $s."<br>".substr($str, 7);
	return $s;
}


function makeAppoint($id){
	$db = new database();
	$conn = $db->db_connect();
	date_default_timezone_get("Asia/Dhaka");
	$table = "t".date("dmy");
	$sql = $conn->prepare("update doctor set bkash=0 where id=:id");
	
	$sql->bindParam(":id",$_SESSION['user_id']);
	$sql->execute();
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
?>