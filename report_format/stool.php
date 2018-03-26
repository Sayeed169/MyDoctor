<?php
session_start();

$message = "";
if(!empty(@$_POST['agree'])){
	date_default_timezone_set("Asia/Dhaka");
	$folder = $_SESSION['user_id'];
	$file = "../upload/report/$folder/r_stool".date("y_m_d_h_m").".txt";
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
		<h1>Stool Report Form</h1>
		<p>Please donot fill up unknown fields</p>
		<!--Structure of Report From-->
		<form action="stool.php" method="POST">
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
				<td>Color</td>
				<td><input type="text" name="color" placeholder="0.00"></td>
				<td>Brown</td>
			</tr>

			<tr>
				<td>Odor</td>
				<td><input type="text" name="oder" placeholder="0.00"></td>
				<td>Offensive</td>
			</tr>

			<tr>
				<td>Consistency</td>
				<td><input type="text" name="con" placeholder="0.00"></td>
				<td>Semi-solid</td>			
			</tr>

			<tr>
				<td>Blood</td>
				<td><input type="text" name="blood" placeholder="0.00"></td>
				<td>Nil</td>			
			</tr>

			<tr>
				<td>Mucus</td>
				<td><input type="text" name="mucus" placeholder="0.00"></td>
				<td>(+)</td>
			</tr>

			<tr>
				<th><u><b>CHEMICAL EXAMINATION</b></u></th>
			</tr>

			<tr>
				<td>Reaction</td>
				<td><input type="text" name="react" placeholder="0.00"></td>
				<td>Acidic</td>			
			</tr>

			<tr>
				<td>Reducing Substance</td>
				<td><input type="text" name="rs" placeholder="0.00"></td>
				<td>Not Done</td>
			</tr>

			<tr>
				<td>Occult Blood Test</td>
				<td><input type="text" name="obt" placeholder="0.00"></td>
				<td>Not Done</td>
			</tr>

			<tr>
				<td>Stercobilinogen</td>
				<td><input type="text" name="ster" placeholder="0.00"></td>
				<td>Not Done</td>
			</tr>

			<tr>
				<th><u><b>ON REQUEST</b></u></th>
			</tr>

			<tr>
				<td>Floatation Method</td>
				<td><input type="text" name="float" placeholder="0.00"></td>
				<td>Not Done</td>			
			</tr>

			<tr>
				<th><u><b>MICROSCOPIC EXAMINATION</b></u></th>
			</tr>

			<tr>
				<th><u><b>PROTOZOA</b></u></td>
			</tr>

			<tr>
				<td>Giardia intest</td>
				<td><input type="text" name="gi" placeholder="0.00"></td>
				<td>cyst</td>
			</tr>

			<tr>
				<td>Ent. histolytica</td>
				<td><input type="text" name="ent" placeholder="0.00"></td>
				<td>Not found</td>
			</tr>

			<tr>
				<td>Ent. coli</td>
				<td><input type="text" name="coli" placeholder="0.00"></td>
				<td>Not found</td>
			</tr>

			<tr>
				<th><u><b>O V A OF</b></u></th>
			</tr>

			<tr>
				<td>A. lumbricoides</td>
				<td><input type="text" name="al" placeholder="0.00"></td>
				<td>Not found</td>
			</tr>

			<tr>
				<td>Hook Worm</td>
				<td><input type="text" name="hook" placeholder="0.00"></td>
				<td>Not found</td>
			</tr>

			<tr>
				<td>T. trichiura</td>
				<td><input type="text" name="beso" placeholder="0.00"></td>
				<td>Not found</td>
			</tr>

			<tr>
				<th><u><b>OTHERS</b></u></th>
			</tr>

			<tr>
				<td>R B C</td>
				<td><input type="text" name="rbc" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Pus cells</td>
				<td><input type="text" name="pus" placeholder="0.00"></td>
				<td>Nil</td>

			
			</tr>
				<td>Macrophage</td>
				<td><input type="text" name="macro" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Epithelial Cells</td>
				<td><input type="text" name="ec" placeholder="0.00"></td>
				<td>1-2/HPF</td>
			</tr>
			<tr>
				<td>Vegetable Cells</td>
				<td><input type="text" name="vc" placeholder="0.00"></td>
				<td>(+)</td>
			</tr>

			<tr>
				<td>Starch</td>
				<td><input type="text" name="strach" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Muscle Fibres</td>
				<td><input type="text" name="muscle" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Fat Globules</td>
				<td><input type="text" name="fat" placeholder="0.00"></td>
				<td>Nil</td>
			</tr>

			<tr>
				<td>Yeasts</td>
				<td><input type="text" name="yeats" placeholder="0.00"></td>
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
		$str="";
		if(!empty($_POST['color'])){	
			$str = $str."Color : ".$_POST['color']." ref:[ Brown ]"."\n";
		}	

		if(!empty($_POST['odor'])){	
			$str = $str."Odor : ".$_POST['odor']." ref:[ Offensive ]"."\n";
		}

		if(!empty($_POST['con'])){	
			$str = $str."Consistency : ".$_POST['con']." ref:[ Semi-solid ]"."\n";
		}

		if(!empty($_POST['blood'])){	
			$str = $str."Blood : ".$_POST['blood']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['mucus'])){	
			$str = $str."Mucus : ".$_POST['mucus']." ref:[ (+) ]"."\n";
		}

		if(!empty($_POST['react'])){	
			$str = $str."Reaction : ".$_POST['react']." ref:[ Acidic ]"."\n";
		}

		if(!empty($_POST['rs'])){	
			$str = $str."Reducing Substance : ".$_POST['rs']." ref:[ Not Done ]"."\n";
		}

		if(!empty($_POST['obt'])){	
			$str = $str."Occult Blood Test : ".$_POST['obt']." ref:[ Not Done ]"."\n";
		}
		if(!empty($_POST['float'])){	
			$str = $str."Floatation Method : ".$_POST['float']." ref:[ Not Done ]"."\n";
		}
		if(!empty($_POST['ster'])){	
			$str = $str."Stercobilinogen : ".$_POST['ster']." ref:[ Not Done ]"."\n";
		}
		if(!empty($_POST['gi'])){	
			$str = $str."Giardia intest : ".$_POST['gi']." ref:[ cyst ]"."\n";
		}

		if(!empty($_POST['ent'])){	
			$str = $str."Ent. histolytica : ".$_POST['ent']." ref:[ Not found ]"."\n";
		}
		if(!empty($_POST['coli'])){	
			$str = $str."Ent. coli : ".$_POST['coli']." ref:[ Not found ]"."\n";
		}
		if(!empty($_POST['al'])){	
			$str = $str."A. lumbricoides : ".$_POST['al']." ref:[ Not found ]"."\n";
		}
		if(!empty($_POST['hook'])){	
			$str = $str."Hook Worm : ".$_POST['hook']." ref:[ Not found ]"."\n";
		}
		if(!empty($_POST['beso'])){	
			$str = $str."T. trichiura : ".$_POST['beso']." ref:[ Not found ]"."\n";
		}
		if(!empty($_POST['rbc'])){	
			$str = $str."R B C : ".$_POST['rbc']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['pus'])){	
			$str = $str."Pus cells : ".$_POST['pus']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['macro'])){	
			$str = $str."Macrophage : ".$_POST['macro']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['ec'])){	
			$str = $str."Epithelial Cells : ".$_POST['ec']." ref:[ 1-2/HPF ]"."\n";
		}

		if(!empty($_POST['vc'])){	
			$str = $str."Vegetable Cells : ".$_POST['vc']." ref:[ (+) ]"."\n";
		}
		if(!empty($_POST['starch'])){	
			$str = $str."Starch : ".$_POST['starch']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['muscle'])){	
			$str = $str."Muscle Fibres : ".$_POST['muscle']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['fat'])){	
			$str = $str."Fat Globules : ".$_POST['fat']." ref:[ Nil ]"."\n";
		}
		if(!empty($_POST['yeasts'])){	
			$str = $str."Yeasts : ".$_POST['yeasts']." ref:[ Nil ]"."\n";
		}
		return $str;
	}
 ?>