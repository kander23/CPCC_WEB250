<?php

$ch_data = array(
'<li><p>PHP Basics</p><div class="img_wrap"><img class="evidence_image" alt="php basics" src="./images/php-intro/phpintro_ch2.png"></div></li>',
'<li><p>Using Control Structures and Loops</p><div class="img_wrap"><img class="evidence_image" alt="control structures" src="./images/php-intro/phpintro_ch3.png"></div></li>',
'<li><p>Functions, Objects, and Errors</p><div class="img_wrap"><img class="evidence_image" alt="functions and objects" src="./images/php-intro/phpintro_ch4.png"></div></li>'
);

if (isset($_GET) && (array_key_exists("ch2",$_GET) || array_key_exists("ch3",$_GET) || array_key_exists("ch4",$_GET) )){
	$showall = false;
}
else{
	$showall = true;
}

?>


<!DOCTYPE html>
<html > 
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<title>WEB 250 - Kevin Anderson - <?php echo(($showall)?"PHP ch 3,4,5 Evidence":"Introducing PHP with David Powers" ) ?> </title>
	<meta name="description" content="Database Driven Websites - Brand">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/brand.css">
	<link rel="stylesheet" href="css/phpintro.css">


</head>
<body>

<div id="container">
	<div id="header">
		<h2>WEB 250 - <?php echo(($showall)?"PHP ch 3,4,5 Evidence":"Introducing PHP with David Powers" ) ?> </h2>
	</div>
	<div id="body">
		<div class="descr">
		<p>Kevin Anderson&#39;s PHP Tutorial - Evidence</p>
		
		<div class="palettes">
			
			<ul>
			
			<?php 
				if ($showall){
					foreach($ch_data as $li){
						echo $li."\n";
					}
				
				}
				elseif (isset($_GET["ch2"])){
					echo $ch_data[0]."\n";
				}
				elseif (isset($_GET["ch3"])){
					echo $ch_data[1]."\n";
				}
				elseif (isset($_GET["ch4"])){
					echo $ch_data[2]."\n";
				}
			?>
			
			</ul>
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
   <script src="js/brand.js"></script>
   

</body>

</html > 