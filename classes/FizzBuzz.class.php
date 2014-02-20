<?php

/**

  class to return array of fizz buzz args
  @class FizzBuzz
  @link http://c2.com/cgi/wiki?FizzBuzzTest
*/

class FizzBuzz {
	
	
	private $params;
    /**
	
	  @method constructor
	  @param {array} $p_Arr  parameter array with the following indexes
					fizzWord, buzzWord - strng replacements for the fizz buzz words
					step_a, step_b - integers for the fizz buzz steps
					count - integer for the max itterations of fizzbuzz to run
					defaults to "fizz", "buzz", 3 ,5, 100 if no parameters are provided
	*/
	public function __construct( $p_Arr = array() ) {
		$this->params['wordcnt'] = 2;
		$this->params['addnum'] = true;
		if (isset($p_Arr["nonum"]) && is_bool($p_Arr["nonum"])){
			$this->params['addnum'] = !$p_Arr["nonum"];
		}
		
		if ((isset($p_Arr["fizzWord"]) && isset($p_Arr["buzzWord"])) && (is_string($p_Arr["fizzWord"]) && is_string($p_Arr["buzzWord"]))){
			$this->params["word_a"]	= $p_Arr["fizzWord"];
			$this->params["word_b"]	= $p_Arr["buzzWord"];
		}
		else{
			$this->params["word_a"]	= "fizz";
			$this->params["word_b"]	= "buzz";
		}
		if ((isset($p_Arr["bangWord"]) && is_string($p_Arr["bangWord"])) && (isset($p_Arr["stepC"]) && is_numeric($p_Arr["stepC"]))){
			$this->params['wordcnt'] = 3;
			$this->params["word_c"]	= $p_Arr["bangWord"];
			$this->params["step_c"] = floor($p_Arr["stepC"]);
		}
		if ((isset($p_Arr["stepA"]) && isset($p_Arr["stepB"])) && (is_numeric($p_Arr["stepA"]) && is_numeric($p_Arr["stepB"]))){
			$this->params["step_a"] = floor($p_Arr["stepA"]);
			$this->params["step_b"] = floor($p_Arr["stepB"]);
		}
		else{
			$this->params["step_a"] = 3;
			$this->params["step_b"] = 5;
		}
		if (isset($p_Arr["count"]) && is_numeric($p_Arr["count"])){
			$this->params["count"] = floor($p_Arr["count"]);
		}
		else{
			$this->params["count"] = 100;
		}
	
	}
	
	public function run(){
		$max = $this->params["count"];
		$fb_arr = array();
		for ($i = 1; $i<=$max; $i++) {
			if ($this->params['addnum']){
				$fb_arr[$i] = $i;
			}
			else{
				$fb_arr[$i] = '&nbsp;';
			}
		}
		// mark the fizz 
		for ($i = $this->params["step_a"]; $i <= $max; $i += $this->params["step_a"]) {
			$fb_arr[$i] = $this->params["word_a"];
		}
		// mark the buzz
		for ($i = $this->params["step_b"]; $i <= $max; $i += $this->params["step_b"]) {
			$fb_arr[$i] = $this->params["word_b"];
		}
		
		
		// Mark the fizzbuzz
		$step_c = $this->params["step_a"] * $this->params["step_b"];
		for ($i = $step_c; $i <= $max; $i += $step_c) {
			$fb_arr[$i] = $this->params["word_a"]." ".$this->params["word_b"];
		}
		
		if ($this->params['wordcnt'] === 3){
			
			// MARK THE BANG
			for ($i = $this->params["step_c"]; $i <= $max; $i += $this->params["step_c"]) {
				$fb_arr[$i] = $this->params["word_c"];
			}	
			
			// mark the fizz bang
			$step_d = $this->params["step_a"] * $this->params["step_c"];
			for ($i = $step_d; $i <= $max; $i += $step_d) {
				$fb_arr[$i] = $this->params["word_a"]." ".$this->params["word_c"];
			}
					
			//mark the buzz bang
			$step_e =  $this->params["step_b"] * $this->params["step_c"];
			for ($i = $step_e; $i <= $max; $i += $step_e) {
				$fb_arr[$i] = $this->params["word_b"]." ".$this->params["word_c"];
			}
			
			// Mark the fizzbuzzbang
			$step_f = $this->params["step_a"] * $this->params["step_b"] * $this->params["step_c"];
			for ($i = $step_f; $i <= $max; $i += $step_f) {
				$fb_arr[$i] = $this->params["word_a"]." ".$this->params["word_b"]." ".$this->params["word_c"];
			}


		}

		
		return $fb_arr;
	}
}

?>