$( document ).ready(function() {
    console.log( "ready!" );
	// slide in the title
	var $el_hdr = $('#header h1'), h_posHdr, $el_cntrct = $('#contract'), h_posCntrct, 
	/**
	  use jquery to move an element horizontally across the screen
	  @method moveItem
	  @param {number} p_amt value to incrementally move item by (must be evenly divisable by starting value)
	  @param {number} p_targetVal horizontal positional value to approach 
      @param {object} p_target$El jquery reference to target element 
	  @param {string} p_cssParam css atrrinute to adjust
	  @param {number} p_direction negative value moves left, positive value moves right
	  @param {number} p_delay delay in milliseconds between movements
	  @param {function} p_callbackFx - function to call when element movement completes
	*/
	moveItem = function(p_amt, p_targetVal, p_target$El, p_cssParam, p_direction, p_delay, p_callbackFx){
		// recursive function
		if ((p_delay-(p_amt%10)) > 10){
			p_delay = p_delay - (p_amt%10);
		}
		var pos = parseInt((p_target$El.css(p_cssParam)).replace('px', ''), 10), absPos;
		absPos = Math.abs(pos);
		if (( absPos > p_targetVal)){
			if (typeof p_direction === "number" && p_direction > 0 ){
				pos = pos + p_amt;
			}
			else{
				pos = pos - p_amt;
			}
			p_target$El.css(p_cssParam, (pos+"px"));
			setTimeout(function(){ 
				moveItem(p_amt, p_targetVal, p_target$El, p_cssParam, p_direction, p_delay, p_callbackFx);
			}, p_delay);
		
		}
		else{
			if (typeof p_callbackFx === "function"){
				p_callbackFx.call(this, p_target$El);
			}
		}
	
	},
	enableBGColor = function($p_el){
		var $target;
		if ($p_el && $p_el.length){
			$target = $p_el.find('div');
			if ($target && $target.length){
				$target.css('border', '1px solid #0E334E' ); 
				$target.css('border-radius', '10px 10px 10px 10px' ); 
				$target.css('background-color', '#2A5D7A' ); 
			}
		}
	};
	if (($el_hdr && $el_hdr.length) && ($el_cntrct && $el_cntrct.length)){
		h_posHdr =  $el_hdr.css('margin-left');
		
		console.log("pos_hdr "+h_posHdr);
		if (!$el_hdr.is(':visible')){
			$el_hdr.show();
			moveItem(25, 0,  $el_hdr, 'margin-left', 1, 40);
		}
		h_posCntrct = $el_cntrct.css('margin-left');
		console.log("pos_contract: "+h_posCntrct);
		if (!$el_cntrct.is(':visible')){
			$el_cntrct.show();
			// wait 1/2 second for header to start moving before moving the contract text
			setTimeout(function(){
				moveItem(25, 0,  $el_cntrct, 'margin-left', -1, 100, enableBGColor);
			}, 500);
		}
	}
	
	
});