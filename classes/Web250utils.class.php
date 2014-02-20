<?php
/**
  general use functions for use with web pages developed in web 250
  @class Web250Utils
*/
class Web250Utils {
   
   // internal object storage
   private $self = array();

   /**
      object constructor
      @method contructor
	  @param {object|string|array|int...}  constructor takes an number of parameters and stores them in the local array
	*/
    public function __construct( /*...*/ ) {
        $args = func_get_args();
        for( $i=0, $n=count($args); $i<$n; $i++ ){
            $this->add($args[$i]);
		}
    }
    // punlic accesor
	public function __get( /*string*/ $name = null ) {
        return $this->self[$name];
    }
    /**
	  public setter - returns true if the value was successfully added to the internal array, false if the value was not added
	  @method add
	  @param {object|string|array|int...} $value item to be stored
	  @param {integer|string}  $index  position in array to add
	                           if position is a string, vlaue added at position [string]
							   if position is numner and a valid index, position at [index] overwritten
							   if position > array.length, then the value is added to the end of the array
	  @returns {boolean}
	*/
    public function add($value = null,  $index = null ) {
        $result = false;
		if( isset($value) ){
			if (isset($index)){
				if (is_string($index)){
					$this->self[$index] = $value;
					$result = true;
				}
				else if (is_numeric($index)){
					if ($index < count($this->self)){
						$this->self[$index] = $value;
						$result = true;
					}
					else{
						array_push($this->self, $value);
						$result = true;
					}
				}
			}
			else{
				array_push($this->self, $value);
				$result = true;
			}
		}
		return $result;
    }
	
	/**
	  function to extract the contents of an array and out put it to the pageFeb54yhju7!
	  @method dumpArrayToPage
	  @param {array} array of string to output to the page
	*/
	public function dumpArrayToPage($param){
		if (is_array($param) && count($param) > 0){
			foreach($param as $key => $str){
				if (is_string($str)){
					echo $str."\n";
				}
			}
		}
	}
	/**
	  get the namae of the current page
	  @method curPageName
	  returns {string}
	  @link  http://webcheatsheet.com/php/get_current_page_url.php
	*/
	function curPageName() {
	 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	}
	/**
	  retrieve an html header in array format 
	  for use with the fx dumpArrayToPage()
	  @method getHTMLHeaderArr
	  @param {string} $p_title html page title / decsription (head meta)
	  @param {array} array of css filenames to add to the header, must include path relative to the ./css directory if nested
	  @param {array} array of javascripts filenames to add to the header, must include path relative to the ./js directory if nested
	  @returns {array}
	*/
	public function getHTMLHeaderArr($p_title = "", $p_cssFileArr = array(), $p_jsFileArr = array() ){
	
		$header = array(
			'<!DOCTYPE html>',
			'<html class="no-js">',
			'<head>',
			'<meta charset="utf-8">',
			'<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->',
			'<title>'.$p_title.'</title>',
			'<meta name="description" content="'.$p_title.'">',
			'<meta name="viewport" content="width=device-width, initial-scale=1">',
			'<link rel="stylesheet" href="css/normalize.css">',
			'<link rel="stylesheet" href="css/main.css">',
			'<link rel="stylesheet" href="css/footer.css">',
		);
		
		foreach($p_cssFileArr as $file){
			array_push($header, '<link rel="stylesheet" href="css/'.$file.'">');
		}
		foreach($p_jsFileArr as $file){
			array_push($header, '<script src="js/'.$file.'"></script>');
		}
		
		array_push($header, '<script src="js/vendor/modernizr-2.7.1.min.js"></script>', '</head>' );
		return $header;
	}
	
	/**
	  return the valdation icons html section as an array
	  for use with the fx dumpArrayToPage()
	  @method getValidationElementsArr
	  @returns {array}
	*/
	function getValidationElementsArr(){
		$validation = array(
		'<div class="validate">',
		'<span><a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank">',
		'<img src="./images/validation/css3badge1.png" alt="Valid CSS!" /></a></span>',
		'<span><a href="http://validator.w3.org/check/referer" target="_blank" >',
		'<img src="./images/validation/HTML5_Badge_32.png" alt="Valid HTML5!" /></a> </span>',
		'</div>'		
		);
		return $validation;
	}
	
	function getHTMLBody($p_headerArr = array(), $p_bodyArr = array(), $p_footerArr = array(), $p_jsScriptArr = array()){
		$htmlArr = array(
			'<body>',
			'<div id="container">',
			'<div id="header">'
		);
		
		foreach($p_headerArr as $hdr_line){
			array_push($htmlArr , $hdr_line);
		}
		
	    array_push($htmlArr ,'</div>','<div id="body">');
		
		foreach($p_bodyArr as $bd_line){
			array_push($htmlArr , $bd_line);
		}
		
		array_push($htmlArr ,'</div>','<div id="footer">');
		
		
		foreach($p_footerArr as $ft_line){
			array_push($htmlArr , $ft_line);
		}
		foreach(($this-> getValidationElementsArr()) as $valdt_line){
			array_push($htmlArr , $valdt_line);
		}
		
		array_push($htmlArr ,'</div></div>');
		
		array_push($htmlArr , '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>','<script>window.jQuery || document.write(\'<script src="js/vendor/jquery/jquery-1.10.2.min.js"><\/script>\')</script>');
   
		foreach($p_jsScriptArr as $file){
			array_push($htmlArr , ' <script src="js/'.$file.'"></script>');
		}
		array_push($htmlArr ,'</body></html> ');
		return $htmlArr;
	}
}
   
   

?>