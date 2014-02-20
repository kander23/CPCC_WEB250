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
$fizzBuzz = new FizzBuzz (array("fizzWord" => "Programming", "buzzWord"=>"Rocks", "stepA"=>3, "stepB"=>5 , "count" => 30, "nonum"=> true));

$params = array(
"title"=>"WEB 250 - Kevin Anderson - Module 1 Forms",
"css"=>array("fizzbuzzbang.css", "brand.css", "fizzbuzzbang.css"),
"js_head"=>array(),
"js_body"=>array("vendor/underscore/underscore-min.js")
);




$page = array(
"header" => array(
	'<h2>Kevin Anderson Web 250 - Fizzbuzz: Branded</h2>',
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
	'<div class="center">',
	'<h3> Fizz Buzz &#8211; Branded </h3>',
	'<p>Fizz buzz is a test given to programmers in interviews to test basic logic skills.  The concept is to repeat a 
	combination of words in a loop, where the words are printed out on specific loop cycles based on mathematical rules. 
	The rules for this fizz buzz example are to repeat the word &#34;Programming&#34; on every loop cycle that is evenly divisable by 3,
	the word &#34;Rocks&#34; on every loop cycle that is evenly divisable by 5, and &#34;Programming Rocks&#34; for cycles evenly divisable by 3 and 5.</p><hr />',
	'<div class="output"><h4>Output&#58;</h4><ol>'.implode("\n", array_map(function($val) use ($utils){ return ("<li>$val</li>"); },$fizzBuzz->run())).'</ol></div>',
	'</div>',
	
	'</section>'
   )
);


$utils->dumpArrayToPage($utils->getHTMLHeaderArr( $params["title"], $params["css"], $params["js_head"]));
$utils->dumpArrayToPage($utils->getHTMLBody($page["header"], $page["body"], null ,$params['js_body']));










