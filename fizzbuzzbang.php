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
"css"=>array("fizzbuzzbang.css", "brand.css", "fizzbuzzbang.css"),
"js_head"=>array(),
"js_body"=>array("vendor/underscore/underscore-min.js", "module1_forms.js"),
"fizzbuzz" => false
);

if (isset($_GET) && !empty($_GET)){
	if (isset($_GET['fb_w1']) && isset($_GET['fb_w2']) && isset($_GET['fb_w3']) && isset($_GET['fb_mc']) && isset($_GET['fb_s1']) && isset($_GET['fb_s2']) && isset($_GET['fb_s3'])){
		$fizzBuzz = new FizzBuzz (array("fizzWord" => $_GET['fb_w1'], "buzzWord"=>$_GET['fb_w2'], "bangWord"=>$_GET['fb_w3'], "stepA"=>$_GET['fb_s1'], "stepB"=>$_GET['fb_s2'], "stepC"=>$_GET['fb_s3'], "count"=>$_GET['fb_mc'], "nonum"=> true ));
		$params['fizzbuzz'] = '<div class="output"><ol>'.implode("\n", array_map(function($val) use ($utils){ return ("<li>$val</li>"); },$fizzBuzz->run())).'</ol></div><p class="links"><a href="'.$utils->curPageName().'">Clear</a></p>';
	}
}

$page = array(
"header" => array(
	'<h2>Kevin Anderson Web 250 - Fizzbuzzbang</h2>',
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
	'<h3> Fizz Buzz Bang </h3>',
	'<p>Fizz buzz is a test given to programmers in interviews to test basic logic skills.  The concept is to repeat a 
	combination of words in a loop, where the words are printed out on specific loop cycles based on mathematical rules. 
	The rules for this fizz buzz example are to repeat the entry for word1 on every loop cycle that is evenly divisable by step1,
	the entry for word 2 on every loop cycle that is evenly divisable by step 1 x step 2, and the entry word3 for cycles evenly divisable by step1 x step2 x step 3</p><hr />',
	'<section id="fizzbuzz">
		<div class="content">',
		'<h3>Fizz Buzz via User Input</h3><hr />',
		((is_bool($params['fizzbuzz']) && $params['fizzbuzz'] === false)?
			'<p>Enter three words, the max count, and the numeric steps to see the Fizz Buzz Bang function results</p>
			<form method="GET" action="'.$utils->curPageName().'" name="fizzbuzz_form" id="fizzbuzz_form" onsubmit="return app.validate(this);">
			<div class="line"><label for="fb_w1">Word 1</label><input id="fb_w1" name="fb_w1" type="text" required value="" /></div>
			<div class="line"><label for="fb_w2">Word 2</label><input id="fb_w2" name="fb_w2" type="text" required value="" /></div>
			<div class="line"><label for="fb_w3">Word 3</label><input id="fb_w3" name="fb_w3" type="text" required value="" /></div>
			<div class="line"><label for="fb_mc">Max Count</label><input id="fb_mc" name="fb_mc" type="number" required value="" max="254"/></div>
			<div class="line"><label for="fb_s1">Step 1</label><input id="fb_s1" name="fb_s1" type="number" required value="" max="254"/></div>
			<div class="line"><label for="fb_s2">Step 2</label><input id="fb_s2" name="fb_s2" type="number" required value="" max="254"/></div>
			<div class="line"><label for="fb_s3">Step 3</label><input id="fb_s3" name="fb_s3" type="number" required value="" max="254"/></div>
			<div class="line"><input type="submit" value="Submit" /></div></form>' : $params['fizzbuzz']
		),
		'</div></section>',
	'</div>',

	'</section>'
   )
);


$utils->dumpArrayToPage($utils->getHTMLHeaderArr( $params["title"], $params["css"], $params["js_head"]));
$utils->dumpArrayToPage($utils->getHTMLBody($page["header"], $page["body"], null ,$params['js_body']));













