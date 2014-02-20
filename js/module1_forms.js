/**
  the class for the FormApp functions
  @class FormApp
  @author: kevin anderson
*/
var FormApp = function(){

	if (!(this instanceof FormApp)){
		throw new TypeError("Cannot call FormApp as a function");
	}
	if (!window.jQuery) {
		throw new TypeError("FormApp requires jQuery");
	}

}

FormApp.prototype = {
	constructor: FormApp,
	/**
	  determine which validation function to use based on the input ids
	  @method routeValidator
	  @param {object} $el jquery search result for all the inputs in the form that fired the validate event
	*/
	routeValidator : function($el){
		var targetId, result = false;
		try{
			if ($el.length){
				targetId = $el.eq(0).attr('id');
				switch((targetId.substr(0, targetId.indexOf("_"))).toLowerCase()){
					case 'sf':
						result = this.validateSimple($el);
					break;
					case 'fb':
						result = this.validateFizzBuzz($el);
					break;
				}
			}
		}
		catch(e){
			console.log(e.message);
		}
		return result;
	},
	/**
	  generic entry point for all php form validation calls - routes to the correct validation function
	  @method validate
	  @param {object} "this" instance of the form from the onsubmit call
	*/
	validate : function(p_form){
		var result = false, $form = $(p_form).find('input');
		result = this.routeValidator($form);
		return result;
	},
	/**
	  validate the inputs in the simple php form
	  @method validateSimple
	  @param  {object} $el jquery search result for all the inputs in the form that fired the validate event
	*/
	validateSimple : function($el){
		var result = true, $target, MAX_AGE = 120, field_value;
		$el.each(function(idx, el){
			if($(el).is('[type="number"]')){
				$target = $(el);
			}
		});
		field_value = parseInt($target.val(),10);
		if ($.isNumeric(field_value)){
			if (field_value > MAX_AGE){
				alert("I don't think anyone lives that long, yet.");
				this.highlightOnError($target);
				result = false;
			}
			else if (field_value < 0){
				alert("People can't have a negative age.");
				this.highlightOnError($target);
				result = false;
			}

		}
		else{
			alert("Age must be a number");
			this.highlightOnError($target);
			result = false;
		}
		return result;
	},
	/**
	 validate the input fields in the fizz buzz form
	 @method validateFizzBuzz 
	 @param  {object} $el jquery search result for all the inputs in the form that fired the validate event
	*/
	validateFizzBuzz : function($el){
		var result = true, targets = [], MAX_COUNT = 250, MAX_STEP = (MAX_COUNT/2), i, len, el_id, field_value, step1_val;
		try{
			$el.each(function(idx, el){
				if($(el).is('[type="number"]')){
					targets.push(el);
				}
			});
			for (i=0, len=targets.length; i< len; i++){
				el_id = $(targets[i]).attr("id");
				field_value = parseInt($(targets[i]).val(),10);
				switch(el_id){
					case "fb_mc":
						if ($.isNumeric(field_value)){
							if (field_value > MAX_COUNT){
								throw {"message": "Max Count must be "+ MAX_COUNT+" or less", "$el":$(targets[i])};
							}
							else if (field_value < 1){
								throw {"message": "Max Count must be at least 1", "$el":$(targets[i])};
							}
						}
						else{
							throw {"message": "Max Count must be a number", "$el":$(targets[i])};
						}
					break;
					case "fb_s1":
						if ($.isNumeric(field_value)){
							if (field_value < 1){
								throw {"message": "Step 1 must be greater than zero", "$el":$(targets[i])};
							}
							else{
								step1_val = field_value;
							}
						}
						else{
							throw {"message": "Step 1 must be a number", "$el":$(targets[i])};
						}
					break;
					case "fb_s2":
						if ($.isNumeric(field_value)){
							if (field_value < 1){
								throw {"message": "Step 2 must be greater than zero", "$el":$(targets[i])};
							}
							else if (step1_val > field_value){
								throw {"message": "Step 2 must be greater than Step 1", "$el":$(targets[i])};
							}
						}
						else{
							throw {"message": "Step 1 must be a number", "$el":$(targets[i])};
						}
					break;	
				
				}
			}
		}
		catch(e){
			alert(e.message);
			this.highlightOnError(e.$el);
			result = false;
		}
		return result;
	},
	/**
	  highlight the form field that caused he error on validation and attach a "one" event to clear highlight on keydown
	  @method highlightOnError
	  @param {object} jquery reference to the input that failed validation
	*/
	highlightOnError : function($el){
		if ($el.length){
			$el.addClass("error").one("keydown focus", function(e){
				if ($el.hasClass("error")){
					$el.val("");
					$el.removeClass("error");
				}
			});
		}
	}

}

var app = new FormApp();

