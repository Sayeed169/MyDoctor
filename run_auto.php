<?php

require 'class/create_table.php';

//$id = $c->run();
//$c->insert_data($id);
//echo "$id <- Original <br>";

if(!empty(@$_POST['input'])){
	//set();
	set_var($_POST['input']);
}
function set(){
	date_default_timezone_set("Asia/Dhaka");
	$d=strtotime("+10 Days");

	$id = "t".date("dmy", $d);
	echo $id."<br>";
	$c = new create_tb();
	$c->run($id);
	$c->insert_data($id);
}

function set_var($i){
	date_default_timezone_set("Asia/Dhaka");
	$d=strtotime("+$i Days");

	$id = "t".date("dmy", $d);
	echo $id."<br>";
	$c = new create_tb();
	$c->run($id);
	$c->insert_data($id);
}
?>

<!DOCTYPE html>
<html>
<head></head>
<body>
<form method="post" action="run_auto.php">
	<input type="text" name="input">
	<input type="submit" name="submit">
</form>
</body>
</html>