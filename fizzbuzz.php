<?php
/**
  @link http://stackoverflow.com/questions/599670/how-to-include-all-php-files-from-a-directory
*/
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

/**
   if the GET paramater "showfb" exists on page load, then the fizz buzz executiong results will be displayed on the page
   @member $utils->fizzbuzz
*/
if (isset($_GET) && array_key_exists("showfb", $_GET)){
	$utils->add(true,"fizzbuzz");
 }
else{
	$utils->add(false, "fizzbuzz");
}
 

 
$fizzBuzz = new FizzBuzz (array("fizzWord" => "Kevin", "buzzWord"=>"Anderson", "stepA"=>3, "stepB"=>5 ));

$params = array(
"title"=>"WEB 250 - Kevin Anderson - Fizz Buzz",
"css"=>array("fizzbuzz.css"),
"js_head"=>array(),
"js_body"=>array("vendor/underscore/underscore-min.js" /*, "fizzbuzz.js" */)
);


$page = array(
"header" => array(
	'<h2>Kevin Anderson Web 250 - Fizz Buzz</h2>'
	),
"body" => array(
	'<p>Welcome to Kevin Anderson&#39;s first php page&#33;</p>',
	'<p>I joined this class as part of my degee, Computer Technology Integration with specialty in Web Technologies. I have been working as a web developer at Windstream Communications since Fall 2011, and I wish to maintain and grow my skill set as a developer through the Web Technologies program at CPCC. I work primarily with an Oracle database, PHP web server, and front end development in Javascript and HTML&#47;CSS</p>',
	'<ul style='.(($utils->fizzbuzz)?'""':"display:none;").'>',
	implode("\n", array_map(function($val) use ($utils){ return (($utils->fizzbuzz)?"<li>$val</li>":""); },$fizzBuzz->run())),
	'</ul>'
   )
);

$utils->dumpArrayToPage($utils->getHTMLHeaderArr( $params["title"], $params["css"], $params["js_head"]));
$utils->dumpArrayToPage($utils->getHTMLBody($page["header"], $page["body"]));
?>

