<?php
session_start();

$message = "";
if(!empty(@$_POST['agree'])){
	date_default_timezone_set("Asia/Dhaka");
	$folder = $_SESSION['user_id'];
	$file = "../upload/report/$folder/r_hematology".date("y_m_d_hm").".txt";

	$write = makeString();

	 file_put_contents($file, $write, FILE_APPEND);
}else{
	
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

	<div style="padding:50px; padding-top:100px;">
		<h1>Hematology Report From</h1>
		<p>Please donot fill up unknown fields</p>

		<!--Structure of Report From-->
		<form action="hematology.php" method="POST">
		<table>
			<tr>
				<th>Test</th>
				<th>Result</th>
				<th>Reference Value</th>
			</tr>

			<tr>
				<td>Hamoglobin</td>
				<td><input type="text" name="hamo" placeholder="0.00">g/dL</td>
				<td>F (11.5-15.5), M (12-12) g/dL</td>			
			</tr>

			<tr>
				<td>ESR(Westergren Method)</td>
				<td><input type="text" name="esr" placeholder="0.00">mm/hr</td>
				<td><?php echo "Men <50 Y:<15>50 Y:<20;<br>
				Woman <50 Y:<20>50 Y:<30";?></td>
			</tr>
		
			<tr>
				<th><u><b>Total Count</b></u></th>
			</tr>

			<tr>
				<td>RED Blood Cells</td>
				<td><input type="text" name="rbc" placeholder="0.00">X10e6/uL</td>
				<td>F(3.8-4.8) M(4.5-5.5) X 10e6/uL</td>			
			</tr>

			<tr>
				<td>Plateles</td>
				<td><input type="text" name="plate" placeholder="0.00">X10e3/uL</td>
				<td>150-450 X10e3/uL</td>
			</tr>

			<tr>
				<td>WHITE Blood Cells</td>
				<td><input type="text" name="wbc" placeholder="0.00">X10e3/uL</td>
				<td><?php echo "Adult 4.0-11.0;<br>Child(Birth-1mon):6.0-36.0<br>
				Child(6mon-3yrs):6.0-17.5;<br>Child(4-10years):5.5-14.5";?></td>			
			</tr>

			<tr>
				<th><u><b>Differential Count</b></u></th>
			</tr>

			<tr>
				<td>Neutophil</td>
				<td><input type="text" name="neuto" placeholder="0.00">%</td>
				<td>40 - 75%</td>			
			</tr>

			<tr>
				<td>Lymphocyte</td>
				<td><input type="text" name="lympho" placeholder="0.00">%</td>
				<td>20 - 50%</td>
			</tr>

			<tr>
				<td>Monocyte</td>
				<td><input type="text" name="mono" placeholder="0.00">%</td>
				<td>02 - 10%</td>
			</tr>

			<tr>
				<td>Eosinophil</td>
				<td><input type="text" name="eosin" placeholder="0.00">%</td>
				<td>01 - 06%</td>
			</tr>

			<tr>
				<td>Basophil</td>
				<td><input type="text" name="beso" placeholder="0.00">%</td>
				<td>"< 1%"</td>
			</tr>

			<tr>
				<th><u><b>Differential Count</b></u></th>
			</tr>

			<tr>
				<td>P.C.V (Hct)</td>
				<td><input type="text" name="pcv" placeholder="0.00">%</td>
				<td>"F: 37-47%, M: 40-52%"</td>			
			</tr>

			<tr>
				<td>M.C.V.</td>
				<td><input type="text" name="mcv" placeholder="0.00">fL</td>
				<td>82-10fL</td>
			</tr>

			<tr>
				<td>M.C.H.</td>
				<td><input type="text" name="mch" placeholder="0.00">pg</td>
				<td>27-32 pg</td>
			</tr>

			<tr>
				<td>M.C.H.C.</td>
				<td><input type="text" name="mchc" placeholder="0.00">g/dL</td>
				<td>30 - 35 g/dL</td>
			</tr>

			<tr>
				<td>R.D.W.-C.V.</td>
				<td><input type="text" name="rdwcv" placeholder="0.00">%</td>
				<td>11.60 - 14.00 %</td>
			</tr>

			<tr>
				<td>R.D.W.-S.D.</td>
				<td><input type="text" name="rdwsd" placeholder="0.00">fl</td>
				<td>39.00 - 46.00 fL</td>
			</tr>
		</table>
		<span style="color:red"><?php echo $message;?></span>
		<input type="checkbox" value="yes" name="agree">I am a human<br>
		<input type="submit" name="submit" value="Upload Report">
	</form>
	</div>
	<?php if(!empty($_POST['agree'])):?>
		<script type='text/javascript'>alert('submitted successfully!')</script>
		<script type="text/javascript">location.href = '/my_test/index.php';</script>
	<?php endif;?>
</body>
</html>

<?php
	function makeString(){
		$str = "";

		if(!empty($_POST['hamo'])){
			
			$str = $str."Hamoglobin : ".$_POST['hamo']." ref:[ F (11.5-15.5), M (12-12) g/dL ]\n";
		}	

		if(!empty($_POST['esr'])){
			
			$str = $str."ESR : ".$_POST['esr']." ref:[ Men <50 Y:<15>50 Y:<20; Woman <50 Y:<20>50 Y:<30 ]"."\n";
		}	

		if(!empty($_POST['rbc'])){
			
			$str = $str."RED Blood Cells : ".$_POST['rbc']." ref:[ F(3.8-4.8) M(4.5-5.5) X 10e6/uL ]"."\n";
		}	


		if(!empty($_POST['plate'])){
			
			$str = $str."Plateles : ".$_POST['plate']." ref:[ 150-450 X10e3/uL ]"."\n";
		}


		if(!empty($_POST['wbc'])){
			
			$str = $str."WHITE Blood Cells : ".$_POST['wbc']." ref:[ Adult 4.0-11.0;<br>Child(Birth-1mon):6.0-36.0<br>
				Child(6mon-3yrs):6.0-17.5;<br>Child(4-10years):5.5-14.5	]"."\n";
		}		

		if(!empty($_POST['neuto'])){
			
			$str = $str."Neutophil : ".$_POST['neuto']." ref:[ 40%-75% ]"."\n";
		}	

		if(!empty($_POST['lympho'])){
			
			$str = $str."Lymphocyte : ".$_POST['lympho']." ref:[ 20%-50% ]"."\n";
		}	

		if(!empty($_POST['mono'])){
			
			$str = $str."Monocyte : ".$_POST['mono']." ref:[ 02%-10% ]"."\n";
		}	

		if(!empty($_POST['eosin'])){
			
			$str = $str."Eosinophil : ".$_POST['eosin']." ref:[ 1%-6% ]"."\n";
		}	

		if(!empty($_POST['beso'])){
			
			$str = $str."Basophil : ".$_POST['beso']." ref:[ < 1%]"."\n";
		}

		if(!empty($_POST['pcv'])){
			
			$str = $str."P.C.V (Hct) : ".$_POST['pcv']." ref:[ F: 37-47%, M: 40-52% ]"."\n";
		}	

		if(!empty($_POST['mcv'])){
			
			$str = $str."M.C.V. : ".$_POST['mcv']." ref:[ 82-10fL ]"."\n";
		}	

		if(!empty($_POST['mch'])){
			
			$str = $str."M.C.H. : ".$_POST['mch']." ref:[ 27-32 pg ]"."\n";
		}	

		if(!empty($_POST['mchc'])){
			
			$str = $str."M.C.H.C. : ".$_POST['mchc']." ref:[ 30 - 35 g/dL ]"."\n";
		}	

		if(!empty($_POST['rdwcv'])){
			
			$str = $str."R.D.W.-C.V. : ".$_POST['rdwcv']." ref:[ 11.60 - 14.00 % ]"."\n";
		}	

		if(!empty($_POST['rdwsd'])){
			
			$str = $str."R.D.W.-S.D. : ".$_POST['rdwsd']." ref:[ 39.00 - 46.00 fL ]"."\n";
		}

		return $str;	
	}
?>