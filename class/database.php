<?php

/**
* Database class
*/
class database
{
	function __construct()
	{
		# code...
	}

	/***
	*Connect with the database
	*@returns connection
	**/
	function db_connect(){
		$server = 'localhost';
		$username = 'root';
		$password = '';
		$database = 'my_doctor';

		try{
			return $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);

		}catch(PDOException $e){
			print("Connection failed: ".$e->getMessage());
		}
	}

	/***
	*Insert into database
	*@pram table name
	**/
	function db_reg($table){
		$conn = $this->db_connect();
		$sql = $conn->prepare("insert into ".$table.
			" (id, phn, f_name, l_name, username, password)
		 values (:id, :phn, :fname, :lname, :email, :pass)");

		$id = $this->create_id();
		$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

		$sql->bindParam(':id',$id);
		$sql->bindParam(':phn',$_POST['phone']);
		$sql->bindParam(':fname',$_POST['fname']);
		$sql->bindParam(':lname',$_POST['lname']);
		$sql->bindParam(':email',$_POST['email']);
		$sql->bindParam(':pass',$pass);

		if(!$sql->execute()){
			echo "error in database entry";
			die();
		}else{
			mkdir("./upload/report/".$id,0777);
			/**
			*File Write
			*/
			$folder = $_SESSION['user_id'];
			$file = "./upload/report/$folder/appointment.txt";

			file_put_contents($file, "", FILE_APPEND);
		}
	}

	/***
	*Create id usnig Date method
	*@id
	**/
	function create_id(){
		date_default_timezone_set("Asia/Dhaka");
		return date("ymdhis");
	}

	/***
	*Insert profile image
	*@returns file name
	**/
	function db_insert_image($table, $id){
		if($_FILES['file']['name']){
			//determining image type
			// $count = strpos($_FILES['file']['name'],'.');
			// $type = substr($_FILES['file']['name'],$count);
			// $_FILES['file']['name'] = $id.$type;

			//move_uploaded_file($_FILES['file']['tmp_name'], "upload/propic/".$_FILES['file']['name']);

			$post_photo=$_FILES['file']['name'];
			$post_photo_tmp=$_FILES['file']['tmp_name'];
			$ext = pathinfo($post_photo, PATHINFO_EXTENSION);
			$_FILES['file']['name'] = $id.".".$ext;
			$post_photo=$_FILES['file']['name'];
			$folder = "./upload/propic/";
			$this->compressImage($post_photo,$post_photo_tmp,$ext,$folder);

			$conn = $this->db_connect();
			$sql = $conn->prepare("update ".$table." set image = :pic where id = :id");
			$sql->bindParam(':pic',$_FILES['file']['name']);
			$sql->bindParam(':id',$id);

			if(!$sql->execute()){
				$array = $sql->errorInfo();
				print_r ($array);
				return null;
			}else{
				return $_FILES['file']['name'];
			}
			
		}else{
			return null;
		}
	}

	function compressImage($image,$imageTemp,$ext,$path){

		if(   $ext=='png' || $ext=='PNG' || 
			$ext=='jpg' || $ext=='jpeg' || 
			$ext=='JPG' || $ext=='JPEG' )  // checking image extension 
		{
			if($ext=='jpg' || $ext=='jpeg' || $ext=='JPG' || $ext=='JPEG')
			{	 
				$src=imagecreatefromjpeg($imageTemp);
			}
			if($ext=='png' || $ext=='PNG')
			{	 
				$src=imagecreatefrompng($imageTemp);
			}
			// if($ext=='gif' || $ext=='GIF')
			// {	 
			// 	$src=imagecreatefromgif($imageTemp);
			// }

			list($width_min,$height_min)=getimagesize($imageTemp); 
			// fetching original image width and height 
				
			$newwidth_min=350; // set compressing image width 
			
			$newheight_min=($height_min / $width_min) * $newwidth_min; // equation for compressed image height
			
			$tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image
			
			imagecopyresampled($tmp_min, $src, 0,0,0,0,$newwidth_min, $newheight_min, $width_min, $height_min); // compressing image
			
			imagejpeg($tmp_min,$path.$image,80); //copy image in folder//	
		}
	}

	/***
	*@pram database_name, table_name
	*@returns array
	*/
	function db_login($table){
		$conn = $this->db_connect();
		$sql = $conn->prepare("select * from ".$table." where username = :email");
		$sql->bindParam(':email',$_POST['email']);

		if($sql->execute()){
			return $sql->fetch(PDO::FETCH_ASSOC);
		}else{
			echo "error in database";
			return null;
		}
	}

}
?>