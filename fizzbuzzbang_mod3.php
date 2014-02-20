<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

$showForm = true;
if (isset($_GET) && !empty($_GET)){

	$showForm = false;
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
			<input placeholder="Enter Your Name" type="text" id="first_name" name="first_name" value=""/>
			<span><input type="button" value="Ok" /></span>
		</div>
   
   </script>

</body>

</html > 