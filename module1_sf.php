<?php 

define ("ROOT_DIR", './classes/');
 
/*Directories that contain classes*/
$classesDir = array (
  /* ROOT_DIR.'additional_folders/', */
   ROOT_DIR
 );
 
 
function __autoload($class_name) {
   global $classesDir;
   foreach ($classesDir as $directory) { 
       if (file_exists($directory . $class_name . '.php')) {
           require_once ($directory . $class_name . '.php'); 
           return;
       }
	   else if (file_exists($directory . $class_name . '.class.php')) {
           require_once ($directory . $class_name . '.class.php'); 
           return;
       }
    }
 }

  
$utils = new Web250Utils();

$params = array(
"title"=>"WEB 250 - Kevin Anderson - Module 1 - Simple Form Result",
"css"=>array("module1_forms.css"),
"lastname"=>"undefined",
"firstname"=>"undefined",
"age"=>"undefined",
);


if (isset($_GET) && !empty($_GET)){
	if (isset($_GET['sf_fn']) && isset($_GET['sf_ln']) && isset($_GET['sf_age'])){
		$params["lastname"] = $_GET['sf_ln'];
		$params["firstname"] = $_GET['sf_fn'];
		$params["age"] = $_GET['sf_age'];
	}
}
 
$page = array(
"header" => array(
	'<h2>Kevin Anderson Web 250 - Forms</h2>'
	),
"body" => array(
	'<section id="basic">
		<div class="content">
		<h3>Basic User Input Results</h3>
		<hr />
		<p><span>First Name&#58;</span>'.$params["firstname"].'</p>
		<p><span>Last Name&#58;</span>'.$params["lastname"].'</p>
		<p><span>Age&#58;</span>'.$params["age"].'</p>
		</div>
	</section>
		<div id="links">
	    <p><a href="./module1_forms.php">Return to Forms</a></p>
	</div>')
);


$utils->dumpArrayToPage($utils->getHTMLHeaderArr( $params["title"], $params["css"]));
$utils->dumpArrayToPage($utils->getHTMLBody($page["header"], $page["body"]));


?>