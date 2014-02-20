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
	<title>WEB 250 - Kevin Anderson  Validating & Processing Forms</title>
	<meta name="description" content="Database Driven Websites - Forms">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/formvalidation.css">
	<script src="js/vendor/modernizr.custom.49117.js"></script>


</head>
<body>

<div id="container">
	<div id="header">
		<h2>Validating & Processing Forms with JS & PHP - Evidence</h2>
	</div>
	<div id="body">
		<div class="descr">
		<h3>Kevin Anderson&#39;s CH1 Intro to PHP - Evidence</h3>
		
		<div class="palettes">
			
			<ul>
			<li><p><a href="http://www.lynda.com/JavaScript-tutorials/Understanding-jQuery/120466/133576-4.html">Validating and Processing Forms with JavaScript and PHP with Ray Villalobos</a></p><div class="img_wrap">
			<img class="evidence_image left" alt="form validation" src="images/php-intro/forms-videos1.png">
			<img class="evidence_image2 left" alt="form validation" src="images/php-intro/forms-videos2.png">
			</div></li>
			<li>
			<h3 style="<?php if(!$showForm) { echo "display:none;"; } ?>" >My HTML 5 Form</h3>
			<div class="form_wrap" style="<?php if(!$showForm) { echo "display:none;"; } ?>">
				<form id="newuser" >
				  <fieldset>
					<legend>User Information</legend>
					<div class="line"><label for="first_name">First Name&#58;</label><input placeholder="First Name" name="first_name" id="first_name" type="text" value=""/></div>
					<div class="line"><label for="last_name">Last Name&#58;</label><input placeholder="Last Name" name="last_name" id="last_name" type="text" value=""/></div>
					<div class="line"><label for="state">Residence State&#58;</label><input placeholder="Choose State" list="states" name="state" id="state" type="text" value=""/></div>
					<div class="line"><label for="city">Residence City&#58;</label><input placeholder="Choose City" list="cities" name="city" id="city" type="text" value=""/></div>
					<div class="line"><label for="street">Street Address&#58;</label><input placeholder="Enter Street Address" name="street"  id="street" type="text" value=""/></div>
					<div class="line"><label for="zip">Zip Code&#58;</label><input placeholder="Enter Zip Code" name="zip" id="zip" pattern="(\d{5}([\-]\d{4})?)" value=""/></div>
					<div class="line phone"><label for="phone">Phone Number&#58;</label><input placeholder="Enter Phone Number" name="phone" id="phone" pattern="\d{3}[ \-]\d{3}[ \-]\d{4}" value=""/><br />
					<span><input type="radio" name="phonetype" value="cell">Cell</span>
					<span><input type="radio" name="phonetype" value="home">Home</span>
					<span><input type="radio" name="phonetype" value="work">Work</span>
					</div>
					
					<datalist id="states">
					  <option value="North Carolina">
					  <option value="South Carolina">
					  <option value="Virginia">
					  <option value="Tenessee">
					  <option value="Georgia">
					</datalist>
					<datalist id="cities">
					  <option value="Charlotte">
					  <option value="Asheville">
					  <option value="Greensboro">
					  <option value="Gastonia">
					  <option value="Blacksburg">
					  <option value="Richmond">
					  <option value="Roanoke">
					  <option value="Greevnille">
					  <option value="Minthill">
					  <option value="Mount Holly">
					  <option value="Matthews">
					  <option value="Minthill">
					  <option value="Rockhill">
					  <option value="Greensboro">
					  <option value="Spartanburg">
					  <option value="Columbia">
					  <option value="Atlanta">
					  <option value="Commerce">
					  <option value="Athens">
					  <option value="Knoxville">
					  <option value="Chattanooga">
					  <option value="Johnson City">
					</datalist>
					
				  </fieldset>
				   <fieldset>
					<legend>Account Settings</legend>
					<div class="line"><label for="user_id">Enter a username&#58;</label><input name="user_id" id="user_id" type="text" value=""/></div>
					<div class="line"><label for="password">Enter a password&#58;</label><input name="password" id="password" type="password" value=""/></div>
					<div class="line"><label for="recovery_phrase">Password recovery phrase&#58;</label><input name="recovery_phrase" id="recovery_phrase" type="text" value=""/></div>
				  </fieldset>
				  <fieldset>
					<legend>About</legend>
					<div class="line"><label for="email">Enter your Email&#58;</label><input type="email" name="email" id="email" required placeholder="Enter your email" /></div>
					<div class="line"><label for="birthday">Enter your Birthdate&#58;</label><input type="date" name="birthday" id="birthday" /></div>
					<div class="line"><label for="age">Enter your Age&#58;</label><input type="number" min="5" max="120" name="age" id="age"  placeholder="Enter your age" /></div>
				  </fieldset>
				
					<div class="line"><button type="submit">Submit</button></div>
				</form>
			
			</div>
			<?php
				if (!$showForm){
					echo '<div class="results">';
					echo '<h3>The form submission results&#58;</h3>';
					foreach($_GET as $idx=>$val){
						echo '<div class="line">';
						if ($idx === "password"){
							echo '<label >'.$idx.'</label><span>&#42;&#42;&#42;&#42;&#42;&#42;&#42;&#42;</span>';
						}
						else{
							echo '<label >'.$idx.'</label><span>'.$val.'</span>';
						}
						echo '</div>';
					}
					echo '<div class="line"><input type="button" onclick="return window.location.href = \'formvalidation_mod3.php\'; " value="Clear" /></div>';
					echo '</div>';
				}
				
					
			?>
			</li>
			
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