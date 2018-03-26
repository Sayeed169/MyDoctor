<?php
/**
* 
*/
class create_tb
{
	
	function __construct()
	{
		# code...
	}

	function run($id){
		require 'class/database.php';
		$db = new database;
		$conn = $db->db_connect();

		// date_default_timezone_set("Asia/Dhaka");
		// $id = "t".date("dmy");

		$sql = $conn->prepare("create table ".$id." 
				(
				id varchar (15),
				total int default 0,
				dept int,
				time_slot varchar (24),
				t00 varchar (45) default 0,
				t01 varchar (45) default 0,
				t02 varchar (45) default 0,
				t03 varchar (45) default 0,
				t04 varchar (45) default 0,
				t05 varchar (45) default 0,
				t06 varchar (45) default 0,
				t07 varchar (45) default 0,
				t08 varchar (45) default 0,
				t09 varchar (45) default 0,
				t10 varchar (45) default 0,
				t11 varchar (45) default 0,
				t12 varchar (45) default 0,
				t13 varchar (45) default 0,
				t14 varchar (45) default 0,
				t15 varchar (45) default 0,
				t16 varchar (45) default 0,
				t17 varchar (45) default 0,
				t18 varchar (45) default 0,
				t19 varchar (45) default 0,
				t20 varchar (45) default 0,
				t21 varchar (45) default 0,
				t22 varchar (45) default 0,
				t23 varchar (45) default 0,
				primary key(id)
				)" );
		try{
			$sql->execute();
			return $id;
			$conn = null;
		}catch(PDOException $e){
			print("Error: ".$e->getMessage());
		}
	}

	function insert_data($table){
		$database = new database;
		$conn = $database->db_connect();

		$sql = $conn->prepare("select id,dept_id,time_slot from doctor where dept_id>0");

		try{
			$sql->execute();
			$result = $sql->fetchAll();

			foreach ($result as $key => $value) {
				$sql = $conn->prepare("insert into ".$table.
					" (id, dept, time_slot) values (:id, :dept, :time)");
				$sql->bindParam(':dept',$value['dept_id']);
				$sql->bindParam(':id',$value['id']);
				$sql->bindParam(':time',$value['time_slot']);
				$sql->execute();
			}$conn = null;
		}catch(PDOException $e){
			print("Error: ".$e->getMessage());
		}
	}
}
?>