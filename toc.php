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


$params = array(
"title"=>"WEB 250 - Kevin Anderson - Module 1 Forms",
"css"=>array("toc.css"),
"js_head"=>array(),
"js_body"=>array("vendor/underscore/underscore-min.js")
);




$page = array(
"header" => array(
	'<h2>Kevin Anderson Web 250 - Table of Contents</h2>',
	'<nav><ul>
	<li>Home</li>
	<li>Blog</li>
	<li>Reviews</li>
	<li>How To</li>
	<li>Part Picker</li>
	<li>Contact Us</li>
	</ul></nav>',
	),
"body" => array(
	'<section class="main">',
	'<div class="left">',
	'<h3>Class Modules</h3>',
	'<h4>Module 0: Introductions & Getting Started</h4>',
	'<div class="links">
	    <p><a target="_blank" href="./contract.php">Modified Course Contract</a></p>
		<p><a target="_blank" href="./web250form1.php">A Simple PHP Form</a></p>
		<p><a target="_blank" href="./brand.html">Your Brand Page</a></p>
	 </div>',
	'<h4>Module 1</h4>',
	'<div class="links">
	    <p><a target="_blank" href="./module1_forms.php">PHP Forms</a></p>
		<p><a target="_blank" href="./fizzbuzz.php">Your First PHP Page</a></p>
		<p><a target="_blank" href="./fizzbuzz.php?showfb">FizzBuzz Variation</a></p>
	 </div>',
	'<h4>Module 2: Flow Control & Forms</h4>',
	'<div class="links">
	    <p><a target="_blank" href="./toc.php">Create Table of Contents</a></p>
		<p><a target="_blank" href="./fizzbuzz_brand.php">FizzBuzz Branded</a></p>
		<p><a target="_blank" href="./fizzbuzzbang.php">FizzBuzzBang Variation</a></p>
	 </div>',
	'<h4>Module 3: XAMPP</h4>',
	'<div class="links">
	    <p><a target="_blank" href="./phpintro.php">Intro. PHP (Lynda) Evidence - CH1</a></p>
		<p><a target="_blank" href="./formvalidation_mod3.php">Form Validation with HTML5 (Lynda) Evidence</a></p>
		<p><a target="_blank" href="./fizzbuzzbang_mod3.php">FizzBuzzBang - Branded</a></p>
	 </div>',
	'</div>',
	'<div class="right">',
	'<h3>Related Materials</h3>',
	'<div class="links">
		<p><a target="_blank" href="http://moodle.cpcc.edu/user/view.php?id=60449&amp;course=9060">Student Profile</a></p>
	    <p><a target="_blank" href="http://www.codecademy.com/kander23">Codecademy</a></p>
		<p><a target="_blank" href="http://phpfiddle.org/">PHP Fiddle</a></p>
		<p><a target="_blank" href="http://www.lynda.com/PHP-tutorials/Introducing-PHP/123485-2.html">Introducing PHP <br /><span class="indent">with David Powers on Lynda.com</span></a></p>
		<p><a target="_blank" href="http://www.lynda.com/Developer-Databases-tutorials/Validating-Processing-Forms-JavaScript-PHP/120466-2.html">Validating & Processing Forms with JS & PHP <br /><span class="indent">with Ray Villalobos on Lynda.com</span></a></p>
	 </div>',
	'</div>',
	'</section>'
   )
);


$utils->dumpArrayToPage($utils->getHTMLHeaderArr( $params["title"], $params["css"], $params["js_head"]));
$utils->dumpArrayToPage($utils->getHTMLBody($page["header"], $page["body"], null ,$params['js_body']));










