<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

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
 
 

 
if (isset($_GET) && !empty($_GET)){


$fizzBuzz = new FizzBuzz (array("fizzWord" => $_GET['fb_w1'], "buzzWord"=>$_GET['fb_w2'], "bangWord"=>$_GET['fb_w3'], "stepA"=>3, "stepB"=>5, "stepC"=>7, "count"=>$_GET['fb_mc'], "nonum"=> true ));
echo base64_encode("<ol>".implode("", array_map(function($val){ return ("<li>$val</li>"); },$fizzBuzz->run()))."</ol>");
die();
}

?>

<!DOCTYPE html>
<html > 
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<title>WEB 250 - Kevin Anderson  Module3 Fizz Buzz Bang</title>
	<meta name="description" content="Database Driven Websites - Forms">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/brand.css">
	<link rel="stylesheet" href="css/fbb_m3.css">
	<script src="js/vendor/modernizr.custom.49117.js"></script>


</head>
<body>

<div id="container">
	<div id="header">
		<h2>Let's Play FizzBuzzBang...</h2>
	</div>
	<div id="body">
		<div class="descr">
		<!--<h3>text</h3>-->
		
		<div class="fbb">

			
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
   <script src="js/fbb_m3.js"></script>
   
   <script type="template/text" id="userprompt">
		<div class="greyout">&nbsp;</div>
		<div class="getname">
			<form action="#name" method="GET" onclick="return false;">
			<label for="first_name">Please Enter Your Name</label>
			<input placeholder="Enter Your Name" type="text" id="first_name" name="first_name" required value=""/>
			<span><input type="submit" value="Ok" /></span>
			</form>
		</div>
   
   </script>

   
   <script type="template/text" id="startfizzbang">
		<div class="explain"><h3> Fizz Buzz Bang </h3>
	Fizz buzz is a test given to programmers in interviews to test basic logic skills.  The concept is to repeat a 
	combination of words in a loop, where the words are printed out on specific loop cycles based on mathematical rules. 
	The fizzbuzzbang will print out the words over a combination of intervals, where word one repeats every third row, word two repeats every 5th row, and word three repeats every 7th row.  Any row number where the intervals intersect will print a combination of the words associated with each interval. <p><strong> Start by entering your three words, choosing a loop count, and pressing start:</strong></p><hr /></div>
		<div class="fizzbuzzbang">
			<form action="#fb" method="GET" onclick="return false;">
			<fieldset>
			<div class="line"><label for="fb_w1">Word 1</label><input id="fb_w1" name="fb_w1" type="text" list="list1" required placeholder="First Word" value="" /></div>
			<div class="line"><label for="fb_w2">Word 2</label><input id="fb_w2" name="fb_w2" type="text" list="list2" required placeholder="Second Word"  value="" /></div>
			<div class="line"><label for="fb_w3">Word 3</label><input id="fb_w3" name="fb_w3" type="text" list="list3" required placeholder="Third Word"  value="" /></div>
			<div class="line"><label for="fb_mc">Max Count</label><input placeholder="How many loops" id="fb_mc" name="fb_mc" type="number" required value="" max="254"/></div>
			<div class="line"><input type="submit" value="Start" /></div>
			</fieldset>
			</form>
			
			<datalist id="list3">
			  <option value="JavaScript">
			  <option value="PHP">
			  <option value="MySQL">
			  <option value="HTML5">
			  <option value="CSS">
			</datalist>
			<datalist id="list2">
			  <option value="Plays">
			  <option value="Codes">
			  <option value="Deletes">
			  <option value="Installs">
			  <option value="Upgrades">
			</datalist>
			<datalist id="list1">
			  <option value="FooFighters">
			  <option value="LedZepplin">
			  <option value="SilversunPickups">
			  <option value="BrokenBells">
			  <option value="DaftPunk">
			</datalist>
		</div>
   
   </script>
</body>

</html > 