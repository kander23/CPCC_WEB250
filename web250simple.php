<?php
if (isset($_GET['age'])){
printHead();
printBody($_GET['age']);	
}
else{
printHead();
printBody();
}


function printHead(){
	echo '<!DOCTYPE html><html ><head>';
	echo '<meta charset="utf-8">';
	echo '<!--[if IE]><meta http-equiv=\'X-UA-Compatible\' content=\'IE=edge,chrome=1\'><![endif]-->';
	echo '<title>WEB 250 - Kevin Anderson</title></head>';
}

function printBody($param){
	if (isset($param) && is_string($param)){
		echo '<body>';
		echo '<p>Your age is: '.$param.'</p>';
		echo '</body></html>';
	}
	else{
		echo '<body>';
		echo '<h1> My Test Page - Kevin Anderson </h1>';
		echo '<form action="web250simple.php" method="get">';
		echo '<h3>Enter your Age?</h3><input id="age" name="age" type="text" value="" /><br />';
		echo '<input type="submit" value="Submit">';
		echo '</form>';
		echo ' <div style="position:absolute;top:300px;left:40%;">
                <span><a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
                <img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" /></a></span> <br />
                <span><a href="http://validator.w3.org/check/referer" target="_blank" >
                <img src="./images/valid_html5.gif" alt="Valid HTML5!" /></a> </span>
            </div>';
		echo '</body></html>';
	}
}
?>