<?php

$contract = array(
'<div id="contract"><div>',
'<ul><li>I, Kevin Anderson, agree to abide by the terms of the course contract in my Spring 2014, WEB 250-85, Database-Driven Websites class with my instructor, D.I. von Briesen.</li>',
'<li>I understand that all work that I do on my school and personal website will be publicly available to the world, and will not put information there that is inappropriate for schoolwork, or that I wish to keep private.</li>',
'<li>I also understand that it is my work that counts for attendance, not logins or showing up for class. As such, failure to turn in assignments may show as absences.</li>',
'<li>Signed: Kevin Anderson, January 17, 2014</li></ul>',
'</div></div>'
);

$header = array(
'<!DOCTYPE html>',
'<html class="no-js">',
'<head>',
'<meta charset="utf-8">',
'<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->',
'<title>WEB 250 - Kevin Anderson</title>',
'<meta name="description" content="Course Contract">',
'<meta name="viewport" content="width=device-width, initial-scale=1">',
'<link rel="stylesheet" href="css/normalize.css">',
'<link rel="stylesheet" href="css/main.css">',
'<link rel="stylesheet" href="css/contract.css">',
'<script src="js/vendor/modernizr-2.7.1.min.js"></script>',
'</head>');


$body1 = array(
'<body><div id="container">',
'<div id="header">',
'<h1>Kevin Anderson, Web 250-85, Course Contract</h1>',
'</div>',
'<div id="body">'
);

$body2 = array(
'</div><!-- end body div -->',
'<div id="footer">',
'<span class="today_date">Today&#39;s Date&#58;&nbsp;'.date("D M d, Y G:i").'</span>',
'<div class="validate">',
'<span><a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">',
'<img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" /></a></span> ',
'<span><a href="http://validator.w3.org/check/referer" target="_blank" >',
'<img src="./images/valid_html5.gif" alt="Valid HTML5!" /></a> </span>',
'</div></div></div>',
'<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>',
'<script>window.jQuery || document.write(\'<script src="js/vendor/jquery/jquery-1.10.2.min.js"><\/script>\')</script>',
'<script src="js/vendor/underscore/underscore-min.js"></script>',
'<script src="js/contract.js"></script>',
'</body></html>'
);




dumpToPage($header);
dumpToPage($body1);
dumpToPage($contract);
dumpToPage($body2);


function dumpToPage($param){
	if (is_array($param) && count($param) > 0){
		foreach($param as $key => $str){
			echo $str."\n";
		}
	}
}



?>


