$(document).ready(function(){
	var userprompt = _.template($('#userprompt').html());
	$('body').append(userprompt());
	$('body').find('.getname input[type="button"]').on("click", function(){
		var username = $(this).parents('div.getname').find('input[type="text"]').val();
		if (($.trim(username)).length === 0){
			console.log("no name entered");
		}
	});

});