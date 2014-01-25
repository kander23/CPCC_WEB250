<?php


$formArr = array(
'<div class="simpleform">',
'<form action="web250form1.php" method="get">',
'<div class="line"><label for="fname">Enter your first name&#58;</label><input id="fname" name="fname" type="text" value="" required/></div>',
'<div class="line"><label for="lname">Enter your last name&#58;</label><input id="lname" name="lname" type="text" value="" required/></div>',
'<div class="line"><label for="states">In what state do you reside&#63;</label><select id="states" name="states" ></select></div>',
'<div class="line"><input type="submit" value="Submit"></div>',
'</form></div>'
);


function dumpToPage($param){
	if (is_array($param) && count($param) > 0){
		foreach($param as $key => $str){
			echo $str."\n";
		}
	}
}

?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
       <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <title>WEB 250 - Kevin Anderson</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/form1.css">
        <script src="js/vendor/modernizr-2.7.1.min.js"></script>
<?php

if (isset($_GET) && !empty($_GET)){
	echo '<script>'."\n";
	echo 'var get_data_param = '.json_encode($_GET).';';
	echo '</script>'."\n";
}


?>
</head>
<body>
	<div id="container">
	<div id="header">
		<h2>Kevin Anderson - Web 250</h2>
	
	</div>
	<div id="body">
		<?php
			if (isset($_GET) && empty($_GET)){
				dumpToPage($formArr);
			}
			else{
				if(isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['states'])){
					echo '<div class="result">';
					
					if (strtolower(trim($_GET['states'])) !== "hawaii"){
						echo '<span class="user_name">Hello&nbsp;'.ucfirst($_GET["fname"])." ".ucfirst($_GET["lname"]).'&#33;</span><span class="thestateis">You live in&nbsp;'.$_GET['states'].'<br />';
						echo ("<div> Sorry...all I have is this picture of Hawaii.</div>");
					}
					else{
						echo '<span class="user_name">Hello&nbsp;'.ucfirst($_GET["fname"])." ".ucfirst($_GET["lname"]).'&#33;</span><span class="thestateis">'.$_GET['states'].'&nbsp;is beautiful!</span><br />';
					}
					echo '</div>';
				}
			}
		
		?>
	
	</div>
	<div id="footer">
		<div class="validate">
			<span><a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">
			<img src="./images/validation/vcss-blue.gif" alt="Valid CSS!" /></a></span> 
			<span><a href="http://validator.w3.org/check/referer" target="_blank" >
			<img src="./images/valid_html5.gif" alt="Valid HTML5!" /></a> </span>
         </div>
	
	</div>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
	<script>
		$( document ).ready(function() {
			var statesObj={AL:"Alabama",AK:"Alaska",AS:"American Samoa",AZ:"Arizona",AR:"Arkansas",CA:"California",CO:"Colorado",CT:"Connecticut",DE:"Delaware",DC:"District Of Columbia",FL:"Florida",GA:"Georgia",GU:"Guam",HI:"Hawaii",ID:"Idaho",IL:"Illinois",IN:"Indiana",IA:"Iowa",KS:"Kansas",KY:"Kentucky",LA:"Louisiana",ME:"Maine",MH:"Marshall Islands",MD:"Maryland",MA:"Massachusetts",MI:"Michigan",MN:"Minnesota",MS:"Mississippi",MO:"Missouri",MT:"Montana",NE:"Nebraska",NV:"Nevada",NH:"New Hampshire",NJ:"New Jersey",NM:"New Mexico",NY:"New York",NC:"North Carolina",ND:"North Dakota",OH:"Ohio",OK:"Oklahoma",OR:"Oregon",PW:"Palau",PA:"Pennsylvania",PR:"Puerto Rico",RI:"Rhode Island",SC:"South Carolina",SD:"South Dakota",TN:"Tennessee",TX:"Texas",UT:"Utah",VT:"Vermont",VI:"Virgin Islands",VA:"Virginia",WA:"Washington",WV:"West Virginia",WI:"Wisconsin",WY:"Wyoming"};
			$.each(statesObj, function(idx, value){
				if (value.toLowerCase()=== "hawaii"){
					$('#states').append($('<option>').html(value).prop("value",value).prop("selected", true));
				}
				else{
					$('#states').append($('<option>').html(value).prop("value",value));
				}
			});
	});
		
	</script>
	

    </body>
</html>







