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
"css"=>array("module1_forms.css"),
"js_head"=>array(),
"js_body"=>array("vendor/underscore/underscore-min.js", "module1_forms.js"),
"form_cntr"=>0,
"adv_form"=>function($p_type)use(&$params, &$utils){ 
			$params["form_cntr"]++;
			$l_type = "GET";
			if (isset($p_type) && strtolower($p_type) === "post"){ $l_type = "POST"; }
			return ('<p>Please fill out the following questionaire</p>
			<form method="'.$l_type.'" action="'.$utils->curPageName().'" class="'.strtolower($l_type).'_form">
			<div class="line"><label for="af_fn'.$params["form_cntr"].'">First Name&#58;</label><input id="af_fn'.$params["form_cntr"].'" name="af_fn'.$params["form_cntr"].'" type="text" required value="" /></div>
			<div class="line"><label for="af_ln'.$params["form_cntr"].'">Last Name&#58;</label><input id="af_ln'.$params["form_cntr"].'" name="af_ln'.$params["form_cntr"].'" type="text" required value="" /></div>
			<div class="line"><label for="af_ln'.$params["form_cntr"].'">SS&#35;&#58;</label><input id="af_ssn'.$params["form_cntr"].'" name="af_ssn'.$params["form_cntr"].'" type="password" value="" /></div>
			<div class="line"><label for="af_ye'.$params["form_cntr"].'">Years of Programming Experience&#58;</label><select id="af_ye'.$params["form_cntr"].'" name="af_ye'.$params["form_cntr"].'"><option value="lt_1">Less Than 1</option><option value="1to4">1&nbsp;&#8211;&nbsp;4</option><option value="5to9">5&nbsp;&#8211;&nbsp;9</option><option value="10plus">10&nbsp;&#43;</option></select></div>
			<div class="line"><div class="half"><label>Favorite Language&#58;</label><ul>
			<li><input type="radio" name="language" value="PHP">&nbsp;PHP</li>
			<li><input type="radio" name="language" value="VB.NET">&nbsp;VB.NET</li>
			<li><input type="radio" name="language" value="JavaScript">&nbsp;JavaScript</li>
			<li><input type="radio" name="language" value="SQL">&nbsp;SQL</li>
			<li><input type="radio" name="language" value="C++">&nbsp;C&#43;&#43;</li>
			<li><input type="radio" name="language" value="Java">&nbsp;Java</li>
			<li><input type="radio" name="language" value="Other">&nbsp;Other</li>
			</ul></div>
			<div class="right"><label>Programming Experiences&#58;</label><ul>
			<li><input type="checkbox" name="position[]" value="contractor">&nbsp;Programming Contractor</li>
			<li><input type="checkbox" name="position[]" value="full time">&nbsp;Full Time Programmer</li>
			<li><input type="checkbox" name="position[]" value="part time">&nbsp;Part Time Programmer</li>
			<li><input type="checkbox" name="position[]" value="self eployed">&nbsp;Self Employed</li>
			<li><input type="checkbox" name="position[]" value="hobbyist">&nbsp;Hobbyist Programmer</li>
			</ul></div></div>
			<div class="line"><label for="af_ta'.$params["form_cntr"].'">Post Your Resume&#58;</label><br />
			<textarea id="af_ta'.$params["form_cntr"].'" name="af_ta'.$params["form_cntr"].'" rows="4" cols="50" maxlength="1000"></textarea>
			</div>
			<div class="line"><input type="submit" value="Submit" /></div>
			</form>'); }
);


$params['fizzbuzz'] = false;
$params['getform'] = false;
$params['postform'] = false;

if (isset($_GET) && !empty($_GET)){
	if (isset($_GET['fb_w1']) && isset($_GET['fb_w2']) && isset($_GET['fb_mc']) && isset($_GET['fb_s1']) && isset($_GET['fb_s2'])){
		$fizzBuzz = new FizzBuzz (array("fizzWord" => $_GET['fb_w1'], "buzzWord"=>$_GET['fb_w2'], "stepA"=>$_GET['fb_s1'], "stepB"=>$_GET['fb_s2'], "count"=>$_GET['fb_mc'] ));
		$params['fizzbuzz'] = '<div class="output"><ul>'.implode("\n", array_map(function($val) use ($utils){ return ("<li>$val</li>"); },$fizzBuzz->run())).'</ul></div><p class="links"><a href="'.$utils->curPageName().'">Clear</a></p>';
	}
	if(isset($_GET['af_fn1']) && isset($_GET['af_ln1'])){
		$params['getform']  = '<div class="results"><p><span>Name&#58;</span>'.$_GET['af_fn1']."&nbsp;".$_GET['af_ln1'].'</p>';
		if (isset($_GET['af_ssn1']) && !empty($_GET['af_ssn1'])){
			$params['getform']  .= '<p><span>SSN&#35;&#58;</span>'.$_GET['af_ssn1'].'</p>';
		}
		if (isset($_GET['af_ye1']) && !empty($_GET['af_ye1'])){
			$years_ex ="";
			switch ($_GET['af_ye1']) {
				case "lt_1":
					$years_ex = "Less Than 1";
					break;
				case "1to4":
					$years_ex = "1 to 4";
					break;
				case "5to9":
					$years_ex = "5 to 9";
					break;
				case "10plus":
					$years_ex = "10&#43;";
					break;
			}
			$params['getform']  .= '<p><span>Years of Experience&#58;</span>'.$years_ex.'</p>';
		}
		if (isset($_GET['language']) && !empty($_GET['language'])){
			$params['getform']  .= '<p><span>Favorite Language&#58;</span>'.$_GET['language'].'</p>';
		}
		if (isset($_GET['position']) && !empty($_GET['position'])){
			$params['getform']  .= '<p><span>Experience As&#58;</span></p><ul>';
			foreach ($_GET['position'] as $pos){
				$params['getform']  .= '<li>'.ucfirst($pos).'</li>';
			
			}
			$params['getform']  .= '</ul>';
		}
		if (isset($_GET['af_ta1']) && !empty($_GET['af_ta1'])){
			$params['getform']  .= '<p><span>Resume&#58;</span><br />'.$_GET['af_ta1'].'</p>';
		}
		$params['getform']  .=  '<p><a href="./'.$utils->curPageName().'">Clear</a></p></div>';
	}
}

if (isset($_POST) && !empty($_POST)){
	if(isset($_POST['af_fn2']) && isset($_POST['af_ln2'])){
		$params['postform']  = '<div class="results"><p><span>Name&#58;</span>'.$_POST['af_fn2']."&nbsp;".$_POST['af_ln2'].'</p>';
		if (isset($_POST['af_ssn2']) && !empty($_POST['af_ssn2'])){
			$params['postform']  .= '<p><span>SSN&#35;&#58;</span>'.$_POST['af_ssn2'].'</p>';
		}
		if (isset($_POST['af_ye2']) && !empty($_POST['af_ye2'])){
			$years_ex ="";
			switch ($_POST['af_ye2']) {
				case "lt_1":
					$years_ex = "Less Than 1";
					break;
				case "1to4":
					$years_ex = "1 to 4";
					break;
				case "5to9":
					$years_ex = "5 to 9";
					break;
				case "10plus":
					$years_ex = "10&#43;";
					break;
			}
			$params['postform']  .= '<p><span>Years of Experience&#58;</span>'.$years_ex.'</p>';
		}
		if (isset($_POST['language']) && !empty($_POST['language'])){
			$params['postform']  .= '<p><span>Favorite Language&#58;</span>'.$_POST['language'].'</p>';
		}
		if (isset($_POST['position']) && !empty($_POST['position'])){
			$params['postform']  .= '<p><span>Experience As&#58;</span></p><ul>';
			foreach ($_POST['position'] as $pos){
				$params['postform']  .= '<li>'.ucfirst($pos).'</li>';
			
			}
			$params['postform']  .= '</ul>';
		}
		if (isset($_POST['af_ta1']) && !empty($_POST['af_ta1'])){
			$params['postform']  .= '<p><span>Resume&#58;</span><br />'.$_POST['af_ta1'].'</p>';
		}
		$params['postform']  .=  '<p><a href="./'.$utils->curPageName().'">Clear</a></p></div>';
	}

}


$page = array(
"header" => array(
	'<h2>Kevin Anderson Web 250 - Forms</h2>'
	),
"body" => array(
	'<div id="links">
	    <p><a href="#basic">Basic Form</a></p>
		<p><a href="#fizzbuzz">Fizzbuzz Form</a></p>
		<p><a href="#get_form">Form using GET</a></p>
		<p><a href="#post_form">Form using POST</a></p>
	</div>
	<section id="basic">
		<div class="content">
		<h3>Basic User Input Form</h3>
		<hr />
		<p>Please fill out the following</p>
		<form method="GET" action="module1_sf.php" name="basic_form" id="basic_form" onsubmit="return app.validate(this);">
			<div class="line"><label for="sf_fn">First Name</label><input id="sf_fn" name="sf_fn" type="text" required value="" /></div>
			<div class="line"><label for="sf_ln">Last Name</label><input id="sf_ln" name="sf_ln" type="text" required value="" /></div>
			<div class="line"><label for="sf_age">Age</label><input id="sf_age" name="sf_age" type="number" required value="" max="120"/></div>
			<div class="line"><input type="submit" value="Submit" /></div>
		</form>
		</div>
	</section>
	<section id="fizzbuzz">
		<div class="content">',
		'<h3>Fizz Buzz via User Input</h3><hr />',
		((is_bool($params['fizzbuzz']) && $params['fizzbuzz'] === false)?
			'<p>Enter two words, the max count, and the numeric steps to see the Fizz Buzz function results</p>
			<form method="GET" action="'.$utils->curPageName().'" name="fizzbuzz_form" id="fizzbuzz_form" onsubmit="return app.validate(this);">
			<div class="line"><label for="fb_w1">Word 1</label><input id="fb_w1" name="fb_w1" type="text" required value="" /></div>
			<div class="line"><label for="fb_w2">Word 2</label><input id="fb_w2" name="fb_w2" type="text" required value="" /></div>
			<div class="line"><label for="fb_mc">Max Count</label><input id="fb_mc" name="fb_mc" type="number" required value="" max="254"/></div>
			<div class="line"><label for="fb_s1">Step 1</label><input id="fb_s1" name="fb_s1" type="number" required value="" max="254"/></div>
			<div class="line"><label for="fb_s2">Step 2</label><input id="fb_s2" name="fb_s2" type="number" required value="" max="254"/></div>
			<div class="line"><input type="submit" value="Submit" /></div></form>' : $params['fizzbuzz']
		),
		'</div>
	</section>
	<section id="get_form">
		<div class="content">
			<h3>User Input Form via GET</h3>
			<hr />',
			((is_bool($params['getform']) && $params['getform'] === false)?$params["adv_form"]() : $params['getform']),
		'</div>
	</section>
	<section id="post_form">
		<div class="content">
			<h3>User Input Form via POST</h3>
			<hr />',
			((is_bool($params['postform']) && $params['postform'] === false)?$params["adv_form"]("POST") : $params['postform']),
		'</div>
	</section>
	
	'
   )
);


$utils->dumpArrayToPage($utils->getHTMLHeaderArr( $params["title"], $params["css"], $params["js_head"]));
$utils->dumpArrayToPage($utils->getHTMLBody($page["header"], $page["body"], null ,$params['js_body']));










