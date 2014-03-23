<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

class DBConn {
	
	private $host;
	private $user;
	private $pw;
	private $db;
	private $conn;
	
	public function __construct($obj){
		foreach ($obj as $idx => $val) {
            if (property_exists($this, $idx)){
				$this->{$idx} = $val;
			}
        }
		
		$this->connect();

	}
	function __destruct() {
       $this->conn->close();
    }
	private function connect(){
		if (is_string($this->host) && is_string($this->user) && is_string($this->pw) && is_string($this->db)){
			$this->conn = mysqli_connect($this->host,$this->user, $this->pw, $this->db);
		}
	}
	//  need to add bind variables here - require rewriting to use PDO driver
    //  http://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php
	public function execquery($p_qry, $assoc = true){
		$data = array();
		$cntr = 0;
		if(is_string($p_qry)){
			$result = $this->conn->query($p_qry);
			if ($this->conn->sqlstate != "00000") {
				$data['error'] = true;
				$data['msg'] = 'Could not run query: ' . $this->conn->error;
				return $data;
			}
			else if (is_object($result) && is_numeric($result->num_rows) && $result->num_rows > 0) {
				while ($row = $result->fetch_array((($assoc)? MYSQLI_ASSOC : MYSQLI_NUM))) {
					$data[$cntr]= $row;
					$cntr++;
				}
				
			}
			else if (is_bool($result) && $result === true){
				$data["result_size"] = 0;
			}
			else{
				$data['error'] = true;
				$data['msg'] = 'Unknown error occured performing query';
				return $data;
			}
			
			return $data;
		
		}
	
	}
		
	public function getTblFields($p_tblName, $p_json = false){
		$fields = array();
		if (is_string($p_tblName)){
			$result = $this->execquery('SHOW COLUMNS FROM '.$p_tblName);
			if (is_array($result)){
				foreach ($result as $row){
					if (array_key_exists("Field", $row)){
						array_push($fields, $row["Field"]);				
					}
					else if (array_key_exists("FIELD", $row)){
						array_push($fields, $row["FIELD"]);
					}
					else if(array_key_exists("field", $row)){
						array_push($fields, $row["field"]);
					}
				}
			}
		}
		if ($p_json){
			return json_encode($fields);
		}
		else{
			return $fields;
		}
	}
	
	

}
require_once("classes/mysql_cred.php");

$db = new DBConn(array("host"=>DB_HOST, "user"=>DB_USER, "pw"=>base64_decode(DB_PASSWORD), "db"=>DB_NAME));
//$qryData = $db->execquery('SHOW COLUMNS FROM web250_demo1');

if (isset($_POST) && is_array($_POST) && count($_POST) > 1){
	
	if ( array_key_exists("student_id", $_POST) && is_string($_POST["student_id"]) && strlen($_POST["student_id"]) > 0 ){
		header('Content-type: application/json');
		// save row to the database
		if ( array_key_exists("first_name", $_POST) && array_key_exists("last_name", $_POST) && array_key_exists("hobby", $_POST)){
		
			
			$query = "insert into web250_demo1 (student_id,first_name,last_name,hobby) values ('".$_POST["student_id"]."','".$_POST["first_name"]."','".$_POST["last_name"]."','".$_POST["hobby"]."')";
			$result =$db->execquery($query);
			if (is_array($result) && array_key_exists("error", $result) && is_bool($result["error"]) && $result["error"]){
				 echo json_encode($result);
			}
			else{
				// after the insert query completes run a second query to configm record inserted
				$query = "select student_id from  web250_demo1 where lower(student_id) = lower('".$_POST["student_id"]."')";
				$result = $db->execquery($query);
				if (is_array($result) && count($result) >=1){
					echo json_encode(array("success"=>true));
				}
				else{
					echo json_encode(array("error"=>true, "msg"=>"Insert Failed"));
				}
			}
		}
		// delete a record
		else if (array_key_exists("delete", $_POST)){
			$query = "delete from web250_demo1 where lower(student_id) = lower('".$_POST["student_id"]."')";
			$result =$db->execquery($query);
			if (is_array($result)){
				if ( array_key_exists("error", $result) && is_bool($result["error"]) && $result["error"]){
					echo json_encode($result);
				}
				else if (array_key_exists("result_size", $result) && $result["result_size"] === 0){
					echo json_encode(array("success"=>true));
				}
			}
			else{
				echo json_encode(array("error"=>true, "msg"=>"Unknown error occurred"));
			}
		}
		else{
			echo json_encode(array("error"=>true, "msg"=>"Missing Parameters"));
		}
	}
	else{
		echo json_encode(array("error"=>true, "msg"=>"Missing Parameters"));
	}

	unset($db);
	die();
}
	
?>



<!DOCTYPE html>
<html > 
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<title>WEB 250 - Kevin Anderson - Getting Started with PHP & Databases </title>
	<meta name="description" content="Database Driven Websites - Brand">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/brand.css">
	<link rel="stylesheet" href="css/phpintro.css">
	<link rel="stylesheet" href="css/datatables.css">
	<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.css">

</head>
<body>

<div id="container">
	<div id="header">
		<h2>WEB 250 - Getting Started with PHP & Databases </h2>
	</div>
	<div id="body">
		<div class="descr">
		
		<div class="palettes">
			
			
			<div class="item"><table><thead></thead><tbody></tbody></table></div>
			
		</div>
		
		
		</div>
	</div>
	<div id="footer">
		<div class="validate">
			<span><a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
			<img src="./images/validation/css3badge1.png" alt="Valid CSS!" /></a></span> 
			<span><a href="http://validator.w3.org/check/referer" target="_blank" >
			<img src="./images/validation/HTML5_Badge_32.png" alt="Valid HTML5!" /></a> </span>
		</div>
	</div>
</div>

   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script>window.jQuery || document.write('<script src="js/vendor/jquery/jquery-1.10.2.min.js"><\/script>')</script>
   <script src="js/vendor/underscore/underscore-min.js"></script>
   <script src="js/vendor/datatables/jquery.dataTables.min.js"></script>
   <?php
    if (isset($db) && is_a($db, "DBConn") ){
		echo '<script type="text/javascript">';
		echo " var tblHeaders = ".$db->getTblFields("web250_demo1", true).";";
		echo " var tblData = ".json_encode($db->execquery("select student_id,first_name,last_name,hobby from web250_demo1", false), true).";";
		echo '</script>';
		unset($db);
	}
   ?>
   <script src="js/crud.js"></script>
   

</body>

</html > 
