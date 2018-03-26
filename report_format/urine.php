<?php
session_start();

$message = "";
if(!empty(@$_POST['agree'])){
	date_default_timezone_set("Asia/Dhaka");
	$folder = $_SESSION['user_id'];
	$file = "../upload/report/$folder/r_urine".date("y_m_d_h_m").".txt";
	$write = makeString();
	echo $write;
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
				<!--li class="nav"><a class="active" href="../report.php">Upload Report</a></li-->
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
		<h1>Urine Report Form</h1>
		<p>Please donot fill up unknown fields</p>
		<!--Structure of Report From-->
		<form action="urine.php" method="POST">
		<table>
			<tr>
				<th>Test</th>
				<th>Result</th>
				<th>Reference Value</th>
			</tr>

			<tr>
				<th><u><b>PHYSICAL EXAMINATION</b></u></th>
			</tr>

			<tr>
				<td>Quantity</td>
				<td><input type="text" name="quantity" placeholder="0.00"></td>
				<td>Sufficient<td>		
			</tr>

			<tr>
				<td>Colour</td>
				<td><input type="text" name="color" placeholder="0.00"></td>
				<td>L.Yellow</td>
			</tr>

			<tr>
				<td>Appearance</td>
				<td><input type="text" name="appear" placeholder="0.00"></td>
				<td>Clear</td>			
			</tr>

			<tr>
				<td>Sediment</td>
				<td><input type="text" name="sediment" placeholder="0.00"></td>
				<td>Nil</td>			
			</tr>

			<tr>
				<th><u><b>CHEMICAL EXAMINATION</b></u></th>
			</tr>

			<tr>
				<td>Reaction</td>
				<td><input type="text" name="reaction" placeholder="0.00"></td>
				<td>Acidic</td>			
			</tr>

			<tr>
				<td>Albumin</td>
				<td><input type="text" name="albumin" placeholder="0.00"></td>
				<td>Trace</td>
			</tr>

			<tr>
				<td>Sugar</td>
				<td><input type="text" name="sugar" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Ex. Phosphate</td>
				<td><input type="text" name="phos" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<th><u><b>ON REQUEST</b></u></th>
			</tr>

			<tr>
				<td>Bile Salt</td>
				<td><input type="text" name="salt" placeholder="0.00"></td>
				<td>Not Done</td>			
			</tr>

			<tr>
				<td>Bile Pigment</td>
				<td><input type="text" name="pigment" placeholder="0.00"></td>
				<td>Not Done</td>
			</tr>

			<tr>
				<td>Ketones</td>
				<td><input type="text" name="keton" placeholder="0.00"></td>
				<td>Not Done</td>
			</tr>

			<tr>
				<td>Urobilinogen</td>
				<td><input type="text" name="urobil" placeholder="0.00"></td>
				<td>Not Done</td>
			</tr>

			<tr>
				<td>B.J. Protein</td>
				<td><input type="text" name="bj" placeholder="0.00"></td>
				<td>Not Done</td>
			</tr>

			<tr>
				<th><u><b>MICROSCOPIC EXAMINATION</b></u></th>
			</tr>

			<tr>
				<th><b><u>CELLS/HPF</u></b></th>
			</tr>

			<tr>
				<td>R B C</td>
				<td><input type="text" name="rbc" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Pus Cells</td>
				<td><input type="text" name="pus" placeholder="0.00"></td>
				<td>4-6/HPF</td>
			</tr>

			<tr>
				<td>Epithelial Cells</td>
				<td><input type="text" name="epi_cell" placeholder="0.00"></td>
				<td>3-4/HPF</td>
			</tr>

			<tr>
				<th><u><b>CASTS/LPF</b></u></th>
			</tr>

			<tr>
				<td>W B C</td>
				<td><input type="text" name="wbc" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Epithelial</td>
				<td><input type="text" name="epi" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Granular</td>
				<td><input type="text" name="granular" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Hyaline</td>
				<td><input type="text" name="hyaline" placeholder="0.00"></td>
				<td>Nil</td>

			<tr>	
				<th><u><b>CRYSTALS & OTHERS</b></u></th>
			</tr>

			</tr>
				<td>Urates</td>
				<td><input type="text" name="urates" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Uric Acid</td>
				<td><input type="text" name="uacid" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>
			<tr>
				<td>Cal. Oxalate</td>
				<td><input type="text" name="cal" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Amor. Phos</td>
				<td><input type="text" name="amor" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Triple Phos</td>
				<td><input type="text" name="triple" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Candida</td>
				<td><input type="text" name="candia" placeholder="0.00"></td>
				<td>Nil</td>
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

		if(!empty($_POST['quantity'])){	
			
			$str = $str."Quantity : ".$_POST['quantity']." ref:[ Sufficient ]"."\n";
		}

		if(!empty($_POST['color'])){	
			$str = $str."Color : ".$_POST['color']." ref:[ L.Yellow ]"."\n";
		}
		if(!empty($_POST['appear'])){	
			$str = $str."Appearance : ".$_POST['appear']." ref:[ Clear ]"."\n";
		}

		if(!empty($_POST['sediment'])){	
			$str = $str."Sediment : ".$_POST['sediment']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['reaction'])){	
			$str = $str."Reaction : ".$_POST['reaction']." ref:[ Acidic ]"."\n";
		}

		if(!empty($_POST['albumin'])){	
			$str = $str."Albumin : ".$_POST['albumin']." ref:[ Trace ]"."\n";
		}

		if(!empty($_POST['sugar'])){	
			$str = $str."Sugar : ".$_POST['sugar']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['phos'])){	
			$str = $str."Ex. Phosphate : ".$_POST['phos']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['salt'])){	
			$str = $str."Bile Salt : ".$_POST['salt']." ref:[ Not Done ]"."\n";
		}
		if(!empty($_POST['pigment'])){	
			$str = $str."Bile Pigment : ".$_POST['pigment']." ref:[ Not Done ]"."\n";
		}

		if(!empty($_POST['keton'])){	
			$str = $str."Ketones : ".$_POST['keton']." ref:[ Not Done ]"."\n";
		}
		if(!empty($_POST['urobil'])){	
			$str = $str."Urobilinogen : ".$_POST['urobil']." ref:[ Not Done ]"."\n";
		}
		if(!empty($_POST['bj'])){	
			$str = $str."B.J. Protein : ".$_POST['bj']." ref:[ Not Done ]"."\n";
		}
		if(!empty($_POST['rbc'])){	
			$str = $str."R B C : ".$_POST['rbc']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['pus'])){	
			$str = $str."Pus Cells : ".$_POST['pus']." ref:[ 4-6/HPF ]"."\n";
		}

		if(!empty($_POST['epi_cell'])){	
			$str = $str."Epithelial Cells : ".$_POST['epi_cell']." ref:[ 3-4/HPF ]"."\n";
		}

		if(!empty($_POST['wbc'])){	
			$str = $str."W B C : ".$_POST['wbc']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['epi'])){	
			$str = $str."Epithelial : ".$_POST['epi']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['granular'])){	
			$str = $str."Granular : ".$_POST['granular']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['hyaline'])){	
			$str = $str."Hyaline : ".$_POST['hyaline']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['urates'])){	
			$str = $str."Urates : ".$_POST['urates']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['uacid'])){	
			$str = $str."Uric Acid : ".$_POST['uacid']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['cal'])){	
			$str = $str."Cal. Oxalate : ".$_POST['cal']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['amor'])){	
			$str = $str."Amor. Phos : ".$_POST['amor']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['triple'])){	
			$str = $str."Triple Phos : ".$_POST['triple']." ref:[ Nil ]"."\n";
		}

		if(!empty($_POST['candia'])){	
			$str = $str."Candida : ".$_POST['candia']." ref:[ Nil ]"."\n";
		}
		return $str;
	}
 ?>