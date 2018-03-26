<?php
session_start();
require 'class/database.php';

$message = "Select a date";
$status = getPayStatus();

if($status>-1){
	header("Location: /my_test/payment.php");	
}

if(!empty($_POST['dept']) && $_POST['dept']>0){
	$str = appoint();
	$info = setTime($str[0],$str[1]);
	if(!empty($info)){
		setPayStatus();
		/**
		*File Write
		*/
		date_default_timezone_set("Asia/Dhaka");
		$folder = $_SESSION['user_id'];
		$file = "./upload/report/$folder/appointment.txt";

		$write = makeString($info);
		echo $write;

		file_put_contents($file, $write, FILE_APPEND);
		/***/

		header("Location: /my_test/payment.php");
	}else{
		$message = "No doctor Available at this moment";
	}
}else{
	$message = "Please Select a Department";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Doctor</title>
	<meta charset="utf-8" name="viewpoiint" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/doctorPatient.css">
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
		<li style="float:left;" class="dropdown">
		<a class="dropbtn" href="#">Upload Report</a>
			<div class="dropdown-content">
			<a href="#">Old records</a>
			<a href="./report_format/hematology.php">New Blood Report</a>
			<a href="./report_format/stool.php">New Stool Report</a>
			<a href="./report_format/urine.php">New Urine Report</a>
			<a href="./report_format/image.php">New Image Upload</a>
			</div>
		</li>
		<li class="nav"><a href="#">Chat</a></li>
		<li class="nav"><a href="#">Pharmacy</a></li>
		<li class="nav"><a href="about.php">About</a></li>
	</ul>

	<div style="padding-top:100px">
		<?php if(@$_POST['dept']==0): ?>
			<h1>Make An Appointment</h1>
			<form method='POST' action='appointment.php'>
			<table>
				<tr>
					<td class="time"><?php
						date_default_timezone_set("Asia/Dhaka");
						echo "<h2>Today</h2>".date("D--M--Y")."<br><br>";
						echo date("d--m--y")."<br><br>".date("h:m:s");
						?>
					</td>
					<td>
						Select Department<select name="dept">";
						<?php
						$dept = array("Select One","Cardiology","ENT","Hematology",
							"Nurology"," Physiotherapy","Nurition","Diabetes","Medicine");
						for($i=0; $i<count($dept); $i++){
							echo "<option value=$i>".$dept[$i]."</option>";
						}
						echo "</select><br>Appoint Date<select name=date>";

						for ($i=0; $i < 11; $i++){

							echo "<option value=".
							date("dmy",strtotime("+$i day")).">".
							date("d-M-Y",strtotime("+$i day"))."</optiion>";
						}

						echo "</select><br>";
						?>
							
					</td>
				</tr>
			</table>
			<input name='submit' class='submit' type='Submit' value="Make an Appointment"></input><br>
			</form>
			<?php if(!empty($_POST['date']) && ($_POST['dept']==0)):?>
				<span style="color:red">Please select a department</span>
			<?php endif;?>
		<?php endif;?>
	</div>
</body>
</html>

<?php
	/***
	*Fetches list of doctors from database
	*sort them by total number of patients each have
	*@returns array
	**/
	function appoint(){
		$db = new database();
		$conn = $db->db_connect();
		$table = "t".$_POST['date'];

		$sql = $conn->prepare("select * from ".$table." where dept=:dept order by total");
		$sql->bindParam(":dept",$_POST['dept']);
		
		$sql->execute();
		$result = $sql->fetchAll();
		$conn = null;
		
		$str[0] = $table;
		$str[1] = $result;
		return $str;
	}

	/***
	*CSP Algo for load balance
	*chose time for patient
	*returns arrray (converted time,time_slot,doctor id)
	**/
	function setTime($table, $array){
		$db = new database();
		$conn = $db->db_connect();
		
		foreach ($array as $key => $value) {
			$column = 100;
			$colName ="";
			$t=0;
			$d = "";

			for($i=0; $i<strlen($value['time_slot']); $i+=2){
				$time[$i] = $value['time_slot'][$i].$value['time_slot'][$i+1];
			}
			foreach ($time as $val) {
				$col = "t".$val;
				if(strlen($value[$col])<$column){
					$column = strlen($value[$col]);
					$colName = $col;
					$d = $value['id'];
					$t = $val;
				}
				
			}
			if($column<35){
				$sql = $conn->prepare("update $table set total=total+1, 
					$colName=concat($colName,:p_id) where id=:id");
				$sql->bindParam(':p_id',$_SESSION['user_id']);
				$sql->bindParam(':id',$d);
				if($sql->execute()){
					$conn = null;
					$info[0] = $t;
					$info[1] = $value['id'];
					return $info;
				 }
			}else{
				$info = null;
			}
		}
		
		return $info;
	}

	/***
	*Convert 24 h time into 12 h time
	*takes String
	*@param int
	*@returns converted time as String
	**/
	function convert_time($time) {
		// echo substr($time,0);
	    $hours = $time;
	    $minutes = '00';

	    if($hours > 12) { 
	        $hours = $hours - 12;
	        $ampm = 'PM';
	    }else {
	        if ($hours != 11) {
	            $hours = substr($hours, 1, 1);
	        }
	        $ampm = 'AM';
	    }
	    return $hours.' : '.$minutes." ".$ampm;
	}

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

	function makeString($array){
		echo $array[0]."<br>";
		$str = "";
		date_default_timezone_set("Asia/Dhaka");
		$str = "\n".$array[1]." ".$_POST['dept']." ".
		$_POST['date']." ".convert_time($array[0]);
		return $str;
	}

	//<input name="arrayname[item1]">
?>