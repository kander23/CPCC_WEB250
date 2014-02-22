
$(document).ready(function(){
	var userprompt = _.template($('#userprompt').html()), $nameFrm;
	$('body').append(userprompt());
	$nameFrm = $('body').find('.getname');

		
	$nameFrm.find('input[type="submit"]').on("click", function(){
		var username = $(this).parents('div.getname').find('input[type="text"]').val();
		if (($.trim(username)).length === 0){
			console.log("no name entered");
			$nameFrm.append($('<div>').addClass('error').text("no name entered"));
			$nameFrm.find('input[type="text"]').one("click", function(){
				$nameFrm.find('div.error').remove();
			});
		}
		else {
			var $nametarget = $('#header').find('h2');
			$nametarget.text(username.substr(0,1).toUpperCase()+username.substr(1).toLowerCase()+", "+$nametarget.text());
			$nameFrm.fadeOut("slow", function(){
				$('.greyout').remove();
				var instrctions =  _.template($('#startfizzbang').html());
				$('#body').find('.fbb').hide().append(instrctions).fadeIn("slow");
				
				 var $fbbform = $('div.fizzbuzzbang form');

				 $fbbform.find('input[type="submit"]').on("click", function(e){
					var $inputs = $fbbform.find('input:not([type="submit"])'), i , len;
					var dataOk = false, cntr = 0;
					for (i=0, len = $inputs.length; i < len; i++){
					
						var reg_ex = /^[\d]+$/;
						if ($($inputs[i]).val().length === 0){
							$($inputs[i]).addClass("error").data("hint", $($inputs[i]).attr("placeholder")).attr("placeholder","Missing Value").one("click", function(){
								$(this).removeClass("error").attr("placeholder", $(this).data("hint"));
							});
							break;
						}
						else if ($($inputs[i]).attr("type") === "number" && (
						(isNaN(parseInt($($inputs[i]).val(),10)) || (parseInt($($inputs[i]).val(),10)) <= 0 )
						||  !reg_ex.test($($inputs[i]).val())
						)){
							$($inputs[i]).addClass("error").val("").data("hint", $($inputs[i]).attr("placeholder")).attr("placeholder","Invalid").one("click", function(){
								$(this).removeClass("error").attr("placeholder", $(this).data("hint"));
							});
							break;
						}
						else{
							 cntr++;
							 if (cntr === len){ dataOk = true; }
						}
						
					}
					
					if (dataOk){
					
						var formdata = $fbbform.serialize();
						$.ajax({'data':formdata}).done(function(data){
							var $results = $fbbform.find('ol');
						
							if($results && $results.length){
								$fbbform.parent().find('div.links').remove();
								$results.slideUp("slow", function(){
									$results.remove();
									$fbbform.append($(base64_decode(data))).after($('<div>').addClass('links').html('<a href="fizzbuzzbang_mod3.php?name='+username+'">Clear</a>'));
									$fbbform.find('ol').slideDown("slow");
								});
							}
							else {
								$fbbform.append($(base64_decode(data))).after($('<div>').addClass('links').html('<a href="fizzbuzzbang_mod3.php?name='+username+'">Clear</a>'));
								$fbbform.find('ol').slideDown("slow");
							}
						});
					}
				 
				 });

			});
		}
	});
	
	if ( $('body').data("username") && $('body').data("username").length){
		
		$nameFrm.find('#first_name').val($('body').data("username"));
		$nameFrm.find('input[type="submit"]').trigger("click");
	}

	 
	
});

base64_decode = function (data) {
  // From: http://phpjs.org/functions
  // +   original by: Tyler Akins (http://rumkin.com)
  // +   improved by: Thunder.m
  // +      input by: Aman Gupta
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   bugfixed by: Onno Marsman
  // +   bugfixed by: Pellentesque Malesuada
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // *     example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==');
  // *     returns 1: 'Kevin van Zonneveld'
  // mozilla has this native
  // - but breaks in 2.0.0.12!
  //if (typeof this.window['atob'] === 'function') {
  //    return atob(data);
  //}
  var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    dec = "",
    tmp_arr = [];

  if (!data) {
    return data;
  }

  data += '';

  do { // unpack four hexets into three octets using index points in b64
    h1 = b64.indexOf(data.charAt(i++));
    h2 = b64.indexOf(data.charAt(i++));
    h3 = b64.indexOf(data.charAt(i++));
    h4 = b64.indexOf(data.charAt(i++));

    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

    o1 = bits >> 16 & 0xff;
    o2 = bits >> 8 & 0xff;
    o3 = bits & 0xff;

    if (h3 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1);
    } else if (h4 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1, o2);
    } else {
      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
    }
  } while (i < data.length);

  dec = tmp_arr.join('');

  return dec;
};